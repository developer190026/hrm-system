<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        //$employees = DB::table('employees')->get();
        $employees = DB::table('employees')->simplepaginate(4);


        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('employee_images', 'public')
            : null;

        $data = DB::table('employees')->insert([
            'name' => $request->name,
            'position' => $request->position,
            'salary' => $request->salary,
            'image' => $imagePath,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $employee = DB::table('employees')->find($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric'
            //'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'salary' => $request->salary,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employee_images', 'public');
            $data['image'] = $imagePath;
        }

        DB::table('employees')->where('id', $id)->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('employees')->where('id', $id)->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
