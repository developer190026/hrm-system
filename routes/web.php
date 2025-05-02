<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

// Route to view all employees (GET request)
Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');

// Route to display the employee creation form (GET request)
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');

// Route to store a new employee (POST request)
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// Route to delete an employee (DELETE request)
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

// Route to edit an employee (GET request)
Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');

// Route to update an employee (PUT request)
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
