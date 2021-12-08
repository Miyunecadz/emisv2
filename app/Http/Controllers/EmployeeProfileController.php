<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeProfileController extends Controller
{
    public function show()
    {
        return view('user_employee.profile');
    }

    public function update(EmployeeProfileRequest $request)
    {
        if ($request->password) {
            auth()->guard('employee')->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->guard('employee')->user()->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname
        ]);

        return back()->with('success', 'Profile Successfully updated!');
    }
}
