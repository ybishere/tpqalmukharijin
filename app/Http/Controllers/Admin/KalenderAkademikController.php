<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        $kalender = KalenderAkademik::orderBy('tanggal_mulai', 'desc')->paginate(20);
        return view('admin.kalender.index', compact('kalender'));
    }

    public function create()
    {
        return view('admin.kalender.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'           => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis'           => 'required|in:libur,ujian,wisuda,kegiatan,pengumuman',
            'keterangan'      => 'nullable|string',
            'is_active'       => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        KalenderAkademik::create($validated);

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(KalenderAkademik $kalender)
    {
        return view('admin.kalender.edit', compact('kalender'));
    }

    public function update(Request $request, KalenderAkademik $kalender)
    {
        $validated = $request->validate([
            'judul'           => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis'           => 'required|in:libur,ujian,wisuda,kegiatan,pengumuman',
            'keterangan'      => 'nullable|string',
            'is_active'       => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $kalender->update($validated);

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(KalenderAkademik $kalender)
    {
        $kalender->delete();
        return redirect()->route('admin.kalender.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}