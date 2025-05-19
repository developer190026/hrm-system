<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentApiController;
use App\Http\Controllers\AlldepartmentController;
use App\Http\Controllers\EmailController;

use App\Http\Controllers\EmployeePasswordResetController;
use Illuminate\Support\Facades\Auth;

// Authentication Routes
Route::get('/employees/login', [EmployeeController::class, 'showLoginForm'])->name('login'); // Required by 'auth' middleware
Route::post('/employees/login', [EmployeeController::class, 'login'])->name('employees.userlogin');
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Public Route
Route::get('/', [EmployeeController::class, 'index'])->middleware('auth')->name('employees.index');

// Authenticated Routes Group
Route::middleware('auth')->group(function () {

    // Dashboard, Profile, Settings
    Route::get('/dashboard', fn() => view('employees.dashboard'))->name('dashboard');
    Route::get('/profile', fn() => view('employees.profile'))->name('profile');
    Route::get('/settings', fn() => view('employees.settings'))->name('settings');

    // Employee Routes (Authorization applied to create only)
    Route::get('/employees/create', [EmployeeController::class, 'create'])
        ->middleware('can:isAdmin')
        ->name('employees.create');

    Route::resource('employees', EmployeeController::class)->except(['create']);

    // Department Routes
    //Route::resource('department', DepartmentApiController::class); // API resource
    Route::get('/alldepartment', [AlldepartmentController::class, 'index'])->name('alldepartment');

    // Department Management Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
});

Route::get('/email',[EmailController::class,'sendemail']);
Route::get('employee/password/reset', [EmployeePasswordResetController::class, 'showLinkRequestForm'])->name('employee.password.request');
Route::post('employee/password/email', [EmployeePasswordResetController::class, 'sendResetLinkEmail'])->name('employee.password.email');
Route::get('employee/password/reset/{token}', [EmployeePasswordResetController::class, 'showResetForm'])->name('employee.password.reset');
Route::post('employee/password/reset', [EmployeePasswordResetController::class, 'reset'])->name('employee.password.update');
