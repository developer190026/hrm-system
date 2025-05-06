<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AlldepartmentController;


// Route to view all employees (GET request)
Route::get('/', [EmployeeController::class, 'index'])
    ->middleware('auth')
    ->name('employees.index');

// Route to display the employee creation form (GET request)
Route::get('/employees/create', [EmployeeController::class, 'create'])
->name('employees.create');

// Route to store a new employee (POST request)
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// Route to delete an employee (DELETE request)
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

// Route to edit an employee (GET request)
Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');

// Route to update an employee (PUT request)
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');

Route::post('/employees/login', [EmployeeController::class, 'login'])
    ->name('employees.userlogin');

Route::get('/employees/login', [EmployeeController::class, 'showLoginForm'])
    ->name('login'); // ← Alias required by auth middleware

    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login'); // or your custom login route
    })->name('logout');

    Route::get('/dashboard', function () {
    return view('employees.dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('employees.profile');
})->name('profile');

Route::get('/settings', function () {
    return view('employees.settings');
})->name('settings');

Route::resource('employees', EmployeeController::class);
Route::Resource('department', DepartmentApiController::class);

Route::get('/alldepartment', [AlldepartmentController::class, 'index'])->name('alldepartment');
