<?php $isEdit = isset($kegiatan); ?>

<div class="space-y-5">

    
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Judul Kegiatan <span class="text-red-400">*</span></label>
        <input type="text" name="judul" value="<?php echo e(old('judul', $kegiatan->judul ?? '')); ?>"
            placeholder="Masukkan judul kegiatan..."
            class="w-full border <?php echo e($errors->has('judul') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tanggal <span class="text-red-400">*</span></label>
            <input type="date" name="tanggal"
                value="<?php echo e(old('tanggal', isset($kegiatan) ? \Carbon\Carbon::parse($kegiatan->tanggal)->format('Y-m-d') : '')); ?>"
                class="w-full border <?php echo e($errors->has('tanggal') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Status <span class="text-red-400">*</span></label>
            <select name="status"
                class="w-full border <?php echo e($errors->has('status') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                <?php $__currentLoopData = ['akan_datang' => 'Akan Datang', 'berlangsung' => 'Berlangsung', 'selesai' => 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($val); ?>" <?php echo e(old('status', $kegiatan->status ?? '') == $val ? 'selected' : ''); ?>>
                    <?php echo e($label); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Thumbnail</label>
        <?php if($isEdit && $kegiatan->thumbnail): ?>
        <div class="mb-2">
            <img src="<?php echo e(Storage::url($kegiatan->thumbnail)); ?>" class="h-24 rounded-xl object-cover border border-stone-100">
            <p class="text-[11px] text-stone-400 mt-1">Upload baru untuk mengganti.</p>
        </div>
        <?php endif; ?>
        <input type="file" name="thumbnail" accept="image/*"
            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
        <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
        <textarea name="deskripsi" rows="5"
            placeholder="Tulis deskripsi kegiatan..."
            class="w-full border <?php echo e($errors->has('deskripsi') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none"><?php echo e(old('deskripsi', $kegiatan->deskripsi ?? '')); ?></textarea>
        <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <?php if($isEdit && $kegiatan->photos->count()): ?>
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-2">Foto Saat Ini</label>
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
            <?php $__currentLoopData = $kegiatan->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="relative group">
                <img src="<?php echo e(Storage::url($photo->foto)); ?>"
                    class="w-full aspect-square object-cover rounded-xl border border-stone-100">
                <?php if($photo->keterangan): ?>
                <p class="text-[10px] text-stone-400 mt-1 truncate"><?php echo e($photo->keterangan); ?></p>
                <?php endif; ?>
                <label class="absolute top-1.5 right-1.5 w-6 h-6 rounded-lg bg-white/90 border border-red-200 flex items-center justify-center cursor-pointer group-hover:opacity-100 opacity-0 transition-opacity">
                    <input type="checkbox" name="hapus_foto[]" value="<?php echo e($photo->id); ?>" class="sr-only peer">
                    <svg class="w-3 h-3 text-stone-300 peer-checked:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p class="text-[11px] text-stone-400 mt-2">Hover foto lalu centang ✕ untuk menghapus.</p>
    </div>
    <?php endif; ?>

    
    <div x-data="{ files: [] }">
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">
            <?php echo e($isEdit ? 'Tambah Foto Baru' : 'Upload Foto'); ?>

        </label>
        <input type="file" name="foto[]" accept="image/*" multiple
            @change="files = Array.from($event.target.files)"
            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
        <p class="text-[11px] text-stone-400 mt-1">Bisa pilih beberapa foto sekaligus.</p>

        
        <div x-show="files.length" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-3">
            <template x-for="(file, i) in files" :key="i">
                <div>
                    <div class="w-full aspect-square rounded-xl bg-stone-100 overflow-hidden border border-stone-200">
                        <img :src="URL.createObjectURL(file)" class="w-full h-full object-cover">
                    </div>
                    <input type="text" :name="`keterangan[${i}]`"
                        placeholder="Keterangan foto..."
                        class="mt-1 w-full border border-stone-200 rounded-lg px-2 py-1 text-[11px] text-stone-600 focus:outline-none focus:border-emerald-400 transition-all">
                </div>
            </template>
        </div>
    </div>

</div>


<?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/kegiatan/_form.blade.php ENDPATH**/ ?>