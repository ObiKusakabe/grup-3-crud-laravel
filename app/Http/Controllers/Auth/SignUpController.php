<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    /**
     * Show the signup form
     */
    public function showSignUp()
    {
        return view('auth.signup');
    }

    /**
     * Store new admin account with company
     */
    public function signUp(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_email' => ['required', 'email', 'unique:companies,email'],
            'company_address' => ['nullable', 'string'],
            'company_phone' => ['nullable', 'string'],
        ]);

        // Create user as admin
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create company for this admin
        $company = Company::create([
            'name' => $validated['company_name'],
            'email' => $validated['company_email'],
            'address' => $validated['company_address'] ?? null,
            'phone' => $validated['company_phone'] ?? null,
            'admin_user_id' => $user->id,
        ]);

        // Create default branch for the company
        Branch::create([
            'name' => 'Cabang Utama',
            'code' => 'CBG1',
            'is_active' => true,
            'company_id' => $company->id,
        ]);

        // Update user with company_id
        $user->update(['company_id' => $company->id]);

        // Set default branch in session for the first page load
        $firstBranch = Branch::where('company_id', $company->id)->first();
        if ($firstBranch) {
            session(['active_branch_id' => $firstBranch->id]);
        }

        // Auto login
        Auth::login($user);

        return redirect()->route('dashboard.index')->with('success', 'Selamat datang! Akun Anda telah dibuat.');
    }
}

