@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>Your Profile</h4>{{ Auth::user() }}
            <p>Name: {{ Auth::user()->name }}</p>
            <p>Email: {{ Auth::user()->email }}</p>
            <!-- Add profile update form if needed -->
        </div>
    </div>
@endsection
