<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\ManagerNotification;
use App\Events\ManagerActionEvent;
use Carbon\Carbon;


class SalaryController extends Controller
{
    // Tampilkan daftar gaji bulanan
    public function index()
    {
        $salaries = Salary::with('employee')->orderByDesc('periode')->get();
        $totalGaji = $salaries->sum('total_gaji');
        $totalGajiBulanIni = $salaries->sum('total_gaji');
        $totalGajiTahunIni = Salary::whereYear('periode', now()->year)->sum('total_gaji');
        return view('salaries.index', compact('salaries', 'totalGaji', 'totalGajiBulanIni', 'totalGajiTahunIni'));
    }

    public function mySalary()
    {
        $employee = Auth::user()->employee;

        $salaries = Salary::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('salaries.my', compact('employee', 'salaries'));
    }
    public function downloadSlip(Salary $salary)
    {
        $employee = $salary->employee;

        $pdf = Pdf::loadView('salaries.slip', compact('salary', 'employee'));

        return $pdf->download('Slip_Gaji_' . $employee->nama_lengkap . '_' . $salary->periode . '.pdf');
    }

    // Tampilkan form input gaji
    public function create()
    {
        $employees = Employee::with('jabatan')->get();
        return view('salaries.create', compact('employees'));
    }

    // Simpan data gaji bulanan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => [
                'required',
                'exists:employees,id',
                Rule::unique('salaries')->where(fn($q) => $q->where('periode', $request->periode)),
            ],
            'tunjangan' => 'nullable|integer',
            'potongan' => 'nullable|integer',
            'periode' => 'required|date_format:Y-m',
        ], [
            'employee_id.unique' => 'Gaji untuk pegawai ini di periode tersebut sudah tercatat.',
        ]);

        $validated['periode'] = $validated['periode'] . '-01';

        $employee = Employee::with('jabatan')->findOrFail($validated['employee_id']);
        $gaji_pokok = $employee->jabatan->gaji_pokok ?? 0;

        $tunjangan = $validated['tunjangan'] ?? 0;
        $potongan = $validated['potongan'] ?? 0;
        $total_gaji = $gaji_pokok + $tunjangan - $potongan;

        $salary = Salary::create([
            'employee_id' => $employee->id,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
            'periode' => $validated['periode'],
        ]);

        $user = $employee->user;

        $periodeLabel = Carbon::parse($salary->periode)->translatedFormat('F Y');
        $nominalLabel = number_format($salary->total_gaji, 0, ',', '.');

        $message = "Gaji periode {$periodeLabel} sebesar Rp{$nominalLabel} telah diberikan.";

        // ✅ Notifikasi database
        $user->notify(new ManagerNotification(
            message: $message,
            type: 'salary',
            periode: $periodeLabel
        ));

        // ✅ Event broadcast (hanya id + string)
        event(new ManagerActionEvent(
            $user->id,
            "Pembayaran gaji periode {$periodeLabel} telah diproses."
        ));

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil disimpan.');
    }


    // Tampilkan detail gaji
    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }

    // Tampilkan form edit gaji
    public function edit(Salary $salary)
    {
        $employees = Employee::with('jabatan')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    // Update data gaji
    public function update(Request $request, Salary $salary)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'periode' => 'required|date_format:Y-m',
        ]);

        // Konversi periode jadi tanggal (01 dari bulan itu)
        $periode = $validated['periode'] . '-01';

        // Hitung total gaji
        $total_gaji = $validated['gaji_pokok'] +
            ($validated['tunjangan'] ?? 0) -
            ($validated['potongan'] ?? 0);

        // Update data
        $salary->update([
            'employee_id' => $validated['employee_id'],
            'gaji_pokok' => $validated['gaji_pokok'],
            'tunjangan' => $validated['tunjangan'] ?? 0,
            'potongan' => $validated['potongan'] ?? 0,
            'total_gaji' => $total_gaji,
            'periode' => $periode,
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui!');
    }


    // Hapus data gaji
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}
