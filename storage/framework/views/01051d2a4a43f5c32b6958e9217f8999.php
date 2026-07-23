

<?php $__env->startSection('title', $program->nama_program . ' — TPQ Al-Mukharijin'); ?>

<?php $__env->startSection('content'); ?>

    <section class="max-w-4xl mx-auto px-4 py-10">

        
        <div class="text-xs text-gray-400 mb-6 flex items-center gap-2">
            <a href="<?php echo e(route('beranda')); ?>" class="hover:text-green-600 transition">Beranda</a>
            <span>/</span>
            <a href="<?php echo e(route('program.index')); ?>" class="hover:text-green-600 transition">Program</a>
            <span>/</span>
            <span class="text-gray-600"><?php echo e(Str::limit($program->nama_program, 40)); ?></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            
            <div class="md:col-span-2">

                
                <div class="h-56 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl flex items-center justify-center mb-6 overflow-hidden">
                    <?php if($program->foto): ?>
                        <img src="<?php echo e(asset('storage/' . $program->foto)); ?>"
                            class="w-full h-full object-cover rounded-2xl"
                            alt="<?php echo e($program->nama_program); ?>">
                    <?php else: ?>
                        <div class="text-center">
                            <div class="text-6xl mb-2">🕌</div>
                            <div class="text-sm text-green-600 font-medium">TPQ Al-Mukharijin</div>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs px-2.5 py-1 rounded-full font-medium
                        <?php echo e($program->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'); ?>">
                        <?php echo e(ucfirst($program->status)); ?>

                    </span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-3"><?php echo e($program->nama_program); ?></h1>
                <p class="text-sm text-gray-600 leading-relaxed"><?php echo e($program->deskripsi); ?></p>

                
                <div class="mt-10">
                    <h2 class="text-sm font-bold text-gray-800 mb-4">
                        Donatur Program Ini
                        <span class="text-green-600">(<?php echo e($donasis->count()); ?>)</span>
                    </h2>

                    <?php $__empty_1 = true; $__currentLoopData = $donasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700 flex-shrink-0">
                                <?php echo e(strtoupper(substr($donasi->nama_donatur, 0, 1))); ?>

                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-700"><?php echo e($donasi->nama_donatur); ?></div>
                                <div class="text-xs text-gray-400"><?php echo e($donasi->created_at->diffForHumans()); ?></div>
                            </div>
                        </div>
                        <div class="text-sm font-bold text-green-600">
                            Rp <?php echo e(number_format($donasi->jumlah, 0, ',', '.')); ?>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-8 bg-gray-50 rounded-2xl">
                        <div class="text-3xl mb-2">🤲</div>
                        <div class="text-sm text-gray-400">Jadilah donatur pertama program ini!</div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>

            
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sticky top-20">

                    
                    <div class="mb-3">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-gray-500">Terkumpul</span>
                            <span class="font-bold text-green-600"><?php echo e($persen); ?>%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-500 to-green-400 h-3 rounded-full transition-all duration-500"
                                style="width: <?php echo e($persen); ?>%"></div>
                        </div>
                    </div>

                    
                    <div class="text-2xl font-bold text-gray-800 mb-0.5">
                        Rp <?php echo e(number_format($program->dana_terkumpul, 0, ',', '.')); ?>

                    </div>
                    <div class="text-xs text-gray-400 mb-5">
                        dari target Rp <?php echo e(number_format($program->target_dana, 0, ',', '.')); ?>

                    </div>

                    
                    <?php $sisaDana = max(0, $program->target_dana - $program->dana_terkumpul); ?>
                    <?php if($sisaDana > 0 && $program->status == 'aktif'): ?>
                    <div class="bg-green-50 rounded-xl px-4 py-3 mb-4 text-center">
                        <div class="text-xs text-gray-500 mb-0.5">Masih dibutuhkan</div>
                        <div class="text-sm font-bold text-green-700">Rp <?php echo e(number_format($sisaDana, 0, ',', '.')); ?></div>
                    </div>
                    <?php endif; ?>

                    
                    <?php if($program->status == 'aktif'): ?>
                    <a href="<?php echo e(route('donasi.form', $program->id_program)); ?>"
                        class="block text-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl text-sm transition">
                        💚 Donasi Sekarang
                    </a>
                    <?php else: ?>
                    <div class="text-center bg-gray-100 text-gray-400 font-medium py-3 rounded-xl text-sm">
                        Program sudah selesai
                    </div>
                    <?php endif; ?>

                    <div class="mt-4 text-xs text-gray-400 text-center leading-relaxed">
                        Donasi via QRIS · Aman & Transparan
                    </div>

                </div>
            </div>

        </div>

    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/program/detail.blade.php ENDPATH**/ ?>