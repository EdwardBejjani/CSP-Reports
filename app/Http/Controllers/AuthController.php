<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $user = Auth::user();
        if ($user) {
            return redirect()->route('dashboard.index')->with('success', 'Already Logged In');
        }
        return view('auth.login');
    }

    public function loginSumbit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('success', 'Logged In Successfully');
        } else {
            return back()->with('error', 'Invalid Credentials');
        }
    }

    public function logout(Request $request)
    {
        $guard = Auth::guard();
        $guard->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Logged Out Successfully');
    }
}
