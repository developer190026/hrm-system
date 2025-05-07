@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Departments</h2>
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add Department</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $dept)
                <tr>
                    <td>{{ $dept->id }}</td>
                    <td>{{ $dept->department_name }}</td>
                    <td>{{ $dept->description }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this department?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
