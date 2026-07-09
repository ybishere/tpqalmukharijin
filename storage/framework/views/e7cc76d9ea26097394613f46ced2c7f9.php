

<?php $__env->startSection('title'); ?>Donasi — <?php echo e($program->nama_program); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="max-w-3xl mx-auto px-4 py-10">

    
    <div class="text-xs text-gray-400 mb-6 flex items-center gap-2">
        <a href="<?php echo e(route('beranda')); ?>" class="hover:text-green-600">Beranda</a>
        <span>/</span>
        <a href="<?php echo e(route('program.index')); ?>" class="hover:text-green-600">Program</a>
        <span>/</span>
        <a href="<?php echo e(route('program.detail', $program->id_program)); ?>" class="hover:text-green-600"><?php echo e($program->nama_program); ?></a>
        <span>/</span>
        <span class="text-gray-600">Donasi</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        
        <div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-green-600 via-yellow-400 to-green-600"></div>
                <div class="p-6">
                    <h2 class="font-bold text-gray-800 mb-1">Form Donasi</h2>
                    <p class="text-xs text-gray-400 mb-5">Isi data donasi Anda. Nominal bebas sesuai kemampuan.</p>

                    <?php if($errors->any()): ?>
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600">
                            <ul class="list-disc list-inside space-y-0.5">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($e); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('donasi.store', $program->id_program)); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>

                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Donatur</label>
                            <input type="text" name="nama_donatur" value="<?php echo e(old('nama_donatur')); ?>"
                                placeholder="Kosongkan jika ingin anonim (Hamba Allah)"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>

                        
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Nomor WhatsApp 
        <span class="text-gray-400 font-normal">(opsional, untuk notifikasi)</span>
    </label>
    <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-400">+62</span>
        <input type="text" name="no_wa_donatur" value="<?php echo e(old('no_wa_donatur')); ?>"
            placeholder="8xx-xxxx-xxxx"
            class="w-full border border-gray-200 rounded-xl pl-12 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
    </div>
    <p class="text-xs text-gray-400 mt-1">Kami akan mengirim konfirmasi donasi via WhatsApp</p>
