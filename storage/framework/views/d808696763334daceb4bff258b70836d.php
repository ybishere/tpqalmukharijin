
<?php $__env->startSection('title', 'Santri'); ?>
<?php $__env->startSection('page_title', 'Manajemen Santri'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600 font-medium">Santri</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Daftar Santri</h2>
        <div class="flex items-center gap-3 mt-1">
            <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full"><?php echo e($totalAktif); ?> aktif</span>
            <span class="text-[11px] font-semibold text-stone-400 bg-stone-100 px-2 py-0.5 rounded-full"><?php echo e($totalNonaktif); ?> nonaktif</span>
        </div>
    </div>
    <a href="<?php echo e(route('admin.santri.create')); ?>"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Santri
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Nama</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Kelas/Jilid</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Orang Tua</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">No. HP</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Status</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 font-bold text-xs
                            <?php echo e($item->jenis_kelamin === 'L' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600'); ?>">
                            <?php echo e($item->jenis_kelamin); ?>

                        </div>
                        <div>
                            <p class="font-semibold text-stone-800 text-xs"><?php echo e($item->nama); ?></p>
                            <?php if($item->tanggal_lahir): ?>
                            <p class="text-stone-400 text-[11px]"><?php echo e($item->tanggal_lahir->format('d/m/Y')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 text-xs text-stone-500"><?php echo e($item->kelas_jilid ?? '-'); ?></td>
                <td class="py-3.5 text-xs text-stone-500"><?php echo e($item->nama_orang_tua ?? '-'); ?></td>
                <td class="py-3.5 text-xs text-stone-500"><?php echo e($item->no_hp_orang_tua ?? '-'); ?></td>
                <td class="py-3.5 text-center">
                    <?php if($item->is_active): ?>
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-stone-400 bg-stone-100 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-stone-300"></span> Nonaktif
                        </span>
                    <?php endif; ?>
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center justify-end gap-2">
                        <a href="<?php echo e(route('admin.santri.edit', $item)); ?>"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.santri.destroy', $item)); ?>"
                            onsubmit="return confirm('Hapus data santri ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit"
                                class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors text-red-500">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" class="px-5 py-12 text-center text-stone-300 text-sm">Belum ada data santri</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($students->hasPages()): ?>
    <div class="px-5 py-4 border-t border-stone-100"><?php echo e($students->links()); ?></div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/santri/index.blade.php ENDPATH**/ ?>