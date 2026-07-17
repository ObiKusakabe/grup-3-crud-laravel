<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $firstBranch = \App\Models\Branch::where('company_id', $user->company_id)->first();
            if ($firstBranch) {
                session(['active_branch_id' => $firstBranch->id]);
            }
            
            return redirect()->intended(route('dashboard.index'))
                ->with('success', 'Selamat datang kembali, ' . $user->name . '! 👋');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email')->with('login_error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('logout_success', 'Kamu berhasil keluar. Sampai jumpa!');
    }
}