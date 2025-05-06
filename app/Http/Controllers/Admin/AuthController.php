<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // register
    public function register()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:4', 'max:255', 'unique:admins'],
            'email' => 'required|email:dns|unique:admins',
            'password' => 'required|min:5|max:255',
            'confirm-password' => 'required|same:password',
            'terms' => 'accepted'
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        Admin::create($validatedData);
        return redirect(route('admin.login'))->with('success', 'Registration success! Please login');
    }

    // login
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (auth()->guard('admin')->attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login successful!');
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('admin.login')->with('success', 'Logout successful!');
    }
}
