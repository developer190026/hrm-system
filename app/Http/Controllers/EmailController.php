<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\welcomemail;

use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendemail(){

        $to = "developer190026@gmail.com";
        $message ="test email";
        $subject ="laravel email";

        Mail::to($to)->queue(new welcomemail($message, $subject));
        return response()->json(['status' =>'Email sent']);

    }
}
