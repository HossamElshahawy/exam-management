<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        $departments = Department::all();
        return view('auth.register',compact('departments'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:2,3',
            'department_id' => 'nullable|required_if:role,3',
            'level' => 'nullable|required_if:role,3'
        ]);

        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);

        if ($validatedData['role'] == 2) {
            $user->is_approved = false;
            $user->department_id = null;
            $user->level = null;
            $user->role = 2;
        } elseif ($validatedData['role'] == 3) {
            $user->is_approved = true;
            $user->department_id = $validatedData['department_id'];
            $user->level = $validatedData['level'];
            $user->role = 3;
        }

        $user->save();
        event(new Registered($user));

        Auth::login($user);

        if(Auth::user() && Auth::user()->role == 1)
        {
            return redirect()->route('admin.dashboard');
        }
        if(Auth::user() && Auth::user()->role == 2)
        {
            return redirect()->route('professor.dashboard');
        }
        if(Auth::user() && Auth::user()->role == 3)
        {
            return redirect()->route('student.dashboard');
        }
        return redirect()->route('login');
    }
}
