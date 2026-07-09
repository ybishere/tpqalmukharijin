<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:200',
            'deskripsi'    => 'required|string',
            'alasan_donasi'=> 'nullable|string',
            'deadline'     => 'nullable|date',
            'target_dana'  => 'required|numeric|min:0',
            'status'       => 'required|in:aktif,selesai',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_program.required' => 'Nama program wajib diisi.',
            'deskripsi.required'    => 'Deskripsi wajib diisi.',
            'target_dana.required'  => 'Target dana wajib diisi.',
            'target_dana.numeric'   => 'Target dana harus berupa angka.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.max'              => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('program', 'public');
        }

        Program::create($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $program)
    {
        $program->load(['donasis' => fn($q) => $q->where('status_bayar', 'sukses')->latest()->take(10)]);
        return view('admin.program.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:200',
            'deskripsi'    => 'required|string',
            'alasan_donasi'=> 'nullable|string',
            'deadline'     => 'nullable|date',
            'target_dana'  => 'required|numeric|min:0',
            'status'       => 'required|in:aktif,selesai',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($program->foto) {
                Storage::disk('public')->delete($program->foto);
            }
            $validated['foto'] = $request->file('foto')->store('program', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        if ($program->foto) {
            Storage::disk('public')->delete($program->foto);
        }
        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}