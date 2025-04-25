<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:100',
            'hours_worked' => 'nullable|numeric|min:0',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', __('Employee added successfully'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:100',
            'hours_worked' => 'nullable|numeric|min:0',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', __('Employee updated successfully'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', __('Employee deleted successfully'));
    }
}
