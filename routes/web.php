<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// ── ROUTE PUBLIK ──

Route::get('/', function () {
    $totalDonasi      = \App\Models\Donasi::where('status_bayar', 'sukses')->sum('jumlah');
    $totalSantri      = \App\Models\Student::where('is_active', true)->count();
    $totalPengajar    = \App\Models\Founder::where('status', 'Pengajar')->count();
    $totalAlumni      = \App\Models\Alumni::count();
    $kegiatan         = \App\Models\Activity::latest('tanggal')->take(3)->get();
    $pengumuman       = \App\Models\Announcement::where('is_active', true)->latest('tanggal_publish')->take(3)->get();
    $kegiatanTerdekat = \App\Models\Activity::where('status', 'akan_datang')
                            ->where('tanggal', '>=', now())->orderBy('tanggal')->first();
    $programs         = \App\Models\Program::where('status', 'aktif')->take(4)->get();
    $totalTarget      = \App\Models\Program::where('status', 'aktif')->sum('target_dana');
    return view('beranda', compact(
        'totalDonasi', 'totalSantri', 'totalPengajar', 'totalAlumni',
        'kegiatan', 'pengumuman', 'kegiatanTerdekat', 'programs', 'totalTarget'
    ));
})->name('beranda');

Route::get('/program', function () {
    $status = request('status', 'aktif');
    $query  = \App\Models\Program::query();
    if ($status != 'semua') $query->where('status', $status);
    $programs = $query->get();
    return view('program.index', compact('programs'));
})->name('program.index');

Route::get('/program/{id}', function ($id) {
    $program = \App\Models\Program::findOrFail($id);
    $donasis = $program->donasis()->where('status_bayar', 'sukses')->latest()->take(10)->get();
    $persen  = $program->target_dana > 0
        ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
        : 0;
    return view('program.detail', compact('program', 'donasis', 'persen'));
})->name('program.detail');

// ── DONASI ──
// Webhook & status harus di atas wildcard {program_id}
Route::post('/donasi/webhook', [App\Http\Controllers\DonasiPublikController::class, 'webhook'])
    ->name('donasi.webhook');

Route::get('/donasi/status/{id}', [App\Http\Controllers\DonasiPublikController::class, 'status'])
    ->name('donasi.status');

// Simulasi pembayaran sukses (hanya untuk testing lokal)
if (app()->environment('local')) {
    Route::get('/donasi/{id}/simulasi-sukses', [App\Http\Controllers\DonasiPublikController::class, 'simulasiSukses'])
        ->name('donasi.simulasi');
}

// Landing page donasi — sebelum wildcard
Route::get('/donasi', function () {
    $programs     = \App\Models\Program::where('status', 'aktif')->get();
    $totalDonasi  = \App\Models\Donasi::where('status_bayar', 'sukses')->sum('jumlah');
    $totalDonatur = \App\Models\Donasi::where('status_bayar', 'sukses')->count();
    $totalTarget  = \App\Models\Program::where('status', 'aktif')->sum('target_dana');
    return view('donasi.landing', compact('programs', 'totalDonasi', 'totalDonatur', 'totalTarget'));
})->name('donasi.landing');

// Infaq Kamisan
Route::get('/infaq', function () {
    $profil = \App\Models\Profile::first();
    return view('infaq.index', compact('profil'));
})->name('infaq.index');

// Form donasi — wildcard dengan constraint angka saja
Route::get('/donasi/{program_id}', [App\Http\Controllers\DonasiPublikController::class, 'form'])
    ->where('program_id', '[0-9]+')
    ->name('donasi.form');

Route::post('/donasi/{program_id}', [App\Http\Controllers\DonasiPublikController::class, 'store'])
    ->where('program_id', '[0-9]+')
    ->name('donasi.store');

// ── LAPORAN ──
Route::get('/laporan', function () {
    $donasis         = \App\Models\Donasi::with('program')->where('status_bayar', 'sukses')->latest()->get();
    $penggunaans     = \App\Models\Penggunaan::with('program')->latest()->get();
    $totalDonasi     = $donasis->sum('jumlah');
    $totalPenggunaan = $penggunaans->sum('jumlah');
    $totalDonatur    = $donasis->count();
    return view('laporan.publik', compact('donasis', 'penggunaans', 'totalDonasi', 'totalPenggunaan', 'totalDonatur'));
})->name('laporan.publik');

// ── PROFIL ──
Route::get('/profil', function () {
    $profil = \App\Models\Profile::first();
    return view('profil.index', compact('profil'));
})->name('profil.index');

Route::get('/profil/memoriam', function () {
    $memoriam = \App\Models\Memoriam::with(['quotes', 'photos'])->orderBy('urutan')->get();
    return view('profil.memoriam', compact('memoriam'));
})->name('profil.memoriam');

Route::get('/profil/pengasuh', function () {
    $founders = \App\Models\Founder::orderBy('urutan')->get();
    return view('profil.pengasuh', compact('founders'));
})->name('profil.pengasuh');

