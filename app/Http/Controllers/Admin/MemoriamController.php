<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Memoriam;
use App\Models\MemoriamPhoto;
use App\Models\MemoriamQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemoriamController extends Controller
{
    public function index()
    {
        $memoriam = Memoriam::withCount(['photos', 'quotes'])->orderBy('urutan')->get();
        return view('admin.memoriam.index', compact('memoriam'));
    }

    public function create()
    {
        return view('admin.memoriam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'foto'        => 'nullable|image|max:2048',
            'tahun_lahir' => 'nullable|digits:4|integer',
            'tahun_wafat' => 'nullable|digits:4|integer',
            'biografi'    => 'nullable|string',
            'urutan'      => 'nullable|integer',
            'quotes.*'    => 'nullable|string|max:500',
            'foto_album.*'=> 'nullable|image|max:2048',
            'keterangan.*'=> 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('memoriam', 'public');
        }

        $validated['urutan'] = $validated['urutan'] ?? (Memoriam::max('urutan') + 1);

        $memoriam = Memoriam::create($validated);

        // Simpan quotes
        if ($request->quotes) {
            foreach (array_filter($request->quotes) as $quote) {
                MemoriamQuote::create(['memoriam_id' => $memoriam->id, 'quote' => $quote]);
            }
        }

        // Simpan foto album
        if ($request->hasFile('foto_album')) {
            foreach ($request->file('foto_album') as $i => $file) {
                $path = $file->store('memoriam/foto', 'public');
                MemoriamPhoto::create([
                    'memoriam_id' => $memoriam->id,
                    'foto'        => $path,
                    'keterangan'  => $request->keterangan[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.memoriam.index')
            ->with('success', 'Data In Memoriam berhasil ditambahkan.');
    }

    public function edit(Memoriam $memoriam)
    {
        $memoriam->load(['quotes', 'photos']);
        return view('admin.memoriam.edit', compact('memoriam'));
    }

    public function update(Request $request, Memoriam $memoriam)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'foto'        => 'nullable|image|max:2048',
            'tahun_lahir' => 'nullable|digits:4|integer',
            'tahun_wafat' => 'nullable|digits:4|integer',
            'biografi'    => 'nullable|string',
            'urutan'      => 'nullable|integer',
            'quotes.*'    => 'nullable|string|max:500',
            'foto_album.*'=> 'nullable|image|max:2048',
            'keterangan.*'=> 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            if ($memoriam->foto) Storage::disk('public')->delete($memoriam->foto);
            $validated['foto'] = $request->file('foto')->store('memoriam', 'public');
        }

        $memoriam->update($validated);

        // Update quotes — hapus semua lalu insert ulang
        $memoriam->quotes()->delete();
        if ($request->quotes) {
            foreach (array_filter($request->quotes) as $quote) {
                MemoriamQuote::create(['memoriam_id' => $memoriam->id, 'quote' => $quote]);
            }
        }

        // Hapus foto yang dicentang
        if ($request->hapus_foto) {
            foreach ($request->hapus_foto as $photoId) {
                $photo = MemoriamPhoto::find($photoId);
                if ($photo) {
                    Storage::disk('public')->delete($photo->foto);
                    $photo->delete();
                }
            }
        }

        // Upload foto baru
        if ($request->hasFile('foto_album')) {
            foreach ($request->file('foto_album') as $i => $file) {
                $path = $file->store('memoriam/foto', 'public');
                MemoriamPhoto::create([
                    'memoriam_id' => $memoriam->id,
                    'foto'        => $path,
                    'keterangan'  => $request->keterangan[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.memoriam.index')
            ->with('success', 'Data In Memoriam berhasil diperbarui.');
    }

    public function destroy(Memoriam $memoriam)
    {
        if ($memoriam->foto) Storage::disk('public')->delete($memoriam->foto);
        foreach ($memoriam->photos as $photo) {
            Storage::disk('public')->delete($photo->foto);
        }
        $memoriam->photos()->delete();
        $memoriam->quotes()->delete();
        $memoriam->delete();

        return redirect()->route('admin.memoriam.index')
            ->with('success', 'Data In Memoriam berhasil dihapus.');
    }
}