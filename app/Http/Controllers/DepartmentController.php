<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departments = Department::all();
        return view('hrm.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('hrm.departments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:departments,name',
        ]);

        Department::create($data);

        return redirect()->route('departments.index')->with('success', 'Department created.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted.');
    }
}
