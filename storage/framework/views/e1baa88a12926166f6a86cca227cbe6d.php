
<?php $__env->startSection('title', 'Profil TPQ'); ?>
<?php $__env->startSection('page_title', 'Profil TPQ'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <span class="text-emerald-600 font-medium">Profil TPQ</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('admin.profil.update')); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-2 space-y-5">

            
            <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
                <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Informasi Dasar</h3>
                <div class="space-y-4">

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama TPQ <span class="text-red-400">*</span></label>
                        <input type="text" name="nama_tpq" value="<?php echo e(old('nama_tpq', $profil->nama_tpq)); ?>"
                            class="w-full border <?php echo e($errors->has('nama_tpq') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                        <?php $__errorArgs = ['nama_tpq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Sejarah</label>
                        <textarea name="sejarah" rows="6"
                            placeholder="Tulis sejarah berdirinya TPQ..."
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none"><?php echo e(old('sejarah', $profil->sejarah)); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Visi</label>
                        <textarea name="visi" rows="3"
                            placeholder="Visi TPQ..."
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none"><?php echo e(old('visi', $profil->visi)); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Misi</label>
                        <textarea name="misi" rows="5"
                            placeholder="Misi TPQ (pisahkan tiap poin dengan baris baru)..."
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none"><?php echo e(old('misi', $profil->misi)); ?></textarea>
                    </div>

                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
                <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Kontak & Lokasi</h3>
                <div class="space-y-4">

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Alamat</label>
                        <textarea name="alamat" rows="3"
                            placeholder="Alamat lengkap TPQ..."
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none"><?php echo e(old('alamat', $profil->alamat)); ?></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-stone-600 mb-1.5">No. Telepon</label>
                            <input type="text" name="no_telp" value="<?php echo e(old('no_telp', $profil->no_telp)); ?>"
                                placeholder="08xx-xxxx-xxxx"
                                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="<?php echo e(old('email', $profil->email)); ?>"
                                placeholder="admin@tpq.id"
                                class="w-full border <?php echo e($errors->has('email') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                            <?php $__errorArgs = ['email'];
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
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Google Maps URL</label>
                        <input type="url" name="maps_url" value="<?php echo e(old('maps_url', $profil->maps_url)); ?>"
                            placeholder="https://maps.google.com/..."
                            class="w-full border <?php echo e($errors->has('maps_url') ? 'border-red-300 bg-red-50' : 'border-stone-200'); ?> rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                        <?php $__errorArgs = ['maps_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>
            </div>

        </div>

        
        <div class="space-y-5">

            
            <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
                <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Media Sosial</h3>
                <div class="space-y-4">

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Facebook</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 text-xs font-semibold">fb.com/</span>
                            <input type="text" name="facebook" value="<?php echo e(old('facebook', $profil->facebook)); ?>"
                                placeholder="username"
                                class="w-full border border-stone-200 rounded-xl pl-14 pr-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Instagram</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 text-xs font-semibold">@</span>
                            <input type="text" name="instagram" value="<?php echo e(old('instagram', $profil->instagram)); ?>"
                                placeholder="username"
                                class="w-full border border-stone-200 rounded-xl pl-8 pr-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">YouTube</label>
                        <input type="text" name="youtube" value="<?php echo e(old('youtube', $profil->youtube)); ?>"
                            placeholder="Channel name / URL"
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    </div>

                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
                <button type="submit"
                    class="w-full bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold py-3 rounded-xl transition-colors">
                    Simpan Perubahan
                </button>
                <a href="<?php echo e(route('profil.index')); ?>" target="_blank"
                    class="flex items-center justify-center gap-1.5 mt-3 text-xs text-stone-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat halaman profil publik
                </a>
            </div>

        </div>

    </div>

</form>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tpq-almukharijin\resources\views/admin/profil/edit.blade.php ENDPATH**/ ?>