<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeControlller extends Controller
{
    public function index()
    {
        return view('employees.index', ['employees' => Employee::paginate()]);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(EmployeeStoreRequest $request)
    {
        Employee::create([
            'employeenumber' =>$request->employeenumber,
            'firstname' => Str::title($request->firstname),
            'lastname' => Str::title($request->lastname),
            'middlename' => Str::title($request->middlename),
            'suffix' => $request->suffix,
            'email' => $request->email,
            'position' => $request->position,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Employee successfully registered!');
    }

    public function show(Employee $employee)
    {
        return view('employees.edit', ['employee' => $employee]);
    }

    public function update(Employee $employee, Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'email' => ['required', 'email', 'unique:employees'],
            'position' => 'required'
        ]);

        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->middlename = $request->middlename;
        $employee->email = $request->email;
        $employee->position = $request->position;
        $employee->update();

        return redirect()->back()->with('success', 'Successfully updated');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->back()->with('success', 'Employee successfully deleted!');
    }

    public function reset(Employee $employee)
    {
        $employee->password = Hash::make('12345678');
        return redirect()->back()->with('success', 'Employee password successfully reset!');
    }
}
