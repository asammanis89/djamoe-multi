

<?php $__env->startSection('title', 'Kelola Kategori'); ?>
<?php $__env->startSection('content_header_title', 'Daftar Kategori'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Data Kategori</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createCategoryModal">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Gambar</th>
                    <th>Nama Kategori</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration + ($categories->currentPage() - 1) * $categories->perPage()); ?></td>
                    <td>
                        <?php if($category->image_url): ?>
                            
                            <img src="<?php echo e(asset('storage/' . $category->image_url)); ?>" alt="<?php echo e($category->getTranslation('category_name', 'id')); ?>" class="img-thumbnail" width="100">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    
                    <td><?php echo e($category->getTranslation('category_name', 'id')); ?></td>
                    <td class="text-center">
                        
                        
                        <button 
                            type="button" 
                            class="btn btn-info btn-xs edit-btn" 
                            data-toggle="modal" 
                            data-target="#editCategoryModal"
                            data-id="<?php echo e($category->id); ?>"
                            data-name-id="<?php echo e($category->getTranslation('category_name', 'id')); ?>"
                            data-name-en="<?php echo e($category->getTranslation('category_name', 'en')); ?>"
                            data-image-url="<?php echo e($category->image_url ? asset('storage/' . $category->image_url) : ''); ?>"
                            data-update-url="<?php echo e(route('admin.categories.update', $category)); ?>"
                            title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        
                        
                        <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(<?php echo e($category->id); ?>, '<?php echo e($category->getTranslation('category_name', 'id')); ?>')" title="Hapus">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-<?php echo e($category->id); ?>" action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada data kategori.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
</div>




