<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Resources\Alldepartments;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
{
    $departments = Department::all();

    // Transform the data using your Resource
    $transformed = Alldepartments::collection($departments)->resolve();


    //$transformed = new Alldepartments($departments);
    // /dd($transformed);
    // Pass transformed data to the view
    return view('departments.index', ['departments' => $transformed]);
}


    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        Department::findOrFail($id)->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
