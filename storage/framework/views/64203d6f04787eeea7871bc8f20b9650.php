
<?php $__env->startSection('title', 'Pengasuh & Pengajar'); ?>
<?php $__env->startSection('page_title', 'Pengasuh & Pengajar'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600 font-medium">Pengasuh & Pengajar</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Daftar Pengasuh & Pengajar</h2>
        <div class="flex items-center gap-3 mt-1">
            <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full"><?php echo e($totalPengasuh); ?> Pengasuh</span>
            <span class="text-[11px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full"><?php echo e($totalPengajar); ?> Pengajar</span>
        </div>
    </div>
    <a href="<?php echo e(route('admin.pengasuh.create')); ?>"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Nama</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Jabatan</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Status</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Urutan</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            <?php $__empty_1 = true; $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <?php if($item->foto): ?>
                        <img src="<?php echo e(Storage::url($item->foto)); ?>"
                            class="w-10 h-10 rounded-xl object-cover flex-shrink-0 border border-stone-100">
                        <?php else: ?>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-semibold text-stone-800 text-xs"><?php echo e($item->nama); ?></p>
                            <?php if($item->quotes): ?>
                            <p class="text-stone-400 text-[11px] mt-0.5 italic truncate max-w-[200px]">"<?php echo e(Str::limit($item->quotes, 50)); ?>"</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 text-xs text-stone-500"><?php echo e($item->jabatan ?? '-'); ?></td>
                <td class="py-3.5 text-center">
                    <?php if($item->status === 'Pengasuh'): ?>
                        <span class="inline-flex text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">Pengasuh</span>
                    <?php else: ?>
                        <span class="inline-flex text-[11px] font-semibold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full">Pengajar</span>
                    <?php endif; ?>
                </td>
                <td class="py-3.5 text-center text-xs text-stone-400"><?php echo e($item->urutan); ?></td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center justify-end gap-2">
                        <a href="<?php echo e(route('admin.pengasuh.edit', $item)); ?>"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.pengasuh.destroy', $item)); ?>"
                            onsubmit="return confirm('Hapus data ini?')">
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
            <tr><td colspan="5" class="px-5 py-12 text-center text-stone-300 text-sm">Belum ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/pengasuh/index.blade.php ENDPATH**/ ?>