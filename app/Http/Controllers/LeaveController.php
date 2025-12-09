<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ManagerNotification;
use App\Notifications\EmployeeLeaveNotification;
use App\Events\ManagerActionEvent;
use App\Models\User;

class LeaveController extends Controller
{
    /**
     * List semua pengajuan izin/cuti
     */
    public function index()
    {
        $leaves = Leave::with(['employee.jabatan', 'approver'])->get();

        return view('leaves.index', compact('leaves'));
    }


    /**
     * Form pengajuan izin/cuti
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Simpan pengajuan izin/cuti
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'required|in:izin,cuti,sakit,lainnya',
            'reason' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $leave = Leave::create([
            'employee_id' => Auth::user()->employee->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date ?? $request->start_date,
            'type' => $request->type,
            'reason' => $request->reason,
            'status' => 'pending',
            'attachment' => $attachmentPath,
        ]);

        // ✅ Tambahan: Kirim notifikasi ke semua Manager
        $managers = User::where('role', 'Manager')->get();

        foreach ($managers as $manager) {
            $manager->notify(new EmployeeLeaveNotification(
                message: "Pegawai " . Auth::user()->name . " mengajukan izin/cuti periode " . $leave->start_date . " - " . $leave->end_date,
                url: route('leaves.index') // halaman Manager untuk approve/reject
            ));
        }

        return redirect()->route('leaves.my')->with('success', 'Pengajuan izin berhasil dikirim');
    }


    /**
     * Approve izin
     */
    public function approve(Leave $leave)
    {
        $leave->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        $user = $leave->employee->user;

        $user->notify(new ManagerNotification(
            "Surat izin Anda tanggal {$leave->start_date} - {$leave->end_date} telah disetujui.",
            type: 'leave-approved'
        ));

        event(new ManagerActionEvent(
            $user->id,
            "Surat izin Anda telah disetujui oleh manajer."
        ));

        return redirect()->back()->with('success', 'Izin disetujui');
    }

    public function reject(Leave $leave)
    {
        $leave->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
        ]);

        $user = $leave->employee->user;

        $user->notify(new ManagerNotification(
            "Surat izin Anda tanggal {$leave->start_date} - {$leave->end_date} ditolak.",
            type: 'leave-rejected'
        ));

        event(new ManagerActionEvent(
            $user->id,
            "Surat izin Anda telah ditolak oleh manajer."
        ));

        return redirect()->back()->with('success', 'Izin ditolak');
    }
    public function myLeaves()
    {
        $leaves = Leave::with('approver')
            ->where('employee_id', Auth::user()->employee->id)
            ->orderBy('start_date', 'desc')
            ->get();

        return view('leaves.my', compact('leaves'));
    }

    public function myDashboard()
    {
        $employeeId = Auth::user()->employee->id;

        $totalLeaves = Leave::where('employee_id', $employeeId)->count();
        $approvedLeaves = Leave::where('employee_id', $employeeId)->where('status', 'approved')->count();
        $pendingLeaves = Leave::where('employee_id', $employeeId)->where('status', 'pending')->count();
        $rejectedLeaves = Leave::where('employee_id', $employeeId)->where('status', 'rejected')->count();

        // Rekap per jenis izin
        $izinCount = Leave::where('employee_id', $employeeId)->where('type', 'izin')->count();
        $cutiCount = Leave::where('employee_id', $employeeId)->where('type', 'cuti')->count();
        $sakitCount = Leave::where('employee_id', $employeeId)->where('type', 'sakit')->count();

        return view('leaves.dashboard', compact(
            'totalLeaves',
            'approvedLeaves',
            'pendingLeaves',
            'rejectedLeaves',
            'izinCount',
            'cutiCount',
            'sakitCount'
        ));
    }


}
