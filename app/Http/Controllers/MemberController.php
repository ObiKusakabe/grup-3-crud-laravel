<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index() {
        $member = Member::orderBy('nama')->get();
        return view('member.index', compact('member'));
    }
    public function create() {
        return view('member.create');
    }
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
            'diskon_persen' => 'nullable|numeric|min:0|max:100'
        ]);
        Member::create($request->all());
        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan');
    }
    public function show(Member $member) {
        return view('member.show', compact('member'));
    }
    public function edit(Member $member) {
        return view('member.edit', compact('member'));
    }
    public function update(Request $request, Member $member) {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
            'diskon_persen' => 'nullable|numeric|min:0|max:100'
        ]);
        $member->update($request->all());
        return redirect()->route('member.index')->with('success', 'Member berhasil diupdate');
    }
    public function destroy(Member $member) {
        $member->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus');
    }
}