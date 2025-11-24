

<?php $__env->startSection('title', 'Flyers'); ?>
<?php $__env->startSection('content_header_title', 'Daftar Flyers'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFlyerModal">
            <i class="fas fa-plus"></i> Tambah Flyer
        </button>
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
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $flyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <img src="<?php echo e(asset('storage/'.$flyer->image_url)); ?>" width="150" alt="Flyer">
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" onclick="editFlyer(<?php echo e($flyer->id); ?>, '<?php echo e(asset('storage/'.$flyer->image_url)); ?>')">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo e($flyer->id); ?>, 'Flyer #<?php echo e($loop->iteration); ?>')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-<?php echo e($flyer->id); ?>" action="<?php echo e(route('admin.flyers.destroy', $flyer)); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                        </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            <?php echo e($flyers->links()); ?>

        </div>
    </div>
</div>

<div class="modal fade" id="createFlyerModal" tabindex="-1" role="dialog" aria-labelledby="createFlyerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="createFlyerModalLabel">Formulir Tambah Flyer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.flyers.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body" style="padding: 25px;">
                    <div class="form-group">
                        <label for="create_image_url" class="font-weight-bold">Gambar Flyer <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="image_url" id="create_image_url" class="custom-file-input" onchange="previewCreateImage(event)" required accept="image/*">
                            <label class="custom-file-label" for="create_image_url">Pilih file gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        
                        <div id="create_preview_container" style="display: none; margin-top: 15px;">
                            <label class="font-weight-bold">Preview:</label>
                            <div style="border: 2px dashed #dee2e6; padding: 10px; text-align: center; border-radius: 5px;">
                                <img id="create_preview" src="#" alt="Preview Flyer" style="max-width: 100%; max-height: 400px;">
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

<div class="modal fade" id="editFlyerModal" tabindex="-1" role="dialog" aria-labelledby="editFlyerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="editFlyerModalLabel">Formulir Edit Flyer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editFlyerForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body" style="padding: 25px;">
                    <div class="form-group">
                        <label class="font-weight-bold">Gambar Flyer Saat Ini</label>
                        <div style="border: 2px solid #dee2e6; padding: 10px; text-align: center; border-radius: 5px; background-color: #f8f9fa;">
                            <img id="current_image" src="" alt="Flyer" style="max-width: 100%; max-height: 300px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_image_url" class="font-weight-bold">Ganti Gambar Flyer (Opsional)</label>
                        <div class="custom-file">
                            <input type="file" name="image_url" id="edit_image_url" class="custom-file-input" onchange="previewEditImage(event)" accept="image/*">
                            <label class="custom-file-label" for="edit_image_url">Pilih file gambar baru...</label>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        
                        <div id="edit_preview_container" style="display: none; margin-top: 15px;">
                            <label class="font-weight-bold">Preview Gambar Baru:</label>
                            <div style="border: 2px dashed #dee2e6; padding: 10px; text-align: center; border-radius: 5px;">
                                <img id="edit_preview" src="#" alt="Preview Flyer" style="max-width: 100%; max-height: 400px;">
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

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden;">
            <div class="modal-body text-center" style="padding: 40px 30px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 40px; color: white;"></i>
                </div>
                <h4 class="font-weight-bold mb-3" style="color: #2d3748;">Konfirmasi Hapus</h4>
                <p style="color: #718096; font-size: 15px; margin-bottom: 25px;">
                    Apakah Anda yakin ingin menghapus flyer<br>
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
    // PENAMBAHAN DI SINI: JavaScript untuk Modal Hapus
    // ==================================================
    // Variable untuk menyimpan ID yang akan dihapus
    let deleteFormId = null;

    // Fungsi untuk konfirmasi hapus
    function confirmDelete(id, title) {
        deleteFormId = id;
        // Karena flyer tidak punya nama, kita gunakan title yg di-pass (misal "Flyer #1")
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


    // Update label file input ketika file dipilih (Create)
    $('#create_image_url').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });

    // Update label file input ketika file dipilih (Edit)
    $('#edit_image_url').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });

    // Preview gambar untuk Create
    function previewCreateImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('create_preview');
            var container = document.getElementById('create_preview_container');
            output.src = reader.result;
            container.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Preview gambar untuk Edit
    function previewEditImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('edit_preview');
            var container = document.getElementById('edit_preview_container');
            output.src = reader.result;
            container.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Fungsi untuk membuka modal edit dan set data
    function editFlyer(id, imageUrl) {
        // Set action URL untuk form edit
        var form = document.getElementById('editFlyerForm');
        form.action = '/admin/flyers/' + id;
        
        // Set gambar saat ini
        document.getElementById('current_image').src = imageUrl;
        
        // Reset preview gambar baru
        document.getElementById('edit_preview_container').style.display = 'none';
        document.getElementById('edit_image_url').value = '';
        document.querySelector('#edit_image_url').nextElementSibling.innerHTML = 'Pilih file gambar baru...';
        
        // Tampilkan modal
        $('#editFlyerModal').modal('show');
    }

    // Reset form create ketika modal ditutup
    $('#createFlyerModal').on('hidden.bs.modal', function () {
        document.getElementById('create_image_url').value = '';
        document.querySelector('#create_image_url').nextElementSibling.innerHTML = 'Pilih file gambar...';
        document.getElementById('create_preview_container').style.display = 'none';
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

/* ================================================== */
/* PENAMBAHAN DI SINI: CSS untuk Modal Hapus */
/* ================================================== */
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

/* Styling untuk tombol di modal konfirmasi */
#deleteConfirmModal .btn-light:hover {
    background-color: #f7fafc;
    border-color: #cbd5e0;
}

#deleteConfirmModal .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(245, 101, 101, 0.4);
}
/* ================================================== */
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/admin/flyers/index.blade.php ENDPATH**/ ?>