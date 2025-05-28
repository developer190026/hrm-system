<?php
namespace App\Http\Controllers;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::where('user_id', Auth::id())->get();
        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('leave_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'type'       => 'required|in:sick,casual,paid,unpaid',
            'reason'     => 'nullable|string|max:1000',
        ]);

        LeaveRequest::create([
            'user_id'    => Auth::id(),
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'type'       => $request->type,
            'reason'     => $request->reason,
        ]);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request submitted.');
    }
    public function approve($id)
{
    $leave = LeaveRequest::findOrFail($id);
    $leave->status = 'approved';
    $leave->approved_by = auth()->id();
    $leave->approved_at = now();
    $leave->save();

    return back()->with('success', 'Leave approved successfully.');
}

public function reject($id)
{
    $leave = LeaveRequest::findOrFail($id);
    $leave->status = 'rejected';
    $leave->approved_by = auth()->id();
    $leave->approved_at = now();
    $leave->save();

    return back()->with('error', 'Leave rejected.');
}

}
