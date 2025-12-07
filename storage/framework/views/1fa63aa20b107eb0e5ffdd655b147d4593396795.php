

<?php $__env->startSection('title', 'Manajemen Artikel'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Manajemen Artikel (Aktivitas)</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Artikel</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createArticleModal">
                <i class="fas fa-plus"></i> Tambah Artikel Baru
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
        
        <?php if(session('error')): ?>
            
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 150px">Gambar</th>
                    <th class="column-title">Judul</th>
                    <th class="column-subtitle">Sub Judul</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->getTranslation('title', 'id')); ?>" class="img-thumbnail" style="width: 120px; height: auto; object-fit: cover;">
                        </td>
                        <td class="column-title"><?php echo e($article->getTranslation('title', 'id')); ?></td>
                        <td class="column-subtitle"><?php echo e($article->getTranslation('subtitle', 'id')); ?></td>
                        <td>
                            <button type="button" 
                                class="btn btn-info btn-xs edit-btn" 
                                data-toggle="modal" 
                                data-target="#editArticleModal"
                                data-id="<?php echo e($article->id); ?>"
                                data-update-url="<?php echo e(route('admin.articles.update', $article)); ?>"
                                data-image-url="<?php echo e(asset('storage/' . $article->image)); ?>"
                                data-title-id="<?php echo e($article->getTranslation('title', 'id')); ?>"
                                data-title-en="<?php echo e($article->getTranslation('title', 'en')); ?>"
                                data-subtitle-id="<?php echo e($article->getTranslation('subtitle', 'id')); ?>"
                                data-subtitle-en="<?php echo e($article->getTranslation('subtitle', 'en')); ?>"
                                data-description-id="<?php echo e($article->getTranslation('description', 'id')); ?>"
                                data-description-en="<?php echo e($article->getTranslation('description', 'en')); ?>"
                                >
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            
                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(<?php echo e($article->id); ?>, '<?php echo e($article->getTranslation('title', 'id')); ?>')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <form id="delete-form-<?php echo e($article->id); ?>" action="<?php echo e(route('admin.articles.destroy', $article)); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada artikel ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <?php echo e($articles->links()); ?>

    </div>
</div>


