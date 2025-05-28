@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Leave Requests</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('leave-requests.create') }}">Create New Leave Request</a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Dates</th>
                <th>Type</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveRequests as $leave)
                <tr>
                    <td>{{ $leave->start_date }} to {{ $leave->end_date }}</td>
                    <td>{{ ucfirst($leave->type) }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ ucfirst($leave->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
