<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index() {
        $member = Member::where('company_id', $this->companyId())
            ->orderBy('nama')
            ->get();
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
        Member::create(array_merge($request->all(), ['company_id' => $this->companyId()]));
        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan');
    }
    public function show(Member $member) {
        abort_if($member->company_id !== $this->companyId(), 403);
        return view('member.show', compact('member'));
    }
    public function edit(Member $member) {
        abort_if($member->company_id !== $this->companyId(), 403);
        return view('member.edit', compact('member'));
    }
    public function update(Request $request, Member $member) {
        abort_if($member->company_id !== $this->companyId(), 403);
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
        abort_if($member->company_id !== $this->companyId(), 403);
        $member->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus');
    }
}