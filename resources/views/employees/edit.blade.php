@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<h1>Edit Employee</h1>

<form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
    </div>

    <div class="mb-3">
        <label>Position</label>
        <input type="text" name="position" class="form-control" value="{{ $employee->position }}" required>
    </div>

    <div class="mb-3">
        <label>Salary</label>
        <input type="number" name="salary" step="0.01" class="form-control" value="{{ $employee->salary }}" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if($employee->image)
            <img src="{{ asset('storage/' . $employee->image) }}" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