<div class="modal fade" id="createArticleModal" tabindex="-1" role="dialog" aria-labelledby="createArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="createArticleModalLabel">Formulir Tambah Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.articles.store')); ?>" method="POST" enctype="multipart/form-data">
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
                        <label for="create_title_id" class="font-weight-bold">Judul (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" name="title[id]" class="form-control <?php $__errorArgs = ['title.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_title_id" value="<?php echo e(old('title.id')); ?>" placeholder="Contoh: Kelas Meracik Jamu" required>
                        <?php $__errorArgs = ['title.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="create_title_en" class="font-weight-bold">Judul (English) <span class="text-danger">*</span></label>
                        <input type="text" name="title[en]" class="form-control <?php $__errorArgs = ['title.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_title_en" value="<?php echo e(old('title.en')); ?>" placeholder="Contoh: Herbal Mixing Class" required>
                        <?php $__errorArgs = ['title.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <hr>

                    <div class="form-group">
                        <label for="create_subtitle_id" class="font-weight-bold">Sub Judul (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" name="subtitle[id]" class="form-control <?php $__errorArgs = ['subtitle.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_subtitle_id" value="<?php echo e(old('subtitle.id')); ?>" placeholder="Teks yang tampil di atas gambar" required>
                        <?php $__errorArgs = ['subtitle.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="create_subtitle_en" class="font-weight-bold">Sub Judul (English) <span class="text-danger">*</span></label>
                        <input type="text" name="subtitle[en]" class="form-control <?php $__errorArgs = ['subtitle.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_subtitle_en" value="<?php echo e(old('subtitle.en')); ?>" placeholder="Text shown above the image" required>
                        <?php $__errorArgs = ['subtitle.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_description_id" class="font-weight-bold">Deskripsi Lengkap (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea name="description[id]" class="form-control <?php $__errorArgs = ['description.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_description_id" rows="5" placeholder="Jelaskan tentang aktivitas atau artikel ini..." required><?php echo e(old('description.id')); ?></textarea>
                        <?php $__errorArgs = ['description.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="create_description_en" class="font-weight-bold">Deskripsi Lengkap (English) <span class="text-danger">*</span></label>
                        <textarea name="description[en]" class="form-control <?php $__errorArgs = ['description.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_description_en" rows="5" placeholder="Explain this activity or article..." required><?php echo e(old('description.en')); ?></textarea>
                        <?php $__errorArgs = ['description.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_image" class="font-weight-bold">Gambar <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="create_image" required accept="image/*">
                            <label class="custom-file-label" for="create_image">Pilih file gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback d-block"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
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
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="editArticleModalLabel">Formulir Edit Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editArticleForm" method="POST" enctype="multipart/form-data" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body" style="padding: 25px;">
                    
                    <input type="hidden" name="article_id" id="edit_article_id_hidden" value="<?php echo e(old('article_id')); ?>">

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
                        <label for="edit_title_id" class="font-weight-bold">Judul (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" name="title[id]" class="form-control <?php $__errorArgs = ['title.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_title_id" value="<?php echo e(old('title.id')); ?>" required>
                        <?php $__errorArgs = ['title.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_title_en" class="font-weight-bold">Judul (English) <span class="text-danger">*</span></label>
                        <input type="text" name="title[en]" class="form-control <?php $__errorArgs = ['title.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_title_en" value="<?php echo e(old('title.en')); ?>" required>
                        <?php $__errorArgs = ['title.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="edit_subtitle_id" class="font-weight-bold">Sub Judul (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" name="subtitle[id]" class="form-control <?php $__errorArgs = ['subtitle.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_subtitle_id" value="<?php echo e(old('subtitle.id')); ?>" required>
                        <?php $__errorArgs = ['subtitle.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_subtitle_en" class="font-weight-bold">Sub Judul (English) <span class="text-danger">*</span></label>
                        <input type="text" name="subtitle[en]" class="form-control <?php $__errorArgs = ['subtitle.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_subtitle_en" value="<?php echo e(old('subtitle.en')); ?>" required>
                        <?php $__errorArgs = ['subtitle.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="edit_description_id" class="font-weight-bold">Deskripsi Lengkap (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea name="description[id]" class="form-control <?php $__errorArgs = ['description.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_description_id" rows="5" required><?php echo e(old('description.id')); ?></textarea>
                        <?php $__errorArgs = ['description.id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="edit_description_en" class="font-weight-bold">Deskripsi Lengkap (English) <span class="text-danger">*</span></label>
                        <textarea name="description[en]" class="form-control <?php $__errorArgs = ['description.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_description_en" rows="5" required><?php echo e(old('description.en')); ?></textarea>
                        <?php $__errorArgs = ['description.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <hr>

                    <div class="form-group">
                        <label class="font-weight-bold">Gambar Saat Ini</label>
                        <div style="border: 2px solid #dee2e6; padding: 10px; text-align: center; border-radius: 5px; background-color: #f8f9fa;">
                            <img id="current_article_image" src="" alt="Artikel" style="max-width: 100%; max-height: 250px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_image" class="font-weight-bold">Ganti Gambar (Opsional)</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit_image" accept="image/*">
                            <label class="custom-file-label" for="edit_image">Pilih file gambar baru...</label>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback d-block"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
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
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Perbarui
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
                    Apakah Anda yakin ingin menghapus artikel<br>
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
    // JavaScript untuk Modal Hapus
    // ==================================================
    let deleteFormId = null;

    function confirmDelete(id, title) {
        deleteFormId = id;
        document.getElementById('delete-item-name').textContent = title;
        $('#deleteConfirmModal').modal('show');
    }

    // ==================================================
    // Preview Gambar (Create)
    // ==================================================
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
    
    // ==================================================
    // Preview Gambar (Edit)
    // ==================================================
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


    // ==================================================
    // REVISI 4: Ganti onclick() dengan listener JQuery
    // ==================================================
    $(document).ready(function() {
        
        // Handler untuk tombol konfirmasi hapus
        $('#confirmDeleteBtn').on('click', function() {
            if (deleteFormId) {
                $('#delete-form-' + deleteFormId).submit();
            }
        });

        // Update label file input (Create)
        $('#create_image').on('change', function(event) {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
            previewCreateImage(event);
        });

        // Update label file input (Edit)
        $('#edit_image').on('change', function(event) {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
            previewEditImage(event);
        });

        // Listener untuk Modal Edit
        $('#editArticleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); 
            var modal = $(this);
            var form = modal.find('#editArticleForm');

            // Ambil data dari tombol
            var id = button.data('id');
            var update_url = button.data('update-url');
            var image_url = button.data('image-url');
            var title_id = button.data('title-id');
            var title_en = button.data('title-en');
            var subtitle_id = button.data('subtitle-id');
            var subtitle_en = button.data('subtitle-en');
            var description_id = button.data('description-id');
            var description_en = button.data('description-en');
            
            // Set action URL form
            form.attr('action', update_url);
            
            // Isi semua field form
            modal.find('.modal-title').text('Edit Artikel: ' + title_id);
            modal.find('#edit_article_id_hidden').val(id); // Isi hidden ID
            
            modal.find('#edit_title_id').val(title_id);
            modal.find('#edit_title_en').val(title_en);
            
            modal.find('#edit_subtitle_id').val(subtitle_id);
            modal.find('#edit_subtitle_en').val(subtitle_en);
            
            modal.find('#edit_description_id').val(description_id);
            modal.find('#edit_description_en').val(description_en);
            
            // Set gambar saat ini
            modal.find('#current_article_image').attr('src', image_url);
            
            // Reset preview gambar baru
            modal.find('#edit_preview_container').hide();
            modal.find('#edit_image').val('');
            modal.find('#edit_image').next('.custom-file-label').html('Pilih file gambar baru...');
        });

        // Buka modal CREATE jika ada error validasi
        <?php if($errors->any() && !old('_method')): ?>
            $('#createArticleModal').modal('show');
        <?php endif; ?>

        // Buka modal EDIT jika ada error validasi
        <?php if($errors->any() && old('_method') == 'PUT' && old('article_id')): ?>
            var modal = $('#editArticleModal');
            var form = modal.find('#editArticleForm');
            var failedId = "<?php echo e(old('article_id')); ?>";
            
            // Cari tombol yang gagal untuk ambil data-url
            var failedButton = $('.edit-btn[data-id="' + failedId + '"]');
            var update_url = failedButton.data('update-url');
            var image_url = failedButton.data('image-url'); 

            form.attr('action', update_url);
            modal.find('.modal-title').text('Edit Artikel: <?php echo e(old('title.id')); ?>');
            
            // Set gambar saat ini
            modal.find('#current_article_image').attr('src', image_url);
            
            modal.modal('show');
        <?php endif; ?>

        // Reset form create ketika modal ditutup
        $('#createArticleModal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
            $(this).find('.custom-file-label').html('Pilih file gambar...');
            $(this).find('#create_preview_container').hide();
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove(); // Hapus pesan error
            $(this).find('.alert-danger').remove(); // Hapus box error
        });

        // Reset form edit ketika modal ditutup
        $('#editArticleModal').on('hidden.bs.modal', function () {
            // Hanya reset jika TIDAK ada error validasi
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

/* Style untuk textarea */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* CSS untuk Modal Hapus */
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
/* REVISI 5: Tambahkan CSS ini untuk kolom tabel */
/* ================================================== */
.column-title,
.column-subtitle {
    /* Tentukan lebar minimum dan maksimum */
    min-width: 150px;
    max-width: 300px; /* Sesuaikan nilai ini jika perlu */
    
    /* Paksa teks untuk pindah baris (wrap) */
    overflow-wrap: break-word;
    word-wrap: break-word;
    white-space: normal !important;
}

/* Beri Judul lebih banyak ruang */
.column-title {
    min-width: 200px;
    max-width: 400px;
}

</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>