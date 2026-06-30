<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penggunaan;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenggunaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penggunaan::with('program')->latest();

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('search')) {
            $query->where('uraian', 'like', '%' . $request->search . '%');
        }

        $penggunaans  = $query->paginate(15)->withQueryString();
        $programs     = Program::orderBy('nama_program')->get();
        $totalDisalurkan = Penggunaan::sum('jumlah');

        return view('admin.penggunaan.index', compact('penggunaans', 'programs', 'totalDisalurkan'));
    }

    public function create()
    {
        $programs = Program::orderBy('nama_program')->get();
        return view('admin.penggunaan.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id_program',
            'uraian'     => 'required|string',
            'jumlah'     => 'required|numeric|min:1000',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'program_id.required' => 'Program wajib dipilih.',
            'uraian.required'     => 'Uraian penggunaan wajib diisi.',
            'jumlah.required'     => 'Jumlah wajib diisi.',
            'jumlah.min'          => 'Minimal jumlah Rp 1.000.',
            'bukti_foto.image'    => 'File harus berupa gambar.',
            'bukti_foto.max'      => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('bukti_foto')) {
            $validated['bukti_foto'] = $request->file('bukti_foto')->store('penggunaan', 'public');
        }

        $validated['admin_id'] = Auth::guard('admin')->id();

        Penggunaan::create($validated);

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Penggunaan dana berhasil dicatat.');
    }

    public function show(Penggunaan $penggunaan)
    {
        $penggunaan->load('program', 'admin');
        return view('admin.penggunaan.show', compact('penggunaan'));
    }

    public function edit(Penggunaan $penggunaan)
    {
        $programs = Program::orderBy('nama_program')->get();
        return view('admin.penggunaan.edit', compact('penggunaan', 'programs'));
    }

    public function update(Request $request, Penggunaan $penggunaan)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id_program',
            'uraian'     => 'required|string',
            'jumlah'     => 'required|numeric|min:1000',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('bukti_foto')) {
            if ($penggunaan->bukti_foto) {
                Storage::disk('public')->delete($penggunaan->bukti_foto);
            }
            $validated['bukti_foto'] = $request->file('bukti_foto')->store('penggunaan', 'public');
        }

        $penggunaan->update($validated);

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Penggunaan dana berhasil diperbarui.');
    }

    public function destroy(Penggunaan $penggunaan)
    {
        if ($penggunaan->bukti_foto) {
            Storage::disk('public')->delete($penggunaan->bukti_foto);
        }
        $penggunaan->delete();

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Data penggunaan berhasil dihapus.');
    }
}