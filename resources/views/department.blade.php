@extends('layouts.app')

@section('title', 'All department')

@section('content')
    <div class="container my-4">
        <h2 class="text-center mb-4">Department List</h2>

        <!-- Loop through department and display them -->
        <div class="row">
            @foreach ($department as $department)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">{{ $department->department_name }}</h3>
                            <p class="card-text">{{ Str::limit($department->description, 100) }}</p> 
                            
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
