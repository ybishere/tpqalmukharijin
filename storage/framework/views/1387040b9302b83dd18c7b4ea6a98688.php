

<?php $__env->startSection('title', $program->nama_program); ?>
<?php $__env->startSection('page_title', 'Detail Program'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600">Home</span> <span>/</span>
    <a href="<?php echo e(route('admin.program.index')); ?>" class="text-emerald-600 hover:underline">Program</a>
    <span>/</span> <span>Detail</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <?php if($program->foto): ?>
                <img src="<?php echo e(Storage::url($program->foto)); ?>" class="w-full h-48 object-cover">
            <?php else: ?>
                <div class="w-full h-48 bg-emerald-50 flex items-center justify-center">
                    <svg class="w-16 h-16 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            <?php endif; ?>
            <div class="p-5 space-y-4">
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Nama Program</p>
                    <p class="font-bold text-gray-800"><?php echo e($program->nama_program); ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Status</p>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                        <?php echo e($program->status === 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600'); ?>">
                        <?php echo e(ucfirst($program->status)); ?>

                    </span>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Target Dana</p>
                    <p class="font-bold text-gray-800">Rp <?php echo e(number_format($program->target_dana, 0, ',', '.')); ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Dana Terkumpul</p>
                    <p class="font-bold text-emerald-600">Rp <?php echo e(number_format($program->dana_terkumpul, 0, ',', '.')); ?></p>
                </div>
                <?php
                    $persen = $program->target_dana > 0
                        ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
                        : 0;
                ?>
                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-500">Progress</span>
                        <span class="font-bold text-emerald-600"><?php echo e($persen); ?>%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: <?php echo e($persen); ?>%"></div>
                    </div>
                </div>
                <div class="flex gap-2 pt-2">
                    <a href="<?php echo e(route('admin.program.edit', $program)); ?>"
                        class="flex-1 text-center bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold py-2 rounded-xl text-sm transition-colors">
                        Edit
                    </a>
                    <form method="POST" action="<?php echo e(route('admin.program.destroy', $program)); ?>"
                        onsubmit="return confirm('Hapus program ini?')" class="flex-1">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit"
                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2 rounded-xl text-sm transition-colors">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 mb-3">Deskripsi</h3>
            <p class="text-sm text-gray-600 leading-relaxed"><?php echo e($program->deskripsi); ?></p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800">Donasi Terbaru</h3>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Donatur</th>
                        <th class="text-right text-xs font-semibold text-gray-500 px-5 py-3">Jumlah</th>
                        <th class="text-right text-xs font-semibold text-gray-500 px-5 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $program->donasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-5 py-3 font-medium text-gray-800"><?php echo e($d->nama_donatur ?? 'Anonim'); ?></td>
                        <td class="px-5 py-3 text-right text-emerald-600 font-semibold">Rp <?php echo e(number_format($d->jumlah, 0, ',', '.')); ?></td>
                        <td class="px-5 py-3 text-right text-gray-400 text-xs"><?php echo e($d->created_at->format('d/m/Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" class="px-5 py-8 text-center text-gray-400">Belum ada donasi</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/program/show.blade.php ENDPATH**/ ?>