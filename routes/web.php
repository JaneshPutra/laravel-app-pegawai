<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();


Route::middleware('auth')->group(function () {

    // Tandai satu notifikasi dibaca
    Route::get('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect($notification->data['url'] ?? '/home');
    })->name('notifications.read');

    // Tandai semua notifikasi dibaca
    Route::get('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
});


Route::middleware(['auth', 'role:Pegawai'])->group(function () {

    Route::get('/my-attendances', [AttendanceController::class, 'myAttendance'])->name('attendances.myAttendance');
    Route::post('/attendances/clock-in', [AttendanceController::class, 'clockIn'])->name('attendances.clockIn');
    Route::post('/attendances/clock-out', [AttendanceController::class, 'clockOut'])->name('attendances.clockOut');

    Route::get('/my-leaves', [LeaveController::class, 'myLeaves'])->name('leaves.my');
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');

    Route::get('/my-salary', [SalaryController::class, 'mySalary'])->name('salaries.my');
    Route::get('/salary/{salary}/download', [SalaryController::class, 'downloadSlip'])->name('salaries.download');
});

Route::middleware(['auth', 'role:Manager'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/blank-page', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');



    // Dashboard & List
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
    Route::get('/manager', [EmployeeController::class, 'managerDashboard'])->name('manager.index');

    Route::get('/departemen', [DepartemenController::class, 'index'])->name('departemen.index');
    Route::get('/jabatan', [PositionController::class, 'index'])->name('jabatan.index');
    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');

    // Cuti Admin (approve/reject)
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::put('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::put('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
    Route::get('/my-dashboard', [LeaveController::class, 'myDashboard'])->name('leaves.dashboard');
    
    // Resource CRUD (Admin & Superadmin)
    Route::resource('employees', EmployeeController::class);
    Route::resource('departemens', DepartemenController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('salaries', SalaryController::class);
    Route::resource('users', UserController::class);
    
});

// ===================================================================
// 5. ROOT REDIRECT
// ===================================================================
Route::get('/', function () { return view('auth.login'); });