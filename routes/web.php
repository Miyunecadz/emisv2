<?php

use App\Http\Controllers\EmployeeControlller;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
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
});
