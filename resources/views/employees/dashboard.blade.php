@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="alert alert-success">Welcome to the Dashboard, {{ Auth::user()->name }}!</div>

    <div class="row">
        <!-- Total Employees Card -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <a href="{{ route('employees.index') }}">
                        <p class="card-text display-6">{{ \App\Models\Employee::count() }}</p>
                    </a>
                </div>
            </div>
        </div>
    
        <!-- Total Departments Card -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Departments</h5>
                    <a href="{{ route('departments.index') }}">
                        <p class="card-text display-6">{{ \App\Models\Department::count() }}</p>
                    </a>
                </div>
            </div>
        </div>
    
        <!-- You can add more cards here if needed -->
    
    </div>
    
        <!-- Add more dashboard widgets if needed -->
    </div>
@endsection
