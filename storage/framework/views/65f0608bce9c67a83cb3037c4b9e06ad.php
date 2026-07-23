
<?php $__env->startSection('title', 'In Memoriam'); ?>
<?php $__env->startSection('page_title', 'In Memoriam'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600 font-medium">In Memoriam</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Daftar In Memoriam</h2>
        <p class="text-xs text-stone-400 mt-0.5"><?php echo e($memoriam->count()); ?> tokoh</p>
    </div>
    <a href="<?php echo e(route('admin.memoriam.create')); ?>"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Tokoh
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Tokoh</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Tahun</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Wasiat</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Foto</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Urutan</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            <?php $__empty_1 = true; $__currentLoopData = $memoriam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <?php if($item->foto): ?>
                        <img src="<?php echo e(Storage::url($item->foto)); ?>"
                            class="w-10 h-10 rounded-xl object-cover flex-shrink-0 border border-stone-100">
                        <?php else: ?>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-semibold text-stone-800 text-xs"><?php echo e($item->nama); ?></p>
                            <?php if($item->biografi): ?>
                            <p class="text-stone-400 text-[11px] mt-0.5"><?php echo e(Str::limit($item->biografi, 50)); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 text-xs text-stone-500">
                    <?php echo e($item->tahun_lahir ?? '?'); ?> — <?php echo e($item->tahun_wafat ?? '?'); ?>

                </td>
                <td class="py-3.5 text-center">
                    <span class="text-xs font-semibold text-stone-500"><?php echo e($item->quotes_count); ?></span>
                </td>
                <td class="py-3.5 text-center">
                    <span class="text-xs font-semibold text-stone-500"><?php echo e($item->photos_count); ?></span>
                </td>
                <td class="py-3.5 text-center">
                    <span class="text-xs text-stone-400"><?php echo e($item->urutan); ?></span>
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center justify-end gap-2">
                        <a href="<?php echo e(route('admin.memoriam.edit', $item)); ?>"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.memoriam.destroy', $item)); ?>"
                            onsubmit="return confirm('Hapus data ini beserta semua foto dan wasiatnya?')">
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
            <tr><td colspan="6" class="px-5 py-12 text-center text-stone-300 text-sm">Belum ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/memoriam/index.blade.php ENDPATH**/ ?>