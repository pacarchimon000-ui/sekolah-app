<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginChoice'])->name('portal');
Route::get('/login', [AuthController::class, 'showLoginChoice'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function (Request $request) {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat membuka dashboard.');
        }

        return app(ReportController::class)->dashboard($request);
    })->name('dashboard');

    Route::get('/dashboard/export', function (Request $request) {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengekspor laporan.');
        }

        return app(ReportController::class)->export($request);
    })->name('dashboard.export');

    Route::get('/dashboard/siswa', function () {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Akses ditolak. Hanya siswa yang dapat membuka dashboard siswa.');
        }

        return app(ReportController::class)->studentDashboard();
    })->name('student.dashboard');

    Route::get('/admin/siswa', [AuthController::class, 'showStudentManagement'])->name('admin.students');
    Route::get('/admin/siswa/{student}', [AuthController::class, 'showStudentDetail'])->name('admin.students.detail');
    Route::post('/admin/siswa', [AuthController::class, 'storeStudentManagement'])->name('admin.students.store');
    Route::put('/admin/siswa/{student}', [AuthController::class, 'updateStudentManagement'])->name('admin.students.update');
    Route::delete('/admin/siswa/{student}', [AuthController::class, 'destroyStudentManagement'])->name('admin.students.destroy');

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
    Route::post('/reports/{report}/status', [ReportController::class, 'updateStatus'])->name('reports.status.update');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
});

Route::get('/register/siswa', [AuthController::class, 'showStudentRegister'])->name('student.register');
Route::post('/register/siswa', [AuthController::class, 'registerStudent'])->name('student.register.submit');

Route::get('/register/admin', [AuthController::class, 'showAdminRegister'])->name('admin.register');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('admin.register.submit');

Route::get('/login/siswa', [AuthController::class, 'showStudentLogin'])->name('student.login');
Route::post('/login/siswa', [AuthController::class, 'loginStudent'])->name('student.login.submit');

Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/laporan', [ReportController::class, 'store'])->name('reports.store');
