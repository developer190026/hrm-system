@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Submit Leave Request</h2>

    <form action="{{ route('leave-requests.store') }}" method="POST" class="leave_request_form">
        @csrf
        <div>
            <label>Start Date</label>
            <input type="date" name="start_date" required>
        </div>
        <div>
            <label>End Date</label>
            <input type="date" name="end_date" required>
        </div>
        <div>
            <label>Type</label>
            <select name="type" required>
                <option value="sick">Sick</option>
                <option value="casual">Casual</option>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
            </select>
        </div>
        <div>
            <label>Reason</label>
            <textarea name="reason"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
@endsection
