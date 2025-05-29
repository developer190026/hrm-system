<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class AdminLeaveController extends Controller
{
    public function index()
    {
        $leaves = LeaveRequest::with('user')->latest()->get();
        return view('leaves.index', compact('leaves'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave = LeaveRequest::findOrFail($id);
        $leave->status = $request->status;
        $leave->save();

        return redirect()->back()->with('success', 'Leave status updated.');
    }
}