</div>

                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nominal Donasi <span class="text-red-500">*</span></label>
                            
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                <?php $__currentLoopData = [10000, 25000, 50000, 100000, 250000, 500000]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nominal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" onclick="setNominal(<?php echo e($nominal); ?>)"
                                    class="nominal-btn border border-gray-200 rounded-xl py-2 text-xs font-semibold text-gray-600 hover:border-green-500 hover:text-green-600 hover:bg-green-50 transition">
                                    Rp <?php echo e(number_format($nominal, 0, ',', '.')); ?>

                                </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <input type="number" name="jumlah" id="inputJumlah" value="<?php echo e(old('jumlah')); ?>"
                                placeholder="Atau ketik nominal lain..."
                                min="1000"
                                class="w-full border <?php echo e($errors->has('jumlah') ? 'border-red-400 bg-red-50' : 'border-gray-200'); ?> rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Metode Pembayaran</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="metode-label cursor-pointer">
                                    <input type="radio" name="metode" value="qris" class="sr-only" <?php echo e(old('metode', 'qris') == 'qris' ? 'checked' : ''); ?>>
                                    <div class="metode-card border-2 rounded-xl p-3 text-center transition
                                        <?php echo e(old('metode', 'qris') == 'qris' ? 'border-green-500 bg-green-50' : 'border-gray-200'); ?>">
                                        <div class="text-2xl mb-1">📱</div>
                                        <p class="text-xs font-semibold text-gray-700">QRIS</p>
                                        <p class="text-[10px] text-gray-400">GoPay, Dana, OVO, dll</p>
                                    </div>
                                </label>
                                <label class="metode-label cursor-pointer">
                                    <input type="radio" name="metode" value="manual" class="sr-only" <?php echo e(old('metode') == 'manual' ? 'checked' : ''); ?>>
                                    <div class="metode-card border-2 rounded-xl p-3 text-center transition
                                        <?php echo e(old('metode') == 'manual' ? 'border-green-500 bg-green-50' : 'border-gray-200'); ?>">
                                        <div class="text-2xl mb-1">🏦</div>
                                        <p class="text-xs font-semibold text-gray-700">Transfer Bank</p>
                                        <p class="text-[10px] text-gray-400">ATM / m-banking</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Doa / Pesan <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <textarea name="catatan" rows="2" placeholder="Semoga bermanfaat..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition resize-none"><?php echo e(old('catatan')); ?></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl text-sm transition shadow-sm">
                            Lanjutkan Donasi →
                        </button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="flex flex-col gap-4">

            
            <div class="bg-green-50 rounded-2xl p-5 border border-green-100">
                <?php if($program->foto): ?>
                    <img src="<?php echo e(Storage::url($program->foto)); ?>" class="w-full h-32 object-cover rounded-xl mb-3">
                <?php endif; ?>
                <p class="text-xs text-green-600 font-semibold mb-1">Program yang didukung</p>
                <p class="font-bold text-gray-800 text-sm"><?php echo e($program->nama_program); ?></p>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed"><?php echo e(Str::limit($program->deskripsi, 100)); ?></p>
                <div class="mt-3">
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-500">Terkumpul</span>
                        <span class="font-bold text-green-600"><?php echo e($persen); ?>%</span>
                    </div>
                    <div class="w-full bg-green-100 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: <?php echo e($persen); ?>%"></div>
                    </div>
                    <div class="flex justify-between text-xs mt-1">
                        <span class="text-green-700 font-semibold">Rp <?php echo e(number_format($program->dana_terkumpul, 0, ',', '.')); ?></span>
                        <span class="text-gray-400">dari Rp <?php echo e(number_format($program->target_dana, 0, ',', '.')); ?></span>
                    </div>
                </div>
            </div>

            
            <div id="info-qris" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-700 mb-3">📱 Cara Bayar via QRIS</p>
                <div class="space-y-2">
                    <?php $__currentLoopData = [
                        'Klik Lanjutkan Donasi',
                        'Tunjukkan QR Code ke kasir atau scan sendiri',
                        'Konfirmasi via WhatsApp jika sudah bayar',
                        'Admin akan memverifikasi dalam 1x24 jam'
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-green-600 text-white text-[10px] font-bold flex items-center justify-center flex-shrink-0"><?php echo e($i+1); ?></span>
                        <p class="text-xs text-gray-600"><?php echo e($step); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div id="info-manual" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hidden">
                <p class="text-xs font-semibold text-gray-700 mb-3">🏦 Info Rekening Transfer</p>
                <div class="bg-gray-50 rounded-xl p-3 mb-3">
                    <p class="text-xs text-gray-400 mb-0.5">Bank</p>
                    <p class="font-bold text-sm text-gray-800">— (Segera hadir)</p>
                </div>
                <p class="text-xs text-gray-400">Setelah transfer, konfirmasi ke admin via WhatsApp dengan bukti transfer.</p>
            </div>

            
            <a href="https://wa.me/6281234567890?text=Assalamualaikum, saya ingin konfirmasi donasi untuk program <?php echo e(urlencode($program->nama_program)); ?>"
                target="_blank"
                class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold py-3 rounded-2xl transition shadow-sm">
                💬 Konfirmasi via WhatsApp
            </a>

        </div>
    </div>
</section>

<script>
function setNominal(val) {
    document.getElementById('inputJumlah').value = val;
    document.querySelectorAll('.nominal-btn').forEach(b => {
        b.classList.toggle('border-green-500', parseInt(b.textContent.replace(/\D/g,'').replace(',','')) === val || b.textContent.includes(new Intl.NumberFormat('id').format(val)));
        b.classList.toggle('text-green-600', parseInt(b.textContent.replace(/\D/g,'').replace(',','')) === val);
        b.classList.toggle('bg-green-50', parseInt(b.textContent.replace(/\D/g,'').replace(',','')) === val);
    });
}

// Toggle info pembayaran berdasarkan metode
document.querySelectorAll('input[name="metode"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('info-qris').classList.toggle('hidden', this.value !== 'qris');
        document.getElementById('info-manual').classList.toggle('hidden', this.value !== 'manual');

        document.querySelectorAll('.metode-card').forEach(card => {
            card.classList.remove('border-green-500', 'bg-green-50');
            card.classList.add('border-gray-200');
        });
        this.closest('.metode-label').querySelector('.metode-card').classList.add('border-green-500', 'bg-green-50');
        this.closest('.metode-label').querySelector('.metode-card').classList.remove('border-gray-200');
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/donasi/form.blade.php ENDPATH**/ ?>