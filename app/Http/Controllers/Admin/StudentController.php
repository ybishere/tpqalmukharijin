<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('nama')->paginate(20);
        $totalAktif   = Student::where('is_active', true)->count();
        $totalNonaktif = Student::where('is_active', false)->count();
        return view('admin.santri.index', compact('students', 'totalAktif', 'totalNonaktif'));
    }

    public function create()
    {
        return view('admin.santri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua'=> 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'kelas_jilid'    => 'nullable|string|max:100',
            'is_active'      => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Student::create($validated);

        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function edit(Student $santri)
    {
        return view('admin.santri.edit', compact('santri'));
    }

    public function update(Request $request, Student $santri)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua'=> 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'kelas_jilid'    => 'nullable|string|max:100',
            'is_active'      => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $santri->update($validated);

        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(Student $santri)
    {
        $santri->delete();
        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil dihapus.');
    }
}