<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="createCategoryModalLabel">Formulir Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" enctype="multipart/form-data">
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
                        <label for="create_category_name_id" class="font-weight-bold">Nama Kategori (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" id="create_category_name_id" name="category_name[id]" class="form-control <?php $__errorArgs = ['category_name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Contoh: Minuman Tradisional" value="<?php echo e(old('category_name.id')); ?>" required>
                        <?php $__errorArgs = ['category_name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="form-group">
                        <label for="create_category_name_en" class="font-weight-bold">Nama Kategori (English) <span class="text-danger">*</span></label>
                        <input type="text" id="create_category_name_en" name="category_name[en]" class="form-control <?php $__errorArgs = ['category_name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Contoh: Traditional Drinks" value="<?php echo e(old('category_name.en')); ?>" required>
                        <?php $__errorArgs = ['category_name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_image_url" class="font-weight-bold">Gambar Kategori</label>
                        <div class="custom-file">
                            <input type="file" id="create_image_url" name="image_url" class="custom-file-input <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*" onchange="previewImage(event, 'create_preview')">
                            <label class="custom-file-label" for="create_image_url">Pilih file gambar...</label>
                        </div>
                        <small class="form-text text-muted">Opsional. Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                        <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback d-block"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        
                        <div id="create_preview_container" style="display: none; margin-top: 15px;">
                            <label class="font-weight-bold">Preview:</label>
                            <div style="border: 2px dashed #dee2e6; padding: 10px; text-align: center; border-radius: 5px;">
                                <img id="create_preview" src="#" alt="Preview" style="max-width: 100%; max-height: 300px;">
                            </div>
                        </div>
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




<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="editCategoryModalLabel">Formulir Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body" style="padding: 25px;">
                    
                    
                    <input type="hidden" name="category_id" id="edit_category_id_hidden" value="<?php echo e(old('category_id')); ?>">

                    
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
                        <label for="edit_category_name_id" class="font-weight-bold">Nama Kategori (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" id="edit_category_name_id" name="category_name[id]" class="form-control <?php $__errorArgs = ['category_name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('category_name.id')); ?>" required>
                         <?php $__errorArgs = ['category_name.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="form-group">
                        <label for="edit_category_name_en" class="font-weight-bold">Nama Kategori (English) <span class="text-danger">*</span></label>
                        <input type="text" id="edit_category_name_en" name="category_name[en]" class="form-control <?php $__errorArgs = ['category_name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('category_name.en')); ?>" required>
                         <?php $__errorArgs = ['category_name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="font-weight-bold">Gambar Saat Ini</label>
                        <div id="current_image_container" style="border: 2px solid #dee2e6; padding: 10px; text-align: center; border-radius: 5px; background-color: #f8f9fa;">
                            <img id="current_category_image" src="" alt="Gambar" style="max-width: 100%; max-height: 250px;">
                        </div>
                        <div id="no_current_image" style="display: none; border: 2px solid #dee2e6; padding: 20px; text-align: center; border-radius: 5px; background-color: #f8f9fa;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_image_url" class="font-weight-bold">Ganti Gambar (Opsional)</label>
                        <div class="custom-file">
                            <input type="file" id="edit_image_url" name="image_url" class="custom-file-input <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*" onchange="previewImage(event, 'edit_preview')">
                            <label class="custom-file-label" for="edit_image_url">Pilih file gambar baru...</label>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                        <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback d-block"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        
                        <div id="edit_preview_container" style="display: none; margin-top: 15px;">
                            <label class="font-weight-bold">Preview Gambar Baru:</label>
                            <div style="border: 2px dashed #dee2e6; padding: 10px; text-align: center; border-radius: 5px;">
                                <img id="edit_preview" src="#" alt="Preview" style="max-width: 100%; max-height: 300px;">
                            </div>
                        </div>
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
                    Apakah Anda yakin ingin menghapus kategori<br>
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
// JAVASCRIPT UNTUK MODAL HAPUS (Sudah Benar)
// ==================================================
let deleteFormId = null;

function confirmDelete(id, title) {
    deleteFormId = id;
    document.getElementById('delete-item-name').textContent = title;
    $('#deleteConfirmModal').modal('show');
}

// Handler untuk tombol konfirmasi hapus
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteFormId) {
        document.getElementById('delete-form-' + deleteFormId).submit();
    }
});
// ==================================================


// ==================================================
// JAVASCRIPT UNTUK PREVIEW GAMBAR
// ==================================================
// Fungsi generik untuk preview gambar
function previewImage(event, previewId) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById(previewId);
        var container = document.getElementById(previewId + '_container');
        output.src = reader.result;
        container.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);

    // Update label file input
    var fileName = event.target.files[0].name;
    $(event.target).next('.custom-file-label').html(fileName);
}
// ==================================================


// ==================================================
// REVISI BAGIAN 4: Mengganti `editCategory()` dengan Listener Modal
// ==================================================
$(document).ready(function() {

    // Listener untuk Modal Edit
    $('#editCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var name_id = button.data('name-id');
        var name_en = button.data('name-en');
        var image_url = button.data('image-url');
        var update_url = button.data('update-url');
        
        var modal = $(this);
        var form = modal.find('#editCategoryForm');
        form.attr('action', update_url);
        
        // Isi data form
        modal.find('.modal-title').text('Edit Kategori: ' + name_id);
        modal.find('#edit_category_id_hidden').val(id); // Isi hidden input
        modal.find('#edit_category_name_id').val(name_id);
        modal.find('#edit_category_name_en').val(name_en);
        
        // Set gambar saat ini atau tampilkan "Tidak ada gambar"
        var currentImageContainer = modal.find('#current_image_container');
        var noImageContainer = modal.find('#no_current_image');
        var currentImage = modal.find('#current_category_image');
        
        if (image_url && image_url !== '') {
            currentImage.attr('src', image_url);
            currentImageContainer.show();
            noImageContainer.hide();
        } else {
            currentImageContainer.hide();
            noImageContainer.show();
        }
        
        // Reset preview gambar baru
        modal.find('#edit_preview_container').hide();
        modal.find('#edit_image_url').val('');
        modal.find('#edit_image_url').next('.custom-file-label').html('Pilih file gambar baru...');
    });

    // Buka modal CREATE jika ada error validasi
    <?php if($errors->any() && !old('_method')): ?>
        $('#createCategoryModal').modal('show');
    <?php endif; ?>

    // Buka modal EDIT jika ada error validasi
    <?php if($errors->any() && old('_method') == 'PUT' && old('category_id')): ?>
        var modal = $('#editCategoryModal');
        var form = modal.find('#editCategoryForm');
        var failedId = "<?php echo e(old('category_id')); ?>";
        
        // Cari tombol yang sesuai untuk ambil data-url
        var failedButton = $('.edit-btn[data-id="' + failedId + '"]');
        var update_url = failedButton.data('update_url');
        var image_url = failedButton.data('image-url'); 

        form.attr('action', update_url);
        modal.find('.modal-title').text('Edit Kategori: <?php echo e(old('category_name.id')); ?>');
        
        // Set gambar (jika ada)
        var currentImageContainer = modal.find('#current_image_container');
        var noImageContainer = modal.find('#no_current_image');
        var currentImage = modal.find('#current_category_image');
        if (image_url && image_url !== '') {
            currentImage.attr('src', image_url);
            currentImageContainer.show();
            noImageContainer.hide();
        } else {
            currentImageContainer.hide();
            noImageContainer.show();
        }
        
        modal.modal('show');
    <?php endif; ?>


    // Reset form create ketika modal ditutup
    $('#createCategoryModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.custom-file-label').html('Pilih file gambar...');
        $(this).find('#create_preview_container').hide();
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
        $(this).find('.alert-danger').remove();
    });

    // Reset form edit ketika modal ditutup
    $('#editCategoryModal').on('hidden.bs.modal', function () {
        <?php if(!($errors->any() && old('_method') == 'PUT')): ?>
            $(this).find('form')[0].reset();
            $(this).find('.custom-file-label').html('Pilih file gambar baru...');
            $(this).find('#edit_preview_container').hide();
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove();
            $(this).find('.alert-danger').remove();
        <?php endif; ?>
    });

});
// ==================================================
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

/* Styling untuk custom file input */
.custom-file-label::after {
    content: "Browse";
}

/* Hover effect untuk tombol */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,.2);
}

/* CSS untuk Modal Hapus (Sudah Benar) */
#deleteConfirmModal .modal-dialog {
    max-width: 450px;
}

#deleteConfirmModal .modal-content {
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

#deleteConfirmModal .btn-light:hover {
    background-color: #f7fafc;
    border-color: #cbd5e0;
}

#deleteConfirmModal .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(245, 101, 101, 0.4);
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>