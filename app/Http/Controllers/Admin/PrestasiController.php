<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Student;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::with('student')
            ->orderBy('tahun', 'desc')
            ->orderBy('tingkat')
            ->paginate(20);

        $totalPrestasi = Prestasi::count();
        $totalSantri   = Prestasi::distinct('student_id')->count();

        return view('admin.prestasi.index', compact('prestasi', 'totalPrestasi', 'totalSantri'));
    }

    public function create()
    {
        $students = Student::orderBy('nama')->get();
        return view('admin.prestasi.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'judul'      => 'required|string|max:255',
            'tingkat'    => 'required|in:desa,kecamatan,kabupaten,provinsi,nasional',
            'juara'      => 'required|string|max:100',
            'kategori'   => 'nullable|string|max:100',
            'tahun'      => 'required|integer|min:2000|max:' . date('Y'),
            'keterangan' => 'nullable|string',
        ]);

        Prestasi::create($validated);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi)
    {
        $students = Student::orderBy('nama')->get();
        return view('admin.prestasi.edit', compact('prestasi', 'students'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'judul'      => 'required|string|max:255',
            'tingkat'    => 'required|in:desa,kecamatan,kabupaten,provinsi,nasional',
            'juara'      => 'required|string|max:100',
            'kategori'   => 'nullable|string|max:100',
            'tahun'      => 'required|integer|min:2000|max:' . date('Y'),
            'keterangan' => 'nullable|string',
        ]);

        $prestasi->update($validated);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }
}