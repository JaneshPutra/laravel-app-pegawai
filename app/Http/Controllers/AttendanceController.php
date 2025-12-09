<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Leave;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();


        if ($user->role === 'Pegawai') {
            // Pegawai hanya lihat absensi dirinya sendiri
            $employee = $user->employee;

            $attendanceToday = Attendance::where('employee_id', $employee->id)
                ->whereDate('date', Carbon::today()->toDateString())
                ->first();

            return view('attendances.employee', compact('employee', 'attendanceToday'));
        }

        if ($user->role === 'Manager') {
            // Ambil tanggal dari request, default = hari ini
            $date = $request->input('date', Carbon::today()->toDateString());

            // Pegawai yang sudah absen pada tanggal tertentu
            $attendances = Attendance::with('employee.jabatan')
                ->whereDate('date', $date)
                ->get();


            // Pegawai yang izin (approved) pada tanggal tertentu
            $leaves = Leave::with('employee.jabatan')
                ->whereDate('start_date', '<=', $date)
                ->whereDate('end_date', '>=', $date)
                ->where('status', 'approved')
                ->get();

            // Semua pegawai
            $allEmployees = Employee::with('jabatan')->get();

            // Cari pegawai yang belum absen & tidak izin
            $absentEmployeeIds = $attendances->pluck('employee_id')->toArray();
            $leaveEmployeeIds = $leaves->pluck('employee_id')->toArray();
            $notYetAttendances = $allEmployees->whereNotIn('id', array_merge($absentEmployeeIds, $leaveEmployeeIds));

            // Rekap harian
            $rekap = [
                'hadir' => $attendances->count(),
                'izin' => $leaves->count(),
                'belum_absen' => $notYetAttendances->count(),
            ];



            return view('attendances.manager', compact('attendances', 'leaves', 'notYetAttendances', 'date', 'rekap'));
        }
    }

    public function myAttendance(Request $request)
    {
        $employee = Auth::user()->employee;
        $today = Carbon::today()->toDateString();
        $initials = collect(explode(' ', $employee->nama_lengkap))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->join('');

        // === Absensi & Izin Hari Ini ===
        $attendanceToday = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        $leaveToday = Leave::where('employee_id', $employee->id)
            ->where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        // === Bulan & Tahun yang ditampilkan di kalender ===
        $month = $request->filled('month') ? (int) $request->month : Carbon::now()->month;
        $year = $request->filled('year') ? (int) $request->year : Carbon::now()->year;

        // Pastikan bulan tetap valid (1-12)
        if ($month < 1) {
            $month = 12;
            $year--;
        } elseif ($month > 12) {
            $month = 1;
            $year++;
        }

        // === Absensi bulan ini (dikumpulkan per tanggal) ===
        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->date)->toDateString();
            });

        // === Izin bulan ini (bisa multi-hari) ===
        $leaves = Leave::where('employee_id', $employee->id)
            ->where('status', 'approved')
            ->where(function ($q) use ($month, $year) {
                $q->whereMonth('start_date', $month)->whereYear('start_date', $year)
                    ->orWhereMonth('end_date', $month)->whereYear('end_date', $year)
                    ->orWhere(function ($query) use ($month, $year) {
                        $query->whereMonth('start_date', '<=', $month)
                            ->whereMonth('end_date', '>=', $month)
                            ->whereYear('start_date', '<=', $year)
                            ->whereYear('end_date', '>=', $year);
                    });
            })
            ->get()
            ->flatMap(function ($leave) {
                $dates = [];
                $current = Carbon::parse($leave->start_date);
                $end = Carbon::parse($leave->end_date);

                while ($current->lte($end)) {
                    $dates[$current->toDateString()] = $leave;
                    $current->addDay();
                }
                return $dates;
            });

        // === Statistik Tahun Ini ===
        $totalHadir = Attendance::where('employee_id', $employee->id)
            ->whereYear('date', $year)
            ->count();

        $totalIzin = Leave::where('employee_id', $employee->id)
            ->where('status', 'approved')
            ->whereYear('start_date', $year)
            ->count();

        // === Ringkasan Bulan Ini (Hadir / Izin / Alpha) ===
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $now = Carbon::now();

        $hadirBulanIni = 0;
        $izinBulanIni = 0;
        $tidakHadirBulanIni = 0;

        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            if ($date->isWeekend())
                continue; // Sabtu & Minggu tidak dihitung

            $dateStr = $date->toDateString();

            if ($date->gt($now))
                break; // Hari yang belum tiba tidak dihitung

            if (isset($attendances[$dateStr])) {
                $hadirBulanIni++;
            } elseif (isset($leaves[$dateStr])) {
                $izinBulanIni++;
            } else {
                $tidakHadirBulanIni++;
            }
        }

        return view('attendances.employee', compact(
            'employee',
            'attendanceToday',
            'leaveToday',
            'attendances',
            'leaves',
            'month',
            'year',
            'totalHadir',
            'totalIzin',
            'hadirBulanIni',
            'izinBulanIni',
            'tidakHadirBulanIni',
            'initials'
        ));
    }



    public function clockIn()
    {
        $employee = Auth::user()->employee;
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate(
            ['employee_id' => $employee->id, 'date' => $today],
            ['status' => 'hadir'] // isi status hadir
        );

        $attendance->clock_in = Carbon::now();
        $attendance->save();

        return back()->with('success', 'Clock In berhasil');
    }


    public function clockOut()
    {
        $employee = auth()->user()->employee;

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('date', Carbon::today()->toDateString())
            ->first();

        if ($attendance && !$attendance->clock_out) {
            $attendance->update([
                'clock_out' => Carbon::now()->format('H:i:s'), // jam saat ini
            ]);
        }

        return back()->with('success', 'Clock Out berhasil!');
    }
}

