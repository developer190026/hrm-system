@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- For both create and edit -->
<form method="POST" action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}">
    @csrf
    @if(isset($department))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="department_name" value="{{ old('department_name', $department->department_name ?? '') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $department->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">
        {{ isset($department) ? 'Update' : 'Create' }}
    </button>
</form>
@endsection