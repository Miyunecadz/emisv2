<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function loginForm()
    {
        if(Auth::guard('employee')->check())
        {
            return redirect(route('employee.dashboard'));
        }
        return view('user_employee.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if(auth()->guard('employee')->attempt($credentials))
        {
            $user = auth()->user();
            return redirect()->intended(route('employee.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('employee.loginForm'));
    }
}
