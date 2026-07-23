

<?php $__env->startSection('title', 'Program'); ?>
<?php $__env->startSection('page_title', 'Manajemen Program'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600">Home</span>
    <span>/</span>
    <span>Program</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h3 class="text-lg font-bold text-gray-800">Daftar Program</h3>
        <p class="text-sm text-gray-500">Total <?php echo e($programs->total()); ?> program</p>
    </div>
    <a href="<?php echo e(route('admin.program.create')); ?>"
        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Program
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Program</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Target Dana</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Terkumpul</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Progress</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <?php if($program->foto): ?>
                                <img src="<?php echo e(Storage::url($program->foto)); ?>" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-800 truncate max-w-[200px]"><?php echo e($program->nama_program); ?></p>
                                <p class="text-xs text-gray-400 truncate max-w-[200px]"><?php echo e(Str::limit($program->deskripsi, 50)); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-gray-700 font-medium">
                        Rp <?php echo e(number_format($program->target_dana, 0, ',', '.')); ?>

                    </td>
                    <td class="px-5 py-4 text-emerald-600 font-semibold">
                        Rp <?php echo e(number_format($program->dana_terkumpul, 0, ',', '.')); ?>

                    </td>
                    <td class="px-5 py-4">
                        <?php
                            $persen = $program->target_dana > 0
                                ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
                                : 0;
                        ?>
                        <div class="flex items-center gap-2">
                            <div class="w-24 bg-gray-100 rounded-full h-1.5">
                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: <?php echo e($persen); ?>%"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-600"><?php echo e($persen); ?>%</span>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            <?php echo e($program->status === 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600'); ?>">
                            <?php echo e(ucfirst($program->status)); ?>

                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('admin.program.show', $program)); ?>"
                                class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="<?php echo e(route('admin.program.edit', $program)); ?>"
                                class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center text-amber-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.program.destroy', $program)); ?>"
                                onsubmit="return confirm('Hapus program ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        Belum ada program
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($programs->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100">
        <?php echo e($programs->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/program/index.blade.php ENDPATH**/ ?>