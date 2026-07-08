<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Founder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FounderController extends Controller
{
    public function index()
    {
        $founders = Founder::orderBy('urutan')->get();
        $totalPengasuh = Founder::where('status', 'Pengasuh')->count();
        $totalPengajar = Founder::where('status', 'Pengajar')->count();
        return view('admin.pengasuh.index', compact('founders', 'totalPengasuh', 'totalPengajar'));
    }

    public function create()
    {
        return view('admin.pengasuh.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'foto'       => 'nullable|image|max:2048',
            'jabatan'    => 'nullable|string|max:255',
            'status'     => 'required|in:Pengasuh,Pengajar',
            'keterangan' => 'nullable|string',
            'quotes'     => 'nullable|string|max:500',
            'urutan'     => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengasuh', 'public');
        }

        $validated['urutan'] = $validated['urutan'] ?? (Founder::max('urutan') + 1);

        Founder::create($validated);

        return redirect()->route('admin.pengasuh.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Founder $pengasuh)
    {
        return view('admin.pengasuh.edit', compact('pengasuh'));
    }

    public function update(Request $request, Founder $pengasuh)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'foto'       => 'nullable|image|max:2048',
            'jabatan'    => 'nullable|string|max:255',
            'status'     => 'required|in:Pengasuh,Pengajar',
            'keterangan' => 'nullable|string',
            'quotes'     => 'nullable|string|max:500',
            'urutan'     => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            if ($pengasuh->foto) Storage::disk('public')->delete($pengasuh->foto);
            $validated['foto'] = $request->file('foto')->store('pengasuh', 'public');
        }

        $pengasuh->update($validated);

        return redirect()->route('admin.pengasuh.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Founder $pengasuh)
    {
        if ($pengasuh->foto) Storage::disk('public')->delete($pengasuh->foto);
        $pengasuh->delete();

        return redirect()->route('admin.pengasuh.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}