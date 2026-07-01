<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// ── ROUTE PUBLIK ──
Route::get('/', function () {
    $programs    = \App\Models\Program::where('status', 'aktif')->take(4)->get();
    $totalDonasi = \App\Models\Donasi::where('status_bayar', 'sukses')->sum('jumlah');
    $totalProgram = \App\Models\Program::where('status', 'aktif')->count();
    $totalDonatur = \App\Models\Donasi::where('status_bayar', 'sukses')->count();
    return view('beranda', compact('programs', 'totalDonasi', 'totalProgram', 'totalDonatur'));
})->name('beranda');

Route::get('/program', function () {
    $status = request('status', 'aktif');
    $query = \App\Models\Program::query();
    if ($status != 'semua') {
        $query->where('status', $status);
    }
    $programs = $query->get();
    return view('program.index', compact('programs'));
})->name('program.index');

Route::get('/program/{id}', function ($id) {
    $program = \App\Models\Program::findOrFail($id);
    $donasis = $program->donasis()
        ->where('status_bayar', 'sukses')
        ->latest()
        ->take(10)
        ->get();
    $persen = $program->target_dana > 0
        ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
        : 0;
    return view('program.detail', compact('program', 'donasis', 'persen'));
})->name('program.detail');

// Midtrans webhook
Route::post('/donasi/webhook', [App\Http\Controllers\DonasiPublikController::class, 'webhook'])
    ->name('donasi.webhook');

Route::get('/donasi/status/{id}',   [App\Http\Controllers\DonasiPublikController::class, 'status'])->name('donasi.status');
Route::get('/donasi/{program_id}',  [App\Http\Controllers\DonasiPublikController::class, 'form'])->name('donasi.form');
Route::post('/donasi/{program_id}', [App\Http\Controllers\DonasiPublikController::class, 'store'])->name('donasi.store');

Route::get('/laporan', function () {
    $donasis = \App\Models\Donasi::with('program')
        ->where('status_bayar', 'sukses')
        ->latest()
        ->get();
    $penggunaans = \App\Models\Penggunaan::with('program')
        ->latest()
        ->get();
    $totalDonasi     = $donasis->sum('jumlah');
    $totalPenggunaan = $penggunaans->sum('jumlah');
    $totalDonatur    = $donasis->count();
    return view('laporan.publik', compact(
        'donasis', 'penggunaans',
        'totalDonasi', 'totalPenggunaan', 'totalDonatur'
    ));
})->name('laporan.publik');

// ── ROUTE PUBLIK BARU ──
Route::get('/profil',           fn() => view('profil.index'))->name('profil.index');
Route::get('/profil/memoriam',  fn() => view('profil.memoriam'))->name('profil.memoriam');
Route::get('/profil/pengasuh',  fn() => view('profil.pengasuh'))->name('profil.pengasuh');

Route::get('/kegiatan',         fn() => view('kegiatan.index'))->name('kegiatan.index');
Route::get('/kegiatan/{id}',    fn($id) => view('kegiatan.show'))->name('kegiatan.show');

Route::get('/pengumuman',       fn() => view('pengumuman.index'))->name('pengumuman.index');
Route::get('/pengumuman/{id}',  fn($id) => view('pengumuman.show'))->name('pengumuman.show');

Route::get('/alumni',           fn() => view('alumni.index'))->name('alumni.index');

Route::get('/donasi',           fn() => view('donasi.landing'))->name('donasi.landing');

// ── ROUTE ADMIN ──
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only (belum login)
    Route::middleware('guest.admin')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Harus login
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout',    [AuthController::class, 'logout'])
            ->name('logout');
        Route::get('/dashboard',  [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::get('/laporan/export-excel', [\App\Http\Controllers\Admin\LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
        Route::get('/laporan/export-pdf',   [\App\Http\Controllers\Admin\LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');

        Route::resource('/program', \App\Http\Controllers\Admin\ProgramController::class)
            ->names('program');

        Route::resource('/donasi', \App\Http\Controllers\Admin\DonasiController::class)
            ->names('donasi');
        Route::post('/donasi/{donasi}/konfirmasi', [\App\Http\Controllers\Admin\DonasiController::class, 'konfirmasi'])
            ->name('donasi.konfirmasi');

        Route::resource('/penggunaan', \App\Http\Controllers\Admin\PenggunaanController::class)
            ->names('penggunaan');

        Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])
            ->name('laporan.index');
    });

});