// ── KEGIATAN ──
Route::get('/kegiatan', function () {
    $allPhotos = \App\Models\ActivityPhoto::with('activity')
        ->whereHas('activity', fn($q) => $q->where('status', 'selesai'))
        ->inRandomOrder()
        ->take(20)
        ->get()
        ->map(fn($p) => [
            'url'        => Storage::url($p->foto),
            'judul'      => $p->activity->judul ?? 'Kegiatan TPQ',
            'tanggal'    => $p->activity
                ? \Carbon\Carbon::parse($p->activity->tanggal)->translatedFormat('d F Y')
                : '',
            'keterangan' => $p->keterangan ?? '',
        ]);

    $kegiatan = \App\Models\Activity::with('photos')
        ->where('status', 'selesai')
        ->latest('tanggal')
        ->paginate(9);

    return view('kegiatan.index', compact('kegiatan', 'allPhotos'));
})->name('kegiatan.index');

Route::get('/kegiatan/{id}', function ($id) {
    $kegiatan = \App\Models\Activity::with('photos')->findOrFail($id);
    $lainnya  = \App\Models\Activity::where('id', '!=', $id)->latest('tanggal')->take(3)->get();
    return view('kegiatan.show', compact('kegiatan', 'lainnya'));
})->name('kegiatan.show');

// ── PENGUMUMAN ──
Route::get('/pengumuman', function () {
    $pengumuman = \App\Models\Announcement::where('is_active', true)
        ->latest('tanggal_publish')->paginate(8);

    $pengumumanDates = \App\Models\Announcement::where('is_active', true)
        ->pluck('tanggal_publish')
        ->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))
        ->toArray();

    $agendaTerdekat = \App\Models\Announcement::where('is_active', true)
        ->where('tanggal_publish', '>=', now())
        ->orderBy('tanggal_publish')->first();

    $agendaAkanDatang = \App\Models\Activity::where('status', 'akan_datang')
        ->where('tanggal', '>=', now())
        ->orderBy('tanggal')->take(4)->get();

    return view('pengumuman.index', compact(
        'pengumuman', 'pengumumanDates', 'agendaTerdekat', 'agendaAkanDatang'
    ));
})->name('pengumuman.index');

Route::get('/pengumuman/{id}', function ($id) {
    $pengumuman = \App\Models\Announcement::where('is_active', true)->findOrFail($id);
    $lainnya    = \App\Models\Announcement::where('is_active', true)
        ->where('id', '!=', $id)->latest('tanggal_publish')->take(4)->get();
    return view('pengumuman.show', compact('pengumuman', 'lainnya'));
})->name('pengumuman.show');

// ── ALUMNI ──
Route::get('/alumni', function () {
    $alumni          = \App\Models\Alumni::orderBy('tahun_angkatan', 'desc')->orderBy('nama')->get();
    $totalAlumni     = $alumni->count();
    $totalAngkatan   = $alumni->pluck('tahun_angkatan')->unique()->count();
    $angkatanPertama = $alumni->pluck('tahun_angkatan')->min() ?? '-';
    $angkatanList    = $alumni->pluck('tahun_angkatan')->unique()->sortDesc()->values();
    return view('alumni.index', compact(
        'alumni', 'totalAlumni', 'totalAngkatan', 'angkatanPertama', 'angkatanList'
    ));
})->name('alumni.index');

// ── ROUTE ADMIN ──
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest.admin')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/laporan/export-excel', [\App\Http\Controllers\Admin\LaporanController::class, 'exportExcel'])
            ->name('laporan.export.excel');
        Route::get('/laporan/export-pdf', [\App\Http\Controllers\Admin\LaporanController::class, 'exportPdf'])
            ->name('laporan.export.pdf');

        Route::resource('/program',    \App\Http\Controllers\Admin\ProgramController::class)->names('program');
        Route::resource('/donasi',     \App\Http\Controllers\Admin\DonasiController::class)->names('donasi');
        Route::resource('/penggunaan', \App\Http\Controllers\Admin\PenggunaanController::class)->names('penggunaan');

        Route::post('/donasi/{donasi}/konfirmasi', [\App\Http\Controllers\Admin\DonasiController::class, 'konfirmasi'])
            ->name('donasi.konfirmasi');

        Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])
            ->name('laporan.index');


        Route::resource('/pengumuman', \App\Http\Controllers\Admin\AnnouncementController::class)
            ->names('pengumuman');

        Route::resource('/kegiatan', \App\Http\Controllers\Admin\ActivityController::class)
            ->names('kegiatan');
        
        Route::resource('/santri', \App\Http\Controllers\Admin\StudentController::class)
            ->names('santri');

        Route::resource('/alumni', \App\Http\Controllers\Admin\AlumniController::class)
            ->names('alumni')
            ->parameters(['alumni' => 'alumni']);

        Route::get('/profil', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profil.update');

        Route::resource('/memoriam', \App\Http\Controllers\Admin\MemoriamController::class)
            ->names('memoriam');

        Route::resource('/pengasuh', \App\Http\Controllers\Admin\FounderController::class)
            ->names('pengasuh');

        Route::resource('/prestasi', \App\Http\Controllers\Admin\PrestasiController::class)
            ->names('prestasi');

        Route::resource('/kalender', \App\Http\Controllers\Admin\KalenderAkademikController::class)
            ->names('kalender');
    });
});