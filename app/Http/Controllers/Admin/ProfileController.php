<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profil = Profile::firstOrCreate([], [
            'nama_tpq' => 'TPQ Al-Mukharijin',
        ]);
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_tpq'  => 'required|string|max:255',
            'sejarah'   => 'nullable|string',
            'visi'      => 'nullable|string',
            'misi'      => 'nullable|string',
            'alamat'    => 'nullable|string',
            'no_telp'   => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
            'maps_url'  => 'nullable|url|max:500',
            'facebook'  => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube'   => 'nullable|string|max:255',
        ]);

        Profile::first()->update($validated);

        return redirect()->route('admin.profil.edit')
            ->with('success', 'Profil TPQ berhasil diperbarui.');
    }
}