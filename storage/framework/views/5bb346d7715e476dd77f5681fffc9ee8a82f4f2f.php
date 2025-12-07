

<?php $__env->startSection('title', 'Kelola Lokasi'); ?>
<?php $__env->startSection('content_header_title', 'Daftar Lokasi Outlet'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Data Lokasi</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createLocationModal">
                <i class="fas fa-plus"></i> Tambah Lokasi
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php endif; ?>

        
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    
                    
                    
                    
                    <th class="column-outlet-name">Nama Outlet</th>
                    <th class="column-address">Alamat</th>
                    
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>

                    
                    
                    
                    <td class="column-outlet-name"><?php echo e($location->getTranslation('name', 'id')); ?></td>
                    <td class="column-address"><?php echo e($location->getTranslation('address', 'id')); ?></td>
                    
                    <td><?php echo e($location->phone_number ?? '-'); ?></td>
                    <td class="text-center">
                        
                        
                        <button type="button" 
                            class="btn btn-info btn-xs edit-btn" 
                            data-toggle="modal" 
                            data-target="#editLocationModal"
                            data-id="<?php echo e($location->id); ?>"
                            data-update-url="<?php echo e(route('admin.locations.update', $location)); ?>"
                            data-name-id="<?php echo e($location->getTranslation('name', 'id')); ?>"
                            data-name-en="<?php echo e($location->getTranslation('name', 'en')); ?>"
                            data-address-id="<?php echo e($location->getTranslation('address', 'id')); ?>"
                            data-address-en="<?php echo e($location->getTranslation('address', 'en')); ?>"
                            data-phone_number="<?php echo e($location->phone_number); ?>"
                            data-google_maps_url="<?php echo e($location->google_maps_url); ?>"
                            title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        
                        
                        <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(<?php echo e($location->id); ?>, '<?php echo e($location->getTranslation('name', 'id')); ?>')" title="Hapus">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-<?php echo e($location->id); ?>" action="<?php echo e(route('admin.locations.destroy', $location)); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data lokasi.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>




<div class="modal fade" id="createLocationModal" tabindex="-1" role="dialog" aria-labelledby="createLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="createLocationModalLabel">Formulir Tambah Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.locations.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body" style="padding: 25px;">

                    
                    <?php if($errors->any() && !old('_method')): ?>
                        <div class="alert alert-danger">
                            <strong class="font-weight-bold">Whoops! Ada yang salah.</strong>
                            <ul class="mt-2 mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="create_name_id" class="font-weight-bold">Nama Outlet (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_name_id" name="name[id]" value="<?php echo e(old('name.id')); ?>" placeholder="Contoh: D'jamoe Outlet Madiun" required>
                        <?php $__errorArgs = ['name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="create_name_en" class="font-weight-bold">Nama Outlet (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_name_en" name="name[en]" value="<?php echo e(old('name.en')); ?>" placeholder="Contoh: D'jamoe Madiun Outlet" required>
                        <?php $__errorArgs = ['name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_address_id" class="font-weight-bold">Alamat Lengkap (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['address.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_address_id" name="address[id]" rows="3" placeholder="Contoh: Jl. Raya Madiun No. 123, Kota Madiun" required><?php echo e(old('address.id')); ?></textarea>
                        <?php $__errorArgs = ['address.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="create_address_en" class="font-weight-bold">Alamat Lengkap (English) <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['address.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_address_en" name="address[en]" rows="3" placeholder="Contoh: 123 Madiun Raya St., Madiun City" required><?php echo e(old('address.en')); ?></textarea>
                        <?php $__errorArgs = ['address.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_phone_number" class="font-weight-bold">No. Telepon</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_phone_number" name="phone_number" value="<?php echo e(old('phone_number')); ?>" placeholder="Contoh: 0812-3456-7890">
                        <small class="form-text text-muted">Opsional - Kosongkan jika tidak ada</small>
                        <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="create_google_maps_url" class="font-weight-bold">URL Google Maps</label>
                        <input type="url" class="form-control <?php $__errorArgs = ['google_maps_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_google_maps_url" name="google_maps_url" value="<?php echo e(old('google_maps_url')); ?>" placeholder="https://maps.google.com/...">
                        <small class="form-text text-muted">Opsional - Link Google Maps untuk lokasi outlet</small>
                        <?php $__errorArgs = ['google_maps_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="editLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="editLocationModalLabel">Formulir Edit Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editLocationForm" method="POST" action=""> 
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body" style="padding: 25px;">
                    
                    
                    <input type="hidden" name="location_id" id="edit_location_id_hidden" value="<?php echo e(old('location_id')); ?>">

                    
                    <?php if($errors->any() && old('_method') == 'PUT'): ?>
                        <div class="alert alert-danger">
                            <strong class="font-weight-bold">Whoops! Ada yang salah.</strong>
                            <ul class="mt-2 mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="edit_name_id" class="font-weight-bold">Nama Outlet (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_name_id" name="name[id]" value="<?php echo e(old('name.id')); ?>" required>
                        <?php $__errorArgs = ['name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_name_en" class="font-weight-bold">Nama Outlet (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_name_en" name="name[en]" value="<?php echo e(old('name.en')); ?>" required>
                        <?php $__errorArgs = ['name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="edit_address_id" class="font-weight-bold">Alamat Lengkap (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['address.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_address_id" name="address[id]" rows="3" required><?php echo e(old('address.id')); ?></textarea>
                        <?php $__errorArgs = ['address.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_address_en" class="font-weight-bold">Alamat Lengkap (English) <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['address.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_address_en" name="address[en]" rows="3" required><?php echo e(old('address.en')); ?></textarea>
                        <?php $__errorArgs = ['address.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="edit_phone_number" class="font-weight-bold">No. Telepon</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_phone_number" name="phone_number" value="<?php echo e(old('phone_number')); ?>" placeholder="Contoh: 0812-3456-7890">
                        <small class="form-text text-muted">Opsional - Kosongkan jika tidak ada</small>
                        <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="edit_google_maps_url" class="font-weight-bold">URL Google Maps</label>
                        <input type="url" class="form-control <?php $__errorArgs = ['google_maps_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_google_maps_url" name="google_maps_url" value="<?php echo e(old('google_maps_url')); ?>" placeholder="https://maps.google.com/...">
                        <small class="form-text text-muted">Opsional - Link Google Maps untuk lokasi outlet</small>
                        <?php $__errorArgs = ['google_maps_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden;">
            <div class="modal-body text-center" style="padding: 40px 30px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 40px; color: white;"></i>
                </div>
                <h4 class="font-weight-bold mb-3" style="color: #2d3748;">Konfirmasi Hapus</h4>
                <p style="color: #718096; font-size: 15px; margin-bottom: 25px;">
                    Apakah Anda yakin ingin menghapus lokasi<br>
                    <strong id="delete-item-name" style="color: #2d3748;"></strong>?
                </p>
                <div class="d-flex justify-content-center gap-2" style="gap: 10px;">
                    <button type="button" class="btn btn-light px-4 py-2" data-dismiss="modal" style="border-radius: 8px; border: 1px solid #e2e8f0; font-weight: 500;">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-danger px-4 py-2" id="confirmDeleteBtn" style="border-radius: 8px; font-weight: 500; background: linear-gradient(135deg, #f56565 0%, #c53030 100%); border: none;">
                        <i class="fas fa-trash mr-1"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
// ==================================================
// JAVASCRIPT UNTUK MODAL HAPUS
// ==================================================
let deleteFormId = null;
function confirmDelete(id, title) {
    deleteFormId = id;
    document.getElementById('delete-item-name').textContent = title;
    $('#deleteConfirmModal').modal('show');
}

// ==================================================
// REVISI 6: Ganti onclick() dengan listener JQuery
// ==================================================
$(document).ready(function() {

    // Handler untuk tombol konfirmasi hapus
    $('#confirmDeleteBtn').on('click', function() {
        if (deleteFormId) {
            $('#delete-form-' + deleteFormId).submit();
        }
    });

    // Listener untuk Modal Edit
    $('#editLocationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var modal = $(this);
        var form = modal.find('#editLocationForm');

        // Ambil data dari tombol
        var id = button.data('id');
        var update_url = button.data('update-url');
        var name_id = button.data('name-id');
        var name_en = button.data('name-en');
        var address_id = button.data('address-id');
        var address_en = button.data('address-en');
        var phone_number = button.data('phone_number');
        var google_maps_url = button.data('google_maps_url');
        
        // Set action URL form
        form.attr('action', update_url);
        
        // Isi semua field form
        modal.find('.modal-title').text('Edit Lokasi: ' + name_id);
        modal.find('#edit_location_id_hidden').val(id); // Isi hidden ID
        
        modal.find('#edit_name_id').val(name_id);
        modal.find('#edit_name_en').val(name_en);
        
        modal.find('#edit_address_id').val(address_id);
        modal.find('#edit_address_en').val(address_en);
        
        modal.find('#edit_phone_number').val(phone_number || '');
        modal.find('#edit_google_maps_url').val(google_maps_url || '');
    });

    // Buka modal CREATE jika ada error validasi
    <?php if($errors->any() && !old('_method')): ?>
        $('#createLocationModal').modal('show');
    <?php endif; ?>

    // Buka modal EDIT jika ada error validasi
    <?php if($errors->any() && old('_method') == 'PUT' && old('location_id')): ?>
        var modal = $('#editLocationModal');
        var form = modal.find('#editLocationForm');
        var failedId = "<?php echo e(old('location_id')); ?>";
        
        // Cari tombol yang gagal untuk ambil data-url
        var failedButton = $('.edit-btn[data-id="' + failedId + '"]');
        var update_url = failedButton.data('update-url');

        form.attr('action', update_url);
        modal.find('.modal-title').text('Edit Lokasi: <?php echo e(old('name.id')); ?>');
        
        modal.modal('show');
    <?php endif; ?>


    // Reset form create ketika modal ditutup
    $('#createLocationModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
        $(this).find('.alert-danger').remove();
    });

    // Reset form edit ketika modal ditutup
    $('#editLocationModal').on('hidden.bs.modal', function () {
        <?php if(!($errors->any() && old('_method') == 'PUT')): ?>
            $(this).find('form')[0].reset();
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove();
            $(this).find('.alert-danger').remove();
        <?php endif; ?>
    });

});
</script>

<style>
/* Custom styling untuk modal */
.modal-content {
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,.3);
}
.modal-header {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.modal-footer {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
.btn {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,.2);
}
textarea.form-control {
    resize: vertical;
    min-height: 80px;
}
#deleteConfirmModal .modal-dialog {
    max-width: 450px;
}
#deleteConfirmModal .modal-content {
    animation: modalSlideIn 0.3s ease-out;
}
@keyframes modalSlideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
#deleteConfirmModal .btn-light:hover {
    background-color: #f7fafc;
    border-color: #cbd5e0;
}
#deleteConfirmModal .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(245, 101, 101, 0.4);
}

/* ================================================== */
/* PERBAIKAN 3: Tambahkan CSS ini untuk kolom tabel */
/* ================================================== */
.column-outlet-name,
.column-address {
    /* Tentukan lebar minimum dan maksimum */
    min-width: 200px;
    max-width: 350px; /* Anda bisa sesuaikan nilai ini */
    
    /* Paksa teks untuk pindah baris (wrap) */
    overflow-wrap: break-word;
    word-wrap: break-word;
    white-space: normal !important;
}

/* Beri lebar lebih sedikit untuk nama, lebih banyak untuk alamat */
.column-outlet-name {
    min-width: 180px;
    max-width: 300px;
}
.column-address {
    min-width: 220px;
    max-width: 400px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/admin/locations/index.blade.php ENDPATH**/ ?>