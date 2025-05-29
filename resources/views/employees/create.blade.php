@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
<h1>Add New Employee</h1>

<form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="department_id" class="form-label">Select Department</label>
        <select name="department_id" class="form-control" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">
                    {{ $department->department_name }} (ID: {{ $department->id }})
                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label>Salary</label>
        <input type="number" name="salary" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection
