<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest('tanggal_publish')->paginate(15);
        return view('admin.pengumuman.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'thumbnail'       => 'nullable|image|max:2048',
            'tanggal_publish' => 'required|date',
            'is_active'       => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('pengumuman', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        Announcement::create($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Announcement $pengumuman)
    {
        $validated = $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'thumbnail'       => 'nullable|image|max:2048',
            'tanggal_publish' => 'required|date',
            'is_active'       => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($pengumuman->thumbnail) {
                Storage::disk('public')->delete($pengumuman->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('pengumuman', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $pengumuman)
    {
        if ($pengumuman->thumbnail) {
            Storage::disk('public')->delete($pengumuman->thumbnail);
        }
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}