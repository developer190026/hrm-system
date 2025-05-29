<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlldepartmentController extends Controller
{
    public function index()
    {


        // Get all projects
        $department = DB::table('department')->get();
        return view('department', compact('department'));
    }
}
