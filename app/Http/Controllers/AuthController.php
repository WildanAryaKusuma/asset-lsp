<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() 
    {
        return view('auth.login');
    }
    
    public function register() 
    {
        return view('auth.register');
    }

    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(auth()->user()->role == 'admin') {
                return redirect()->intended('/admin');
            } if (auth()->user()->role == 'operator') {
                return redirect()->intended('/operator');
            }
            return redirect()->intended('/');
        }

        return back();
    }

    public function store(Request $request) 
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $validateData['password'] = Hash::make($request->password);
        
        // dd($validateData);
        User::create($validateData);
        
        return redirect('/login');
    }

    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->invalidate();

        return redirect('/login');
    }
}