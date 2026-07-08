<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnis       = Alumni::orderBy('tahun_angkatan', 'desc')->orderBy('nama')->paginate(20);
        $totalAlumni   = Alumni::count();
        $totalAngkatan = Alumni::distinct('tahun_angkatan')->count();
        return view('admin.alumni.index', compact('alumnis', 'totalAlumni', 'totalAngkatan'));
    }

    public function create()
    {
        $angkatanList = Alumni::distinct()->orderBy('tahun_angkatan', 'desc')->pluck('tahun_angkatan');
        return view('admin.alumni.create', compact('angkatanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'tahun_angkatan' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'keterangan'     => 'nullable|string|max:500',
        ]);

        Alumni::create($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function edit(Alumni $alumni)
    {
        $angkatanList = Alumni::distinct()->orderBy('tahun_angkatan', 'desc')->pluck('tahun_angkatan');
        return view('admin.alumni.edit', compact('alumni', 'angkatanList'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'tahun_angkatan' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'keterangan'     => 'nullable|string|max:500',
        ]);

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumni)
    {
        $alumni->delete();
        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil dihapus.');
    }
}