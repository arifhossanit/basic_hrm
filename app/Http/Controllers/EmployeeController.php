<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Skill;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $departments = Department::all();
        $query = Employee::with('department', 'skills');
        if (($request->ajax() || $request->wantsJson() || $request->expectsJson()) && $request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
            return response()->json($query->get());
        }

        $employees = $query->get();
        return view('hrm.employees.index', compact('employees', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        $skills = Skill::all();
        return view('hrm.employees.create', compact('departments', 'skills'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $skills = $data['skills'] ?? [];
        unset($data['skills']);

        $employee = Employee::create($data);
        $employee->skills()->sync($skills);

        return redirect()->route('employees.index')->with('success', 'Employee created.');
    }

    public function show(Employee $employee)
    {
        $employee->load('department', 'skills');
        return view('hrm.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $skills = Skill::all();
        $employee->load('skills');
        return view('hrm.employees.edit', compact('employee', 'departments', 'skills'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $skills = $data['skills'] ?? [];
        unset($data['skills']);

        $employee->update($data);
        $employee->skills()->sync($skills);

        return redirect()->route('employees.index')->with('success', 'Employee updated.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->get('email');
        $exists = Employee::where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    }
}
