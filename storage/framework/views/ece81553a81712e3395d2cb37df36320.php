

<?php $__env->startSection('title', 'Donasi'); ?>
<?php $__env->startSection('page_title', 'Manajemen Donasi'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600">Home</span> <span>/</span> <span>Donasi</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Dana Masuk</p>
        <p class="text-2xl font-extrabold text-emerald-600">Rp <?php echo e(number_format($totalMasuk, 0, ',', '.')); ?></p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Transaksi</p>
        <p class="text-2xl font-extrabold text-gray-800"><?php echo e($donasis->total()); ?></p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Menunggu Konfirmasi</p>
        <p class="text-2xl font-extrabold text-amber-500"><?php echo e($totalPending); ?></p>
    </div>
</div>


<div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-5 p-4">
    <form method="GET" action="<?php echo e(route('admin.donasi.index')); ?>" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[160px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Cari Donatur</label>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                placeholder="Nama donatur..."
                class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                <option value="">Semua Status</option>
                <option value="sukses"    <?php echo e(request('status') == 'sukses'    ? 'selected' : ''); ?>>Sukses</option>
                <option value="menunggu"  <?php echo e(request('status') == 'menunggu'  ? 'selected' : ''); ?>>Menunggu</option>
                <option value="gagal"     <?php echo e(request('status') == 'gagal'     ? 'selected' : ''); ?>>Gagal</option>
            </select>
        </div>
        <div class="min-w-[160px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Program</label>
            <select name="program_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                <option value="">Semua Program</option>
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($p->id_program); ?>" <?php echo e(request('program_id') == $p->id_program ? 'selected' : ''); ?>>
                        <?php echo e($p->nama_program); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                Filter
            </button>
            <?php if(request()->hasAny(['search','status','program_id'])): ?>
                <a href="<?php echo e(route('admin.donasi.index')); ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                    Reset
                </a>
            <?php endif; ?>
        </div>
        <div class="ml-auto">
            <a href="<?php echo e(route('admin.donasi.create')); ?>"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Catat Donasi
            </a>
        </div>
    </form>
</div>


<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Donatur</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Program</th>
                    <th class="text-right text-xs font-semibold text-gray-500 px-5 py-3.5">Jumlah</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Metode</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Tanggal</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $donasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4 font-medium text-gray-800"><?php echo e($donasi->nama_donatur); ?></td>
                    <td class="px-5 py-4 text-gray-500 max-w-[160px]">
                        <span class="truncate block"><?php echo e($donasi->program->nama_program ?? '-'); ?></span>
                    </td>
                    <td class="px-5 py-4 text-right font-semibold text-emerald-600">
                        Rp <?php echo e(number_format($donasi->jumlah, 0, ',', '.')); ?>

                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            <?php echo e($donasi->metode === 'qris' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700'); ?>">
                            <?php echo e(strtoupper($donasi->metode)); ?>

                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            <?php echo e($donasi->status_bayar === 'sukses'   ? 'bg-emerald-100 text-emerald-700' :
                              ($donasi->status_bayar === 'menunggu' ? 'bg-amber-100 text-amber-700' :
                                                                      'bg-red-100 text-red-600')); ?>">
                            <?php echo e(ucfirst($donasi->status_bayar)); ?>

                        </span>
                    </td>
                    <td class="px-5 py-4 text-gray-400 text-xs"><?php echo e($donasi->created_at->format('d/m/Y H:i')); ?></td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-1.5">
                            <?php if($donasi->status_bayar === 'menunggu'): ?>
                                <form method="POST" action="<?php echo e(route('admin.donasi.konfirmasi', $donasi)); ?>"
                                    onsubmit="return confirm('Konfirmasi donasi ini?')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="w-8 h-8 rounded-lg bg-emerald-50 hover:bg-emerald-100 flex items-center justify-center text-emerald-600 transition-colors"
                                        title="Konfirmasi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </form>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.donasi.show', $donasi)); ?>"
                                class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="<?php echo e(route('admin.donasi.edit', $donasi)); ?>"
                                class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center text-amber-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.donasi.destroy', $donasi)); ?>"
                                onsubmit="return confirm('Hapus donasi ini?')">
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
                    <td colspan="7" class="px-5 py-12 text-center text-gray-400">Belum ada data donasi</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($donasis->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100"><?php echo e($donasis->links()); ?></div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/donasi/index.blade.php ENDPATH**/ ?>