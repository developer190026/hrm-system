<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class EmployeePasswordResetController extends Controller
{
    // Show form to request reset link
    public function showLinkRequestForm()
    {
        return view('employees.password.email');
    }

    // Handle sending reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $employee = employee::where('email', $request->email)->first();

        if (!$employee) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $link = url('/employee/password/reset/' . $token . '?email=' . urlencode($request->email));

        Mail::raw("Reset your password using this link: $link", function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
        });

        return back()->with('status', 'Password reset link sent!');
    }

    // Show reset password form
    public function showResetForm(Request $request, $token)
    {
        return view('employees.password.reset', ['token' => $token, 'email' => $request->email]);
    }

    // Handle actual password reset
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $reset = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // $employee = employee::where('email', $request->email)->first();
        // if (!$employee) {
        //     return back()->withErrors(['email' => 'No employee found.']);
        // }

        // $employee->password = Hash::make($request->password);
        // $employee->save();

        DB::table('password_resets')->where('email', $request->email)->delete();
        DB::table('users')->where('email', $request->email)->update(
            [
                'password' => Hash::make($request->password)
            ]
    );
        return redirect()->route('dashboard');
    }
}
