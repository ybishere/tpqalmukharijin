
<?php $__env->startSection('title', 'Edit Kegiatan'); ?>
<?php $__env->startSection('page_title', 'Edit Kegiatan'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a href="<?php echo e(route('admin.kegiatan.index')); ?>" class="hover:text-emerald-600 transition-colors">Kegiatan</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-emerald-600 font-medium">Edit</span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <?php if($errors->any()): ?>
    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600">
        <ul class="list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.kegiatan.update', $kegiatan)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.kegiatan._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="flex items-center gap-3 mt-6">
            <button type="submit"
                class="bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                Perbarui Kegiatan
            </button>
            <a href="<?php echo e(route('admin.kegiatan.index')); ?>"
                class="text-sm text-stone-400 hover:text-stone-600 transition-colors px-4 py-2.5">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/kegiatan/edit.blade.php ENDPATH**/ ?>