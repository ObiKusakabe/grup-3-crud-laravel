<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees for the admin's company
     */
    public function index()
    {
        $employees = User::where('company_id', auth()->user()->company_id)
            ->where('id', '!=', auth()->id()) // exclude self
            ->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee
     */
    public function create()
    {
        $roles = ['pos', 'inventaris'];
        return view('employees.create', compact('roles'));
    }

    /**
     * Store a newly created employee in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:pos,inventaris'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'company_id' => auth()->user()->company_id,
            'created_by' => auth()->id(),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified employee
     */
    public function edit(User $employee)
    {
        // Authorization check
        if ($employee->created_by !== auth()->id() && $employee->id !== auth()->id()) {
            abort(403);
        }

        $roles = ['pos', 'inventaris'];
        return view('employees.edit', compact('employee', 'roles'));
    }

    /**
     * Update the specified employee in storage
     */
    public function update(Request $request, User $employee)
    {
        // Authorization check
        if ($employee->created_by !== auth()->id() && $employee->id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $employee->id],
            'role' => ['required', 'in:pos,inventaris'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        if (!empty($validated['password'])) {
            $employee->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('employees.index')
            ->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified employee from storage
     */
    public function destroy(User $employee)
    {
        // Authorization check
        if ($employee->created_by !== auth()->id()) {
            abort(403);
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Pegawai berhasil dihapus.');
    }
}

