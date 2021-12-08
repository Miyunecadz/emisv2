<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class EmployeeControlller extends Controller
{


    public function index(Request $request)
    {
        return view('employees.index', ['employees' => Employee::when($request->keyword, function($query, $keyword){
            $query->where('employeenumber','LIKE', '%'. $keyword .'%')
            ->orwhere('firstname', 'LIKE', '%'.$keyword.'%')
            ->orWhere('lastname', 'LIKE', '%'.$keyword.'%')
            ->orWhereRaw("concat(firstname,' ',lastname)=?",$keyword)
            ->orWhereRaw("concat(lastname,' ',firstname)=?",$keyword)
            ->orWhere('username','LIKE', "%{$keyword}%")
            ->orWhere('email','LIKE', "%{$keyword}%")
            ->orWhere('position', $keyword);
        })->paginate()]);
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

    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee'=>$employee, 'positions' => Employee::validPositions(), 'qrcode' => Crypt::encrypt($employee->qrcode)]);
    }

    public function update(Employee $employee, Request $request)
    {
        $request->validate([
            'employeenumber' => 'required|numeric',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email'],
            'position' => 'required'
        ]);

        $employee->employeenumber = $request->employeenumber;
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

    public function regenerateQrCode(Employee $employee)
    {
        $employee->qrcode = Employee::generateQrCode($employee->qrcode);
        $employee->update();
        return redirect()->back()->with('success', 'Employee successfully regenerated qrcode');
    }
}
