<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\EmployeeAuthController;
use App\Http\Controllers\EmployeeControlller;
use App\Http\Controllers\EmployeeProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function() {
    return redirect(route('home'));
});

Auth::routes();
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::delete('users/{user}',[\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::put('users/{user}', [\App\Http\Controllers\UserController::class, 'reset'])->name('users.reset');

    Route::get('employees',[EmployeeControlller::class, 'index'])->name('employees.index');
    Route::get('employees/create', [EmployeeControlller::class, 'create'])->name('employees.create');
    Route::post('employees', [EmployeeControlller::class, 'store'])->name('employees.store');
    // Route::get('employees/{employee}', [EmployeeControlller::class, 'show'])->name('employees.show');
    Route::get('employees/{employee}/edit', [EmployeeControlller::class, 'edit'])->name('employees.edit');
    Route::put('employees/{employee}', [EmployeeControlller::class, 'update'])->name('employees.update');
    Route::delete('employees/{employee}', [EmployeeControlller::class, 'destroy'])->name('employees.destroy');
    Route::put('employees/{employee}/reset', [EmployeeControlller::class, 'reset'])->name('employees.reset');
    Route::put('employees/{employee}/generate', [EmployeeControlller::class, 'regenerateQrCode'])->name('employees.regenerate');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('attendance', [AttendanceController::class, 'scan'])->name('attedance.scan');
    Route::delete('attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
});


Route::get('employee/login', [EmployeeAuthController::class, 'loginForm'])->name('employee.loginForm');
Route::post('employee/login', [EmployeeAuthController::class, 'login'])->name('employee.login');

Route::middleware('employee')->prefix('employee')->group(function(){
    Route::get('dashboard', function(){
        return view('user_employee.dashboard');
    })->name('employee.dashboard');

    Route::get('profile', [EmployeeProfileController::class, 'show'])->name('employee.profile');
    Route::put('profile', [EmployeeProfileController::class, 'update'])->name('employee.profileUpdate');

    Route::get('attendances', [AttendanceController::class, 'filterByLoginEmployee'])->name('employee.attendance');


    Route::post('employee/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
});


