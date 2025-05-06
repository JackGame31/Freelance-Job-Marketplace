<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // register
    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'confirm-password' => 'required|same:password',
            'terms' => 'accepted'
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect(route('login'))->with('success', 'Registration success! Please login');
    }

    // login
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (auth()->attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Login successful!');
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('login')->with('success', 'Logout successful!');
    }
}
