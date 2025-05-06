<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\employee;  
use App\Models\Department;  

class EmployeeController extends Controller
{
    public function index()
    {
        // Eager load the 'department' relationship with employees (use with() for eager loading)
        $employees = Employee::with('department')->simplePaginate(4);  // This line handles the employee fetching and pagination
    
        // Get the logged-in user's name
        $userName = Auth::user()->name;
    
        // Pass both the employees list and user's name to the view
        return view('employees.index', compact('employees', 'userName'));
    }
    
    public function showLoginForm()
    {
        return view('employees.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('employees.index'); // Redirect to main page after login
        }
    
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ]);
    }
    

    public function create()
    {
       
    //return view('employees.create');
       
    $departments = Department::all(); // Fetch all departments
    return view('employees.create', compact('departments'));



    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('employee_images', 'public')
            : null;

        $data = DB::table('employees')->insert([
            'name' => $request->name,
            'department_id' => $request->department_id,
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
            'department_id' => 'required|string|max:255',
            'salary' => 'required|numeric'
            //'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'department_id' => $request->department_id,
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
