<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Email / Password tidak valid',
        ])->onlyInput('email');
    }

    public function index()
    {
        return view('auth/login');
    }

    public function username()
    {
        return 'username';
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'email|required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $validator['name'],
            'username' => $validator['username'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        return redirect('login')->with('success', 'User Berhasil register, silahkan login!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
