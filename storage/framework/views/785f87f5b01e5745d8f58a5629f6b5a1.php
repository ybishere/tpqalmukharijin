
<?php $__env->startSection('title', 'Donasi Program – TPQ Al-Mukharijin'); ?>

<?php $__env->startSection('content'); ?>


<section class="relative pt-32 pb-24 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 40%,#064e3b 100%);">
    <div class="pattern-bg absolute inset-0 opacity-30"></div>
    <div class="absolute top-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.4),transparent)"></div>

    <div class="relative max-w-6xl mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16" style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.5))"></div>
                <span class="text-amber-400/70 text-[11px] font-bold uppercase tracking-[0.25em]">Donasi Program</span>
                <div class="h-px w-16" style="background:linear-gradient(to left,transparent,rgba(217,119,6,0.5))"></div>
            </div>

            <p class="font-arabic text-amber-300 text-3xl md:text-4xl leading-loose mb-3">
                مَنْ ذَا الَّذِي يُقْرِضُ اللَّهَ قَرْضًا حَسَنًا
            </p>
            <p class="text-white/35 text-sm italic mb-8">
                "Siapakah yang mau memberi pinjaman kepada Allah, pinjaman yang baik?" (QS. Al-Baqarah: 245)
            </p>

            <h1 class="font-extrabold text-white leading-tight mb-5"
                style="font-size:clamp(2rem,5vw,3.5rem);">
                Donasi untuk<br>
                <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    Program TPQ Al-Mukharijin
                </span>
            </h1>
            <p class="text-white/55 text-base leading-relaxed max-w-xl mx-auto mb-10">
                Setiap donasi Anda akan langsung mendukung program nyata di TPQ Al-Mukharijin —
                tercatat, transparan, dan berdampak langsung bagi para santri.
            </p>

            
            <div class="grid grid-cols-3 gap-4 max-w-xl mx-auto">
                <?php $persen = ($totalTarget > 0) ? min(100, round(($totalDonasi / $totalTarget) * 100)) : 0; ?>
                <?php $__currentLoopData = [
                    ['label' => 'Total Terkumpul', 'value' => 'Rp ' . number_format($totalDonasi, 0, ',', '.'), 'color' => 'text-emerald-300'],
                    ['label' => 'Total Donatur',   'value' => number_format($totalDonatur, 0, ',', '.') . ' org', 'color' => 'text-amber-300'],
                    ['label' => 'Target Tercapai', 'value' => $persen . '%', 'color' => 'text-blue-300'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-center p-4 rounded-2xl"
                    style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);">
                    <p class="font-extrabold text-lg <?php echo e($stat['color']); ?>"><?php echo e($stat['value']); ?></p>
                    <p class="text-white/40 text-[10px] mt-1 font-medium"><?php echo e($stat['label']); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60L1440 60L1440 20C1200 60 960 0 720 20C480 40 240 0 0 20L0 60Z" fill="#fafaf9"/>
        </svg>
    </div>
</section>


<section class="pt-16 pb-4 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="max-w-3xl mx-auto fade-up">

            <div class="text-center mb-10">
                <span class="section-label mb-3 justify-center" style="display:inline-flex;">Mengapa Donasi?</span>
                <h2 class="font-extrabold text-stone-900 leading-tight"
                    style="font-size:clamp(1.6rem,3vw,2.2rem);">
                    TPQ Al-Mukharijin Membutuhkan Dukungan Anda
                </h2>
            </div>

            <div class="prose prose-stone max-w-none text-stone-600 text-sm leading-relaxed space-y-4 mb-10">
                <p>
                    TPQ Al-Mukharijin telah berdiri dan mendidik generasi Qurani di Desa Kreman selama bertahun-tahun.
                    Dengan penuh keikhlasan, para pengajar terus membimbing santri demi santri agar dapat membaca,
                    memahami, dan mengamalkan Al-Quran dalam kehidupan sehari-hari.
                </p>
                <p>
                    Namun di balik semangat yang tak pernah padam, terdapat keterbatasan yang nyata —
                    fasilitas yang mulai usang, perlengkapan mengaji yang tidak mencukupi, hingga kebutuhan
                    operasional yang terus berjalan. Keterbatasan ini tidak boleh menjadi penghalang bagi
                    anak-anak untuk belajar Al-Quran.
                </p>
                <p>
                    Inilah mengapa program donasi hadir. Setiap rupiah yang Anda donasikan akan digunakan
                    untuk kebutuhan nyata yang sudah teridentifikasi — bukan sekadar dana umum, melainkan
                    untuk program dengan tujuan jelas dan laporan penggunaan yang transparan.
                </p>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <?php $__currentLoopData = [
                    ['icon' => '📖', 'judul' => 'Fasilitas Belajar', 'desc' => 'Membantu pengadaan Al-Quran, iqra, papan tulis, dan perlengkapan mengaji lainnya.'],
                    ['icon' => '🕌', 'judul' => 'Lingkungan Belajar', 'desc' => 'Mendukung perawatan dan perbaikan ruang belajar agar santri nyaman mengaji.'],
                    ['icon' => '🤲', 'judul' => 'Keberlangsungan TPQ', 'desc' => 'Memastikan TPQ dapat terus beroperasi dan melahirkan generasi Qurani.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manfaat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-center p-5 rounded-2xl bg-white border border-stone-100 shadow-sm">
                    <div class="text-3xl mb-3"><?php echo e($manfaat['icon']); ?></div>
                    <h4 class="font-bold text-stone-800 text-sm mb-2"><?php echo e($manfaat['judul']); ?></h4>
                    <p class="text-stone-500 text-xs leading-relaxed"><?php echo e($manfaat['desc']); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>
</section>


<section id="program-donasi" class="pt-12 pb-12 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-12 fade-up">
            <span class="section-label mb-3 justify-center" style="display:inline-flex;">Pilih Program</span>
            <h2 class="font-extrabold text-stone-900 leading-tight"
                style="font-size:clamp(1.8rem,3vw,2.5rem);">
                Program yang Membutuhkan Dukungan
            </h2>
            <p class="text-stone-500 text-sm mt-3 max-w-lg mx-auto">
                Pilih program yang ingin Anda dukung. Semua donasi tercatat dan
                dilaporkan secara transparan kepada publik.
            </p>
        </div>

        <?php if(isset($programs) && $programs->count()): ?>
        <div class="grid md:grid-cols-2 gap-6 mb-16">
            <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $p = $prog->target_dana > 0
                    ? min(100, round(($prog->dana_terkumpul / $prog->target_dana) * 100))
                    : 0;
                $kurang = max(0, $prog->target_dana - $prog->dana_terkumpul);
            ?>
            <div class="fade-up card p-7 flex flex-col">

                
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="badge badge-green">Aktif</span>
                            <?php if($prog->deadline): ?>
                                <?php $sisa_hari = (int) now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($prog->deadline)->startOfDay(), false); ?>
                                <?php if($sisa_hari >= 0): ?>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full
                                    <?php echo e($sisa_hari <= 7 ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-700'); ?>">
                                    ⏳ <?php echo e($sisa_hari <= 0 ? 'Hari ini!' : 'Sampai ' . \Carbon\Carbon::parse($prog->deadline)->translatedFormat('d M Y')); ?>

                                </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-extrabold text-stone-900 text-lg leading-snug"><?php echo e($prog->nama_program); ?></h3>
                    </div>
                    <div class="shrink-0 relative w-16 h-16">
                        <svg class="w-16 h-16 -rotate-90" viewBox="0 0 36 36">
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#f0fdf4" stroke-width="2.5"/>
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#10b981" stroke-width="2.5"
                                stroke-dasharray="<?php echo e($p); ?>, 100" stroke-linecap="round"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-emerald-700 font-extrabold text-xs"><?php echo e($p); ?>%</span>
                        </div>
                    </div>
                </div>

                
                <?php if($prog->deskripsi): ?>
                <p class="text-stone-500 text-sm leading-relaxed mb-4 line-clamp-2"><?php echo e($prog->deskripsi); ?></p>
                <?php endif; ?>

                
                <?php if($prog->alasan_donasi): ?>
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 mb-4">
                    <p class="text-xs font-bold text-amber-700 mb-2">🤲 Mengapa program ini perlu dukungan Anda?</p>
                    <div x-data="{ expanded: false }">
                        <p class="text-sm text-stone-600 leading-relaxed" :class="expanded ? '' : 'line-clamp-3'">
                            <?php echo e($prog->alasan_donasi); ?>

                        </p>
                        <?php if(strlen($prog->alasan_donasi) > 150): ?>
                        <button @click="expanded = !expanded"
                            class="text-xs font-semibold text-amber-700 hover:text-amber-900 mt-2 transition-colors">
                            <span x-text="expanded ? '▲ Sembunyikan' : '▼ Baca selengkapnya'"></span>
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                
                <div class="h-2 rounded-full bg-stone-100 overflow-hidden mb-4">
                    <div class="h-full rounded-full progress-fill"
                        data-width="<?php echo e($p); ?>"
                        style="width:0%;background:linear-gradient(90deg,#10b981,#f59e0b);transition:width 1.2s cubic-bezier(0.34,1.56,0.64,1);">
                    </div>
                </div>

                
                <div class="grid grid-cols-3 gap-3 mb-6">
                    <div class="text-center p-3 rounded-xl bg-stone-50">
                        <p class="text-stone-600 font-extrabold text-sm">Rp <?php echo e(number_format($prog->target_dana, 0, ',', '.')); ?></p>
                        <p class="text-stone-400 text-[10px] mt-0.5 font-medium">Target</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-emerald-50">
                        <p class="text-emerald-700 font-extrabold text-sm">Rp <?php echo e(number_format($prog->dana_terkumpul, 0, ',', '.')); ?></p>
                        <p class="text-stone-400 text-[10px] mt-0.5 font-medium">Terkumpul</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-red-50">
                        <p class="text-red-600 font-extrabold text-sm">Rp <?php echo e(number_format($kurang, 0, ',', '.')); ?></p>
                        <p class="text-stone-400 text-[10px] mt-0.5 font-medium">Kekurangan</p>
                    </div>
                </div>

                
                <div class="mt-auto">
                    <a href="<?php echo e(route('donasi.form', $prog->id_program)); ?>"
                        class="btn-primary w-full justify-center"
                        style="font-size:14px;padding:12px 24px;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Donasi untuk Program Ini
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16 border-2 border-dashed border-stone-200 rounded-3xl mb-16">
            <p class="text-stone-400 text-sm">Belum ada program donasi aktif.</p>
        </div>
        <?php endif; ?>

    </div>
</section>


<section class="py-16 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="fade-up rounded-3xl p-10 relative overflow-hidden"
            style="background:linear-gradient(135deg,#022c22,#064e3b);">
            <div class="pattern-bg absolute inset-0 opacity-15"></div>
            <div class="relative">
                <div class="text-center mb-10">
                    <span class="text-amber-300 text-[11px] font-bold uppercase tracking-widest">Panduan</span>
                    <h3 class="font-extrabold text-white text-xl mt-2">Cara Berdonasi</h3>
                </div>
                <div class="grid md:grid-cols-4 gap-6">
                    <?php $__currentLoopData = [
                        ['step' => '01', 'judul' => 'Pilih Program', 'desc' => 'Pilih program donasi yang ingin Anda dukung dari daftar di atas.'],
                        ['step' => '02', 'judul' => 'Isi Data', 'desc' => 'Isi nama, nomor WhatsApp, dan jumlah donasi yang ingin Anda berikan.'],
                        ['step' => '03', 'judul' => 'Pembayaran', 'desc' => 'Lakukan pembayaran melalui berbagai metode yang tersedia via Midtrans.'],
                        ['step' => '04', 'judul' => 'Konfirmasi', 'desc' => 'Donasi Anda tercatat dan notifikasi dikirim ke WhatsApp Anda.'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-4 font-extrabold text-lg"
                            style="background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.25);color:#fbbf24;">
                            <?php echo e($step['step']); ?>

                        </div>
                        <h4 class="text-white font-bold text-sm mb-2"><?php echo e($step['judul']); ?></h4>
                        <p class="text-white/40 text-xs leading-relaxed"><?php echo e($step['desc']); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="pb-20 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="fade-up rounded-3xl p-8 text-center"
            style="background:linear-gradient(135deg,#f0fdf4,#ecfdf5);border:2px solid #bbf7d0;">
            <div class="w-12 h-12 rounded-2xl bg-emerald-600 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-extrabold text-stone-900 text-xl mb-2">Laporan Keuangan Transparan</h3>
            <p class="text-stone-500 text-sm mb-6 max-w-md mx-auto">
                Kami berkomitmen penuh pada transparansi. Lihat secara detail bagaimana setiap donasi Anda digunakan untuk kemajuan TPQ Al-Mukharijin.
            </p>
            <a href="<?php echo e(route('laporan.publik')); ?>"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-8 py-3 rounded-2xl text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Lihat Laporan Keuangan Lengkap
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            if (e.target.classList.contains('fade-up')) e.target.classList.add('visible');
            if (e.target.classList.contains('progress-fill')) {
                setTimeout(() => {
                    e.target.style.width = (e.target.dataset.width || 0) + '%';
                }, 200);
            }
            io.unobserve(e.target);
        }
    });
}, { threshold: 0.15 });
document.querySelectorAll('.fade-up, .progress-fill').forEach(el => io.observe(el));
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/donasi/landing.blade.php ENDPATH**/ ?>