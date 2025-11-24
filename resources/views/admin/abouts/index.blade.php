@extends('admin.layouts.app')
@section('title', 'Kelola Cerita Kami')
@section('content_header_title', 'Daftar Cerita Tentang Kami')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Cerita</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createAboutModal">
                <i class="fas fa-plus"></i> Tambah Cerita
            </button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        {{-- REVISI: Tambahkan error handling jika modal gagal (untuk debugging) --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    
                    {{-- =================================== --}}
                    {{-- PERBAIKAN 1: Tambahkan class di <th> --}}
                    {{-- =================================== --}}
                    <th class="column-year">Teks Tahun</th>
                    <th class="column-title">Judul</th>
                    
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($abouts as $about)
                <tr>
                    <td><img src="{{ asset('storage/' . $about->image) }}" class="img-thumbnail" width="150" alt="{{ $about->getTranslation('title', 'id') }}"></td>
                    
                    {{-- =================================== --}}
                    {{-- REVISI 2: Tampilkan data terjemahan & class di <td> --}}
                    {{-- =================================== --}}
                    <td class="column-year">{{ $about->getTranslation('year_text', 'id') }}</td>
                    <td class="column-title">{{ $about->getTranslation('title', 'id') }}</td>
                    
                    <td>
                        {{-- REVISI 3: Mengganti onclick() dengan data- attributes --}}
                        <button type="button" 
                            class="btn btn-info btn-xs edit-btn"
                            data-toggle="modal"
                            data-target="#editAboutModal"
                            data-id="{{ $about->id }}"
                            data-update-url="{{ route('admin.abouts.update', $about) }}"
                            data-image-url="{{ asset('storage/' . $about->image) }}"
                            data-year_text-id="{{ $about->getTranslation('year_text', 'id') }}"
                            data-year_text-en="{{ $about->getTranslation('year_text', 'en') }}"
                            data-title-id="{{ $about->getTranslation('title', 'id') }}"
                            data-title-en="{{ $about->getTranslation('title', 'en') }}"
                            data-description-id="{{ $about->getTranslation('description', 'id') }}"
                            data-description-en="{{ $about->getTranslation('description', 'en') }}"
                            >
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        
                        {{-- REVISI: Gunakan data terjemahan untuk konfirmasi hapus --}}
                        <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete({{ $about->id }}, '{{ $about->getTranslation('title', 'id') }}')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $about->id }}" action="{{ route('admin.abouts.destroy', $about) }}" method="POST" style="display: none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada cerita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- =================================================================================== --}}
{{-- MODAL CREATE (REVISI BAGIAN 4)                                                      --}}
{{-- =================================================================================== --}}
<div class="modal fade" id="createAboutModal" tabindex="-1" role="dialog" aria-labelledby="createAboutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="createAboutModalLabel">Formulir Tambah Cerita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.abouts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 25px;">

                    {{-- REVISI: Tambahkan error handling lengkap --}}
                    @if ($errors->any() && !old('_method'))
                        <div class="alert alert-danger">
                            <strong class="font-weight-bold">Whoops! Ada yang salah.</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="create_year_text_id" class="font-weight-bold">Teks Tahun (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('year_text.id') is-invalid @enderror" id="create_year_text_id" name="year_text[id]" value="{{ old('year_text.id') }}" placeholder="Contoh: 1988" required>
                        <small class="form-text text-muted">Format: Tahun (contoh : 2015) atau Teks (Sejak 1988)</small>
                        @error('year_text.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_year_text_en" class="font-weight-bold">Teks Tahun (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('year_text.en') is-invalid @enderror" id="create_year_text_en" name="year_text[en]" value="{{ old('year_text.en') }}" placeholder="Contoh: 1988" required>
                        <small class="form-text text-muted">Format: Year (e.g., 2015) or Text (Since 1988)</small>
                        @error('year_text.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_title_id" class="font-weight-bold">Judul Cerita (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title.id') is-invalid @enderror" id="create_title_id" name="title[id]" value="{{ old('title.id') }}" placeholder="Contoh: Perjalanan Dimulai" required>
                        @error('title.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_title_en" class="font-weight-bold">Judul Cerita (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title.en') is-invalid @enderror" id="create_title_en" name="title[en]" value="{{ old('title.en') }}" placeholder="Contoh: The Journey Begins" required>
                        @error('title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_description_id" class="font-weight-bold">Deskripsi (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea name="description[id]" id="create_description_id" class="form-control @error('description.id') is-invalid @enderror" rows="4" placeholder="Ceritakan tentang perjalanan atau milestone perusahaan..." required>{{ old('description.id') }}</textarea>
                        @error('description.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_description_en" class="font-weight-bold">Deskripsi (English) <span class="text-danger">*</span></label>
                        <textarea name="description[en]" id="create_description_en" class="form-control @error('description.en') is-invalid @enderror" rows="4" placeholder="Tell the story about the company's journey or milestone..." required>{{ old('description.en') }}</textarea>
                        @error('description.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="create_image" class="font-weight-bold">Gambar <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="create_image" name="image" required accept="image/*">
                            <label class="custom-file-label" for="create_image">Pilih file gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
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

{{-- =================================================================================== --}}
{{-- MODAL EDIT (REVISI BAGIAN 5)                                                        --}}
{{-- =================================================================================== --}}
<div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog" aria-labelledby="editAboutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="editAboutModalLabel">Formulir Edit Cerita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editAboutForm" method="POST" enctype="multipart/form-data" action=""> {{-- Action di-set JS --}}
                @csrf
                @method('PUT')
                <div class="modal-body" style="padding: 25px;">
                    
                    {{-- REVISI: Tambahkan hidden input untuk ID --}}
                    <input type="hidden" name="about_id" id="edit_about_id_hidden" value="{{ old('about_id') }}">

                    {{-- REVISI: Tambahkan error handling lengkap --}}
                    @if ($errors->any() && old('_method') == 'PUT')
                        <div class="alert alert-danger">
                            <strong class="font-weight-bold">Whoops! Ada yang salah.</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="edit_year_text_id" class="font-weight-bold">Teks Tahun (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('year_text.id') is-invalid @enderror" id="edit_year_text_id" name="year_text[id]" value="{{ old('year_text.id') }}" required>
                        <small class="form-text text-muted">Format: Tahun (contoh : 2015)</small>
                        @error('year_text.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_year_text_en" class="font-weight-bold">Teks Tahun (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('year_text.en') is-invalid @enderror" id="edit_year_text_en" name="year_text[en]" value="{{ old('year_text.en') }}" required>
                        <small class="form-text text-muted">Format: Year (e.g., 2015)</small>
                        @error('year_text.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="edit_title_id" class="font-weight-bold">Judul Cerita (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title.id') is-invalid @enderror" id="edit_title_id" name="title[id]" value="{{ old('title.id') }}" required>
                        @error('title.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_title_en" class="font-weight-bold">Judul Cerita (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title.en') is-invalid @enderror" id="edit_title_en" name="title[en]" value="{{ old('title.en') }}" required>
                        @error('title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="edit_description_id" class="font-weight-bold">Deskripsi (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea name="description[id]" id="edit_description_id" class="form-control @error('description.id') is-invalid @enderror" rows="4" required>{{ old('description.id') }}</textarea>
                        @error('description.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_description_en" class="font-weight-bold">Deskripsi (English) <span class="text-danger">*</span></label>
                        <textarea name="description[en]" id="edit_description_en" class="form-control @error('description.en') is-invalid @enderror" rows="4" required>{{ old('description.en') }}</textarea>
                        @error('description.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="font-weight-bold">Gambar Saat Ini</label>
                        <div style="border: 2px solid #dee2e6; padding: 10px; text-align: center; border-radius: 5px; background-color: #f8f9fa;">
                            <img id="current_about_image" src="" alt="Gambar" class="img-thumbnail" style="max-width: 100%; max-height: 250px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_image" class="font-weight-bold">Ganti Gambar (Opsional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="edit_image" name="image" accept="image/*">
                            <label class="custom-file-label" for="edit_image">Pilih file gambar baru...</label>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
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
                    Apakah Anda yakin ingin menghapus cerita<br>
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

@endsection

@section('js')
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
// JAVASCRIPT UNTUK PREVIEW GAMBAR
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
// REVISI 6: Ganti onclick() dengan listener JQuery
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
    $('#editAboutModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var modal = $(this);
        var form = modal.find('#editAboutForm');

        // Ambil data dari tombol
        var id = button.data('id');
        var update_url = button.data('update-url');
        var image_url = button.data('image-url');
        
        var year_text_id = button.data('year_text-id');
        var year_text_en = button.data('year_text-en');
        var title_id = button.data('title-id');
        var title_en = button.data('title-en');
        var description_id = button.data('description-id');
        var description_en = button.data('description-en');
        
        // Set action URL form
        form.attr('action', update_url);
        
        // Isi semua field form
        modal.find('.modal-title').text('Edit Cerita: ' + title_id);
        modal.find('#edit_about_id_hidden').val(id); // Isi hidden ID
        
        modal.find('#edit_year_text_id').val(year_text_id);
        modal.find('#edit_year_text_en').val(year_text_en);
        
        modal.find('#edit_title_id').val(title_id);
        modal.find('#edit_title_en').val(title_en);
        
        modal.find('#edit_description_id').val(description_id);
        modal.find('#edit_description_en').val(description_en);
        
        // Set gambar saat ini
        modal.find('#current_about_image').attr('src', image_url);
        
        // Reset preview gambar baru
        modal.find('#edit_preview_container').hide();
        modal.find('#edit_image').val('');
        modal.find('#edit_image').next('.custom-file-label').html('Pilih file gambar baru...');
    });

    // Buka modal CREATE jika ada error validasi
    @if ($errors->any() && !old('_method'))
        $('#createAboutModal').modal('show');
    @endif

    // Buka modal EDIT jika ada error validasi
    @if ($errors->any() && old('_method') == 'PUT' && old('about_id'))
        var modal = $('#editAboutModal');
        var form = modal.find('#editAboutForm');
        var failedId = "{{ old('about_id') }}";
        
        // Cari tombol yang gagal untuk ambil data-url
        var failedButton = $('.edit-btn[data-id="' + failedId + '"]');
        var update_url = failedButton.data('update-url');
        var image_url = failedButton.data('image-url'); 

        form.attr('action', update_url);
        modal.find('.modal-title').text('Edit Cerita: {{ old('title.id') }}');
        
        // Set gambar saat ini
        modal.find('#current_about_image').attr('src', image_url);
        
        modal.modal('show');
    @endif


    // Reset form create ketika modal ditutup
    $('#createAboutModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.custom-file-label').html('Pilih file gambar...');
        $(this).find('#create_preview_container').hide();
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
        $(this).find('.alert-danger').remove();
    });

    // Reset form edit ketika modal ditutup
    $('#editAboutModal').on('hidden.bs.modal', function () {
        @if (!($errors->any() && old('_method') == 'PUT'))
            $(this).find('form')[0].reset();
            $(this).find('.custom-file-label').html('Pilih file gambar baru...');
            $(this).find('#edit_preview_container').hide();
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove();
            $(this).find('.alert-danger').remove();
        @endif
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
.custom-file-label::after {
    content: "Browse";
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
    min-height: 100px;
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
/* PERBAIKAN 3: Tambahkan CSS ini untuk kolom tabel   */
/* ================================================== */
.column-title {
    min-width: 200px;
    max-width: 450px; /* Beri ruang lebih untuk judul */
    overflow-wrap: break-word;
    word-wrap: break-word;
    white-space: normal !important;
}

.column-year {
    width: 120px; /* Kolom tahun tidak perlu lebar */
    white-space: nowrap; /* Pastikan tahun tidak ter-wrap */
}
</style>
@endsection