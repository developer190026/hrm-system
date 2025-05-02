@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
<h1>Employee List</h1>

<a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add New</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->position }}</td>
            <td>{{ $employee->salary }}</td>
            <td>
                @if($employee->image)
                    <img src="{{ asset('storage/' . $employee->image) }}" width="80">
                @else
                <img src="{{ asset('images/user.jpg') }}" width="80">
                @endif
            </td>
            <td>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

    <div class="md-5">
        {{ $employees->links() }}
    </div>
</table>
@endsection
