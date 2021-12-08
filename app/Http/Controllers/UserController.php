<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', '<>', 'admin')->when($request->keyword, function($query, $keyword){
            $query->where('firstname', 'LIKE', '%'.$keyword.'%')
            ->orWhere('lastname', 'LIKE', '%'.$keyword.'%')
            ->orWhereRaw("concat(firstname,' ',lastname)=?",$keyword)
            ->orWhereRaw("concat(lastname,' ',firstname)=?",$keyword)
            ->orWhere('username','LIKE', "%{$keyword}%")
            ->orWhere('email','LIKE', "%{$keyword}%")
            ->orWhere('role', $keyword);
        })->paginate();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(RegisterUserRequest $request)
    {
        User::create([
            'firstname' => Str::title($request->firstname),
            'lastname' => Str::title($request->lastname),
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'User successfully added!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User successfully delete!');
    }

    public function reset(User $user)
    {
        $user->password = Hash::make('12345678');

        return redirect()->back()->with('success', 'User password successfully reset!');
    }

}
