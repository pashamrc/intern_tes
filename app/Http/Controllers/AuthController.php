<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (
            Auth::attempt([
                'username' => $request->username,
                'password' => $request->password
            ])
        ) {

            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Username atau Password salah'
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'status' => true,
            'redirect' => route('login')
        ]);
    }
}