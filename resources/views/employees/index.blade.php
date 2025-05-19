@extends('layouts.app')

@section('title', 'Employee List')

@section('content')

            <div class="d-flex justify-content-between align-items-center mb-4">

                @can('isAdmin')
                <h2 class="mb-0">List for Employees</h2>
                @endcan

                @cannot('isAdmin')
                <h2 class="mb-0">Employee List</h2>
                @endcannot

                <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New</a>
            </div>

            <div class="alert alert-info text-center">
                {{ Auth::check() ? "Hi, $userName!" : "Welcome, Guest!" }}
            </div>

            <div class="table-responsive bg-white rounded shadow-sm p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                {{ $employee->department ? $employee->department->department_name : 'No Department' }}
                                [ {{ $employee->department_id }} ]
                            </td>


                            <td>${{ number_format($employee->salary, 2) }}</td>
                            <td>
                                <img src="{{ $employee->image ? asset('storage/' . $employee->image) : asset('images/user.jpg') }}" width="60" class="rounded shadow-sm">
                            </td>
                            <td>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this employee?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $employees->links() }}
                </div>
            </div>

    </div>
</div>
@endsection
