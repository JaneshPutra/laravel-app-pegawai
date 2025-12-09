<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Departemen;
use App\Models\Position;
use App\Models\User;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::with(['departemen', 'jabatan']);

        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_lengkap', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereHas('departemen', function ($q2) use ($keyword) {
                        $q2->where('nama_departemen', 'like', "%{$keyword}%");
                    });
            });
        }

        $employees = $query->paginate(10)->withQueryString();

        return view('employees.index', compact('employees'));
    }

    public function managerDashboard()
    {
        // Statistik Utama
        $totalEmployees = Employee::count();
        $totalDepartments = Departemen::count();
        $totalPositions = Position::count();
        $totalActiveUsers = User::count();

        // Hitung pertumbuhan bulan ini
        $currentMonth = Employee::where('status', 'aktif')
            ->whereMonth('tanggal_masuk', Carbon::now()->month)
            ->whereYear('tanggal_masuk', Carbon::now()->year)
            ->count();
        $employeeGrowth = $currentMonth;

        // Status Approval Izin
        $pendingLeaves = Leave::where('status', 'pending')->count();
        $approvedToday = Leave::where('status', 'approved')
            ->whereDate('updated_at', Carbon::today())
            ->count();
        $rejectedLeaves = Leave::where('status', 'rejected')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        // Data Izin yang Menunggu Approval (5 terbaru)
        $pendingLeavesList = Leave::with(['employee.departemen', 'employee.jabatan'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Aktivitas Terbaru
        $recentActivities = $this->getRecentActivities();


        return view('manager.index', compact(
            'totalEmployees',
            'totalDepartments',
            'totalPositions',
            'totalActiveUsers',
            'employeeGrowth',
            'pendingLeaves',
            'approvedToday',
            'rejectedLeaves',
            'pendingLeavesList',
            'recentActivities',
        ));
    }

    private function getRecentActivities()
    {
        $activities = [];

        // Pegawai baru (7 hari terakhir)
        $newEmployees = Employee::where('tanggal_masuk', '>=', Carbon::now()->subDays(7))
            ->orderBy('tanggal_masuk', 'desc')
            ->take(3)
            ->get();

        foreach ($newEmployees as $emp) {
            $activities[] = [
                'time' => Carbon::parse($emp->tanggal_masuk)->diffForHumans(),
                'title' => 'Pegawai baru ditambahkan',
                'description' => $emp->nama_lengkap . ' bergabung'
            ];
        }

        // Izin yang disetujui hari ini
        $approvedLeaves = Leave::with('employee')
            ->where('status', 'approved')
            ->whereDate('updated_at', Carbon::today())
            ->take(2)
            ->get();

        foreach ($approvedLeaves as $leave) {
            $activities[] = [
                'time' => Carbon::parse($leave->updated_at)->diffForHumans(),
                'title' => 'Izin disetujui',
                'description' => 'Anda menyetujui izin ' . $leave->employee->nama_lengkap
            ];
        }

        // Sort by time
        usort($activities, function ($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 3);
    }


    public function search(Request $request)
    {
        $keyword = $request->q; // gunakan 'q' agar konsisten dengan AJAX

        $query = Employee::with(['departemen', 'jabatan']);

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_lengkap', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereHas('departemen', function ($q2) use ($keyword) {
                        $q2->where('nama_departemen', 'like', "%{$keyword}%");
                    });
            });
        }

        $employees = $query->paginate(10);

        // return JSON untuk AJAX
        return response()->json($employees);
    }
    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemens = Departemen::all();
        $positions = Position::all();
        return view('employees.create', compact('departemens', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:employees,email',
            'nomor_telepon' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'departemen_id' => 'nullable|exists:departemens,id',
            'jabatan_id' => 'nullable|exists:positions,id',
            'tanggal_masuk' => 'required|date',
            'status' => 'required',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departemens = Departemen::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departemens', 'positions'));
    }

    /**
     * 
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($id, 'id'),
            ],
            'nomor_telepon' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'departemen_id' => 'nullable|exists:departemens,id',
            'jabatan_id' => 'nullable|exists:positions,id',
            'tanggal_masuk' => 'required|date',
            'status' => 'required',
        ]);

        $employee->update($validated);

        // Alert::toast('Data Berhasil Diperbarui!!', 'success');
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();
        // Alert::toast('Data Berhasil dihapus!!', 'success');
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }

}
