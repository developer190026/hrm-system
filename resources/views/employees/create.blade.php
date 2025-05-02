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
        <label>Position</label>
        <input type="text" name="position" class="form-control" required>
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
