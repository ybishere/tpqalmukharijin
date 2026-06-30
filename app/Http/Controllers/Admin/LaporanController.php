<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Penggunaan;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $program_id = $request->program_id;
        $bulan      = $request->bulan;
        $tahun      = $request->tahun ?? date('Y');

        // Query donasi
        $queryDonasi = Donasi::with('program')
            ->where('status_bayar', 'sukses');

        if ($program_id) $queryDonasi->where('program_id', $program_id);
        if ($bulan)      $queryDonasi->whereMonth('created_at', $bulan);
        $queryDonasi->whereYear('created_at', $tahun);

        $donasis = $queryDonasi->latest()->get();

        // Query penggunaan
        $queryPenggunaan = Penggunaan::with('program');

        if ($program_id) $queryPenggunaan->where('program_id', $program_id);
        if ($bulan)      $queryPenggunaan->whereMonth('created_at', $bulan);
        $queryPenggunaan->whereYear('created_at', $tahun);

        $penggunaans = $queryPenggunaan->latest()->get();

        // Summary
        $totalDonasi     = $donasis->sum('jumlah');
        $totalPenggunaan = $penggunaans->sum('jumlah');
        $totalDonatur    = $donasis->count();
        $sisaDana        = $totalDonasi - $totalPenggunaan;

        // Donasi per bulan (untuk chart)
        $donasiPerBulan = Donasi::where('status_bayar', 'sukses')
            ->whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $programs = Program::orderBy('nama_program')->get();

        return view('admin.laporan.index', compact(
            'donasis', 'penggunaans', 'programs',
            'totalDonasi', 'totalPenggunaan', 'totalDonatur', 'sisaDana',
            'donasiPerBulan', 'tahun', 'bulan', 'program_id'
        ));
    }
    public function exportExcel(Request $request)
{
    $tahun      = $request->tahun ?? date('Y');
    $bulan      = $request->bulan;
    $program_id = $request->program_id;

    $filename = 'laporan-tpq-' . $tahun . ($bulan ? '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) : '') . '.xlsx';

    return Excel::download(
        new LaporanExport($tahun, $bulan, $program_id),
        $filename
    );
}

public function exportPdf(Request $request)
{
    $tahun      = $request->tahun ?? date('Y');
    $bulan      = $request->bulan;
    $program_id = $request->program_id;

    $queryDonasi = Donasi::with('program')
        ->where('status_bayar', 'sukses')
        ->whereYear('created_at', $tahun);

    if ($bulan)      $queryDonasi->whereMonth('created_at', $bulan);
    if ($program_id) $queryDonasi->where('program_id', $program_id);

    $donasis = $queryDonasi->latest()->get();

    $queryPenggunaan = Penggunaan::with('program')
        ->whereYear('created_at', $tahun);

    if ($bulan)      $queryPenggunaan->whereMonth('created_at', $bulan);
    if ($program_id) $queryPenggunaan->where('program_id', $program_id);

    $penggunaans     = $queryPenggunaan->latest()->get();
    $totalDonasi     = $donasis->sum('jumlah');
    $totalPenggunaan = $penggunaans->sum('jumlah');
    $sisaDana        = $totalDonasi - $totalPenggunaan;

    $bulanNama = $bulan ? ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'][$bulan] : 'Semua Bulan';

    $pdf = Pdf::loadView('admin.laporan.pdf', compact(
        'donasis', 'penggunaans',
        'totalDonasi', 'totalPenggunaan', 'sisaDana',
        'tahun', 'bulanNama'
    ))->setPaper('a4', 'portrait');

    return $pdf->download('laporan-tpq-' . $tahun . '.pdf');
}
}