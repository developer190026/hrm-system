@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Leave Requests</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>User</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($leaves as $leave)
            <tr>
                <td>{{ $leave->user->name ?? 'Unknown' }}</td>
                <td>{{ $leave->start_date }}</td>
                <td>{{ $leave->end_date }}</td>
                <td>{{ $leave->reason }}</td>
                <td>{{ $leave->status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.leaves.updateStatus', $leave->id) }}">
                        @csrf
                        <select name="status">
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
