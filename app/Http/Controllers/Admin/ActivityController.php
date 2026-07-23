<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::withCount('photos')->latest('tanggal')->paginate(15);
        return view('admin.kegiatan.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'tanggal'      => 'required|date',
            'status'       => 'required|in:akan_datang,berlangsung,selesai',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('kegiatan', 'public');
        }

        $activity = Activity::create($validated);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $i => $file) {
                $path = $file->store('kegiatan/foto', 'public');
                ActivityPhoto::create([
                    'activity_id' => $activity->id,
                    'foto'        => $path,
                    'keterangan'  => $request->keterangan[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Activity $kegiatan)
    {
        $kegiatan->load('photos');
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Activity $kegiatan)
{
    $validated = $request->validate([
        'judul'        => 'required|string|max:255',
        'deskripsi'    => 'required|string',
        'tanggal'      => 'required|date',
        'status'       => 'required|in:akan_datang,berlangsung,selesai',
        'keterangan.*' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('thumbnail')) {
        if ($kegiatan->thumbnail) {
            Storage::disk('public')->delete($kegiatan->thumbnail);
        }
        $validated['thumbnail'] = $request->file('thumbnail')->store('kegiatan', 'public');
    }

    $kegiatan->update($validated);

    if ($request->hapus_foto) {
        foreach ($request->hapus_foto as $photoId) {
            $photo = ActivityPhoto::find($photoId);
            if ($photo) {
                Storage::disk('public')->delete($photo->foto);
                $photo->delete();
            }
        }
    }

    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $i => $file) {
            $path = $file->store('kegiatan/foto', 'public');
            ActivityPhoto::create([
                'activity_id' => $kegiatan->id,
                'foto'        => $path,
                'keterangan'  => $request->keterangan[$i] ?? null,
            ]);
        }
    }

    return redirect()->route('admin.kegiatan.index')
        ->with('success', 'Kegiatan berhasil diperbarui.');
}

    public function destroy(Activity $kegiatan)
    {
        if ($kegiatan->thumbnail) {
            Storage::disk('public')->delete($kegiatan->thumbnail);
        }
        foreach ($kegiatan->photos as $photo) {
            Storage::disk('public')->delete($photo->foto);
        }
        $kegiatan->photos()->delete();
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}