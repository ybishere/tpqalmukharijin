
<?php $__env->startSection('title', 'Profil TPQ – Al-Mukharijin'); ?>

<?php $__env->startSection('content'); ?>


<section class="relative pt-32 pb-20 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 40%,#064e3b 100%);">
    <div class="pattern-bg absolute inset-0 opacity-30"></div>
    <div class="relative max-w-6xl mx-auto px-6">
        <div class="max-w-2xl">
            <span class="section-label mb-4 block" style="color:#fbbf24;">Tentang Kami</span>
            <h1 class="font-extrabold text-white leading-tight mb-4"
                style="font-size:clamp(2rem,5vw,3.5rem);">
                Profil TPQ<br>
                <span class="text-amber-300">Al-Mukharijin</span>
            </h1>
            <p class="text-white/55 text-base leading-relaxed">
                Mengenal lebih dekat lembaga pendidikan Al-Quran yang telah berdiri
                dan mengabdi untuk masyarakat Desa Kreman selama puluhan tahun.
            </p>
        </div>
    </div>
</section>


<div class="sticky top-16 z-40 bg-white border-b border-stone-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex gap-1 overflow-x-auto py-2 scrollbar-hide">
            <?php $__currentLoopData = [
                ['#sejarah',  'Sejarah'],
                ['#visi-misi','Visi & Misi'],
                ['#program',  'Program'],
                ['#lokasi',   'Lokasi'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$href, $label]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($href); ?>"
                class="shrink-0 px-4 py-2 rounded-xl text-sm font-medium text-stone-600 hover:text-emerald-800 hover:bg-emerald-50 transition-all whitespace-nowrap">
                <?php echo e($label); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<section id="sejarah" class="py-24 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            
            <div class="fade-up">
                <span class="section-label mb-4 block">Sejarah Berdiri</span>
                <h2 class="font-extrabold text-stone-900 leading-tight mb-6"
                    style="font-size:clamp(1.8rem,3vw,2.5rem);">
                    Perjalanan Panjang<br>
                    <span class="text-emerald-700">Penuh Dedikasi</span>
                </h2>
                <div class="prose prose-stone max-w-none">
                    <p class="text-stone-600 leading-relaxed text-base">
                        <?php echo e($profil->sejarah ?? 
                        'TPQ Al-Mukharijin didirikan pada tahun 1991 oleh Abah Farikhin yang memiliki kepedulian tinggi terhadap pendidikan Al-Quran generasi muda.'); ?>

                    </p>
                </div>

                
                <div class="mt-10 space-y-5">
                    <?php $__currentLoopData = [
                        ['1991', 'Pendirian TPQ Al-Mukharijin oleh Abah Farikhin'],
                        ['2000', 'Pembangunan gedung TPQ pertama dengan 3 ruang belajar'],
                        ['2015', 'Umi Siti Sulasih wafat, perjuangan pengabdian tetap dilanjutkan'],
                        ['2024', 'Renovasi dan perluasan gedung TPQ'],
                        ['2025', 'Abah Farikhin wafat, estafet dilanjutkan oleh Aa Fuad'],
                        ['2026', 'Digitalisasi sistem informasi TPQ'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$tahun, $keterangan]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex gap-4 fade-up">
                        <div class="shrink-0 w-14 text-right">
                            <span class="text-xs font-bold text-emerald-700"><?php echo e($tahun); ?></span>
                        </div>
                        <div class="relative pl-4 border-l-2 border-emerald-100 pb-5 last:pb-0">
                            <div class="absolute -left-[5px] top-1 w-2 h-2 rounded-full bg-emerald-500"></div>
                            <p class="text-stone-600 text-sm leading-relaxed"><?php echo e($keterangan); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="fade-up">
                <div class="relative">
                    
                    <div class="rounded-3xl overflow-hidden"
                        style="aspect-ratio:4/3;box-shadow:0 40px 80px rgba(6,78,59,0.2);">
                        <img src="<?php echo e(asset('images/gedung-tpq-full.jpg')); ?>"
                            alt="Gedung TPQ Al-Mukharijin"
                            class="w-full h-full object-cover">
                    </div>

                    
                    <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-5 shadow-xl border border-stone-100" style="min-width:160px;">
                        <p class="text-stone-400 text-[10px] uppercase tracking-wide font-semibold mb-1">Berdiri Sejak</p>
                        <p class="text-4xl font-extrabold text-emerald-800">1991</p>
                        <p class="text-stone-500 text-xs mt-1">± 30 tahun mengabdi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="visi-misi" class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center max-w-2xl mx-auto mb-16 fade-up">
            <span class="section-label mb-4 justify-center" style="display:inline-flex;">Arah & Tujuan</span>
            <h2 class="font-extrabold text-stone-900 leading-tight"
                style="font-size:clamp(1.8rem,3vw,2.5rem);">
                Visi & Misi
            </h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">

            
            <div class="fade-up relative overflow-hidden rounded-3xl p-8"
                style="background:linear-gradient(135deg,#022c22,#064e3b);">
                <div class="pattern-bg absolute inset-0 opacity-20"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <p class="text-amber-300 text-xs font-bold uppercase tracking-widest mb-4">Visi</p>
                    <p class="text-white font-semibold text-lg leading-relaxed">
                        <?php echo e($profil->visi ?? 'Menjadi lembaga pendidikan Al-Quran yang unggul, terpercaya, dan mampu mencetak generasi Qurani yang berakhlak mulia.'); ?>

                    </p>
                </div>
            </div>

            
            <div class="fade-up bg-stone-50 rounded-3xl p-8 border border-stone-100">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <p class="text-emerald-700 text-xs font-bold uppercase tracking-widest mb-5">Misi</p>
                <ul class="space-y-4">
                    <?php $__currentLoopData = [
                        'Menyelenggarakan pendidikan Al-Quran yang berkualitas dengan metode pembelajaran efektif dan menyenangkan.',
                        'Membentuk karakter santri yang berakhlak mulia berdasarkan Al-Quran dan Sunnah.',
                        'Mengembangkan potensi santri secara optimal melalui berbagai kegiatan edukatif dan islami.',
                        'Membangun kerjasama yang harmonis antara lembaga, orang tua, dan masyarakat.',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex gap-3 items-start">
                        <span class="shrink-0 w-6 h-6 rounded-lg bg-emerald-100 flex items-center justify-center text-[11px] font-bold text-emerald-700 mt-0.5"><?php echo e($i+1); ?></span>
                        <p class="text-stone-600 text-sm leading-relaxed"><?php echo e($misi); ?></p>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</section>


<section id="program" class="py-24 bg-[#f5f5f4]">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center max-w-xl mx-auto mb-14 fade-up">
            <span class="section-label mb-4 justify-center" style="display:inline-flex;">Kurikulum</span>
            <h2 class="font-extrabold text-stone-900 leading-tight"
                style="font-size:clamp(1.8rem,3vw,2.5rem);">
                Program Unggulan
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = [
                [
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'judul' => 'Pembelajaran Jilid',
                    'desc'  => 'Program dasar membaca Al-Quran menggunakan metode Tilawati secara bertahap dari huruf hijaiyah hingga mampu membaca Al-Quran dengan lancar.',
                    'color' => 'emerald',
                ],
                [
                    'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                    'judul' => 'Tajwid & Tartil',
                    'desc'  => 'Pembelajaran hukum bacaan Al-Quran (tajwid) secara mendalam agar santri dapat membaca Al-Quran dengan tartil sesuai kaidah yang benar.',
                    'color' => 'amber',
                ],
                [
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'judul' => 'Tahfidz Juz Amma',
                    'desc'  => 'Program hafalan surat-surat pendek (Juz 30) yang diajarkan secara sistematis dengan metode talaqqi dan muraja\'ah rutin.',
                    'color' => 'blue',
                ],
                [
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                    'judul' => 'Pendidikan Akhlak',
                    'desc'  => 'Pembentukan akhlak mulia melalui pembiasaan doa harian, adab Islami, dan kisah-kisah teladan Nabi dan sahabat.',
                    'color' => 'emerald',
                ],
                [
                    'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'judul' => 'Lomba & Prestasi',
                    'desc'  => 'Persiapan dan pengiriman santri untuk mengikuti berbagai lomba Musabaqah Tilawatil Quran (MTQ) tingkat desa, kecamatan, dan kabupaten.',
                    'color' => 'amber',
                ],
                [
                    'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'judul' => 'Kegiatan Islami',
                    'desc'  => 'Berbagai kegiatan islami rutin seperti peringatan hari besar Islam, pesantren kilat Ramadhan, dan wisuda santri khatmil Quran.',
                    'color' => 'blue',
                ],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $colors = [
                    'emerald' => ['bg'=>'bg-emerald-50','icon'=>'bg-emerald-100 text-emerald-700','border'=>'hover:border-emerald-200'],
                    'amber'   => ['bg'=>'bg-amber-50',  'icon'=>'bg-amber-100 text-amber-700',   'border'=>'hover:border-amber-200'],
                    'blue'    => ['bg'=>'bg-blue-50',   'icon'=>'bg-blue-100 text-blue-700',     'border'=>'hover:border-blue-200'],
                ];
                $c = $colors[$prog['color']];
            ?>
            <div class="fade-up card p-6 <?php echo e($c['border']); ?>">
                <div class="w-12 h-12 rounded-2xl <?php echo e($c['icon']); ?> flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo e($prog['icon']); ?>"/>
                    </svg>
                </div>
                <h3 class="font-bold text-stone-900 mb-2"><?php echo e($prog['judul']); ?></h3>
                <p class="text-stone-500 text-sm leading-relaxed"><?php echo e($prog['desc']); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section id="lokasi" class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div class="fade-up">
                <span class="section-label mb-4 block">Temukan Kami</span>
                <h2 class="font-extrabold text-stone-900 leading-tight mb-8"
                    style="font-size:clamp(1.8rem,3vw,2.5rem);">
                    Lokasi & Kontak
                </h2>

                <div class="space-y-5">
                    <?php $__currentLoopData = [
                        ['icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label'=>'Alamat', 'value'=> $profil->alamat ?? 'Gang TPQ Al-Mukharijin, Desa Kreman, Kec. Warureja, Kab. Tegal, Jawa Tengah 52183'],
                        ['icon'=>'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label'=>'Telepon / WhatsApp', 'value'=> $profil->no_telp ?? '085643802541'],
                        ['icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label'=>'Email', 'value'=> $profil->email ?? 'almukharijin@gmail.com'],
                        ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label'=>'Jam Belajar', 'value'=>'Senin – Jumat: 15.30 – 17.30 WIB'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo e($info['icon']); ?>"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-stone-400 uppercase tracking-wide mb-0.5"><?php echo e($info['label']); ?></p>
                            <p class="text-stone-700 text-sm font-medium"><?php echo e($info['value']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="flex gap-3 mt-8">
                    <a href="<?php echo e(route('profil.memoriam')); ?>"
                        class="btn-primary" style="font-size:13px;padding:10px 20px;">
                        In Memoriam
                    </a>
                    <a href="<?php echo e(route('profil.pengasuh')); ?>"
                        style="display:inline-flex;align-items:center;gap:8px;background:#f5f5f4;color:#1c1917;font-size:13px;font-weight:600;padding:10px 20px;border-radius:100px;transition:all 0.2s;text-decoration:none;border:1px solid #e7e5e4;"
                        onmouseenter="this.style.background='#e7e5e4'"
                        onmouseleave="this.style.background='#f5f5f4'">
                        Pengasuh & Pengajar
                    </a>
                </div>
            </div>

            
            <div class="fade-up">
                <div class="rounded-3xl overflow-hidden border border-stone-100 shadow-lg"
                    style="aspect-ratio:4/3;background:#e8f5e9;position:relative;">
                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-stone-400">
                        <svg class="w-16 h-16 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <p class="text-sm text-stone-400">[ Google Maps Embed ]</p>
                        <a href="<?php echo e($profil->maps_url ?? 'https://maps.google.com'); ?>" target="_blank"
                            class="text-xs text-emerald-600 hover:underline font-medium">
                            Buka di Google Maps →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/profil/index.blade.php ENDPATH**/ ?>