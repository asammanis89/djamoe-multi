@extends('admin.layouts.app')

@section('title', 'Kelola Produk')
@section('content_header_title', 'Daftar Produk')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Data Produk</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createProductModal">
                <i class="fas fa-plus"></i> Tambah Produk
            </button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>

                    {{-- =================================== --}}
                    {{-- PERBAIKAN 1: Tambahkan class di <th> --}}
                    {{-- =================================== --}}
                    <th class="column-description">Deskripsi</th>
                    
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                    <td><img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->product_name }}" class="img-thumbnail" width="100"></td>
                    
                    {{-- REVISI: Tampilkan nama produk berdasarkan locale 'id' --}}
                    <td>{{ $product->getTranslation('product_name', 'id') }}</td>
                    
                    {{-- =================================== --}}
                    {{-- PERBAIKAN 2: Tambahkan class di <td> --}}
                    {{-- =================================== --}}
                    
                    {{-- REVISI: Tampilkan deskripsi berdasarkan locale 'id' --}}
                    <td class="column-description">{{ Str::limit($product->getTranslation('description', 'id'), 50) }}</td>
                    
                    {{-- REVISI: Asumsi category_name juga translatable --}}
                    <td>{{ $product->category->getTranslation('category_name', 'id') ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        @if($product->is_bestseller)
                            <span class="badge badge-success">Bestseller</span>
                        @else
                            <span class="badge badge-secondary">Reguler</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{-- Tombol Edit (REVISI BAGIAN 1: Mengubah data- attribute) --}}
                        <button 
                            type="button" 
                            class="btn btn-info btn-xs edit-btn" 
                            data-toggle="modal" 
                            data-target="#editProductModal"
                            data-id="{{ $product->id }}"
                            
                            {{-- REVISI: Ambil data terjemahan --}}
                            data-name-id="{{ $product->getTranslation('product_name', 'id') }}"
                            data-name-en="{{ $product->getTranslation('product_name', 'en') }}"
                            data-description-id="{{ $product->getTranslation('description', 'id') }}"
                            data-description-en="{{ $product->getTranslation('description', 'en') }}"
                            
                            data-category_id="{{ $product->category_id }}"
                            data-price="{{ $product->price }}"
                            data-is_bestseller="{{ $product->is_bestseller }}"
                            data-image_url="{{ asset('storage/' . $product->image_url) }}"
                            data-update_url="{{ route('admin.products.update', $product) }}"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        
                        {{-- REVISI: Gunakan nama 'id' untuk konfirmasi hapus --}}
                        <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete({{ $product->id }}, '{{ $product->getTranslation('product_name', 'id') }}')" title="Hapus">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>


{{-- =================================================================================== --}}
{{-- MODAL UNTUK "TAMBAH PRODUK" (REVISI BAGIAN 2)                                         --}}
{{-- =================================================================================== --}}
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="createProductModalLabel">Formulir Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 25px;">
                    
                    {{-- Tampilkan error validasi JIKA ADA (khusus untuk CREATE) --}}
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

                    {{-- REVISI: Input Nama Produk (ID) --}}
                    <div class="form-group">
                        <label for="product_name_id" class="font-weight-bold">Nama Produk (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('product_name.id') is-invalid @enderror" id="product_name_id" name="product_name[id]" value="{{ old('product_name.id') }}" required>
                        @error('product_name.id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    {{-- REVISI: Input Nama Produk (EN) --}}
                    <div class="form-group">
                        <label for="product_name_en" class="font-weight-bold">Nama Produk (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('product_name.en') is-invalid @enderror" id="product_name_en" name="product_name[en]" value="{{ old('product_name.en') }}" required>
                        @error('product_name.en')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <hr>
                    
                    {{-- REVISI: Input Deskripsi (ID) --}}
                    <div class="form-group">
                        <label for="description_id" class="font-weight-bold">Deskripsi Produk (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description.id') is-invalid @enderror" id="description_id" name="description[id]" rows="4" required>{{ old('description.id') }}</textarea>
                        @error('description.id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    {{-- REVISI: Input Deskripsi (EN) --}}
                    <div class="form-group">
                        <label for="description_en" class="font-weight-bold">Deskripsi Produk (English) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description.en') is-invalid @enderror" id="description_en" name="description[en]" rows="4" required>{{ old('description.en') }}</textarea>
                        @error('description.en')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <hr>

                    <div class="form-group">
                        <label for="category_id" class="font-weight-bold">Kategori Produk <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                {{-- REVISI: Tampilkan nama kategori (id) di dropdown --}}
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->getTranslation('category_name', 'id') }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    {{-- =================================== --}}
                    {{-- PERBARUAN HARGA 1: Input "price" di Modal Create --}}
                    {{-- =================================== --}}
                    <div class="form-group">
                        <label for="create_price_formatted" class="font-weight-bold">Harga <span class="text-danger">*</span></label>
                        
                        <input type="text" 
                               class="form-control input-rupiah @error('price') is-invalid @enderror" 
                               id="create_price_formatted" 
                               value="{{ old('price') }}" 
                               required>
                        
                        <input type="hidden" 
                               name="price" 
                               id="create_price_raw" 
                               value="{{ old('price') }}">
                                
                        @error('price')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    {{-- =================================== --}}
                    {{-- AKHIR PERBARUAN HARGA 1 --}}
                    {{-- =================================== --}}


                    <div class="form-group">
                        <label for="image_url" class="font-weight-bold">Gambar Produk <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image_url') is-invalid @enderror" id="image_url" name="image_url" required onchange="previewImage(event, 'create_image_preview')">
                            <label class="custom-file-label" for="image_url">Pilih file gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                        @error('image_url')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                        
                        <div id="create_image_preview_container" style="display: none; margin-top: 15px;">
                            <label class="font-weight-bold">Preview:</label>
                            <div style="border: 2px dashed #dee2e6; padding: 10px; text-align: center; border-radius: 5px;">
                                <img id="create_image_preview" src="#" alt="Preview" style="max-width: 100%; max-height: 300px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_bestseller" name="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_bestseller">Jadikan Produk Terlaris (Bestseller)</label>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- =================================================================================== --}}
{{-- MODAL UNTUK "EDIT PRODUK" (REVISI BAGIAN 3)                                           --}}
{{-- =================================================================================== --}}
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title font-weight-bold" id="editProductModalLabel">Formulir Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data" id="editProductForm">
                @csrf
                @method('PUT')
                <div class="modal-body" style="padding: 25px;">
                    
                    <input type="hidden" name="product_id" id="edit_product_id" value="{{ old('product_id') }}">

                    {{-- Tampilkan error validasi JIKA ADA (khusus untuk EDIT) --}}
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

                    {{-- REVISI: Input Edit Nama Produk (ID) --}}
                    <div class="form-group">
                        <label for="edit_product_name_id" class="font-weight-bold">Nama Produk (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('product_name.id') is-invalid @enderror" id="edit_product_name_id" name="product_name[id]" value="{{ old('product_name.id') }}" required>
                        @error('product_name.id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    {{-- REVISI: Input Edit Nama Produk (EN) --}}
                    <div class="form-group">
                        <label for="edit_product_name_en" class="font-weight-bold">Nama Produk (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('product_name.en') is-invalid @enderror" id="edit_product_name_en" name="product_name[en]" value="{{ old('product_name.en') }}" required>
                        @error('product_name.en')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <hr>
                    
                    {{-- REVISI: Input Edit Deskripsi (ID) --}}
                    <div class="form-group">
                        <label for="edit_description_id" class="font-weight-bold">Deskripsi Produk (Bahasa Indonesia) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description.id') is-invalid @enderror" id="edit_description_id" name="description[id]" rows="4" required>{{ old('description.id') }}</textarea>
                        @error('description.id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    {{-- REVISI: Input Edit Deskripsi (EN) --}}
                    <div class="form-group">
                        <label for="edit_description_en" class="font-weight-bold">Deskripsi Produk (English) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description.en') is-invalid @enderror" id="edit_description_en" name="description[en]" rows="4" required>{{ old('description.en') }}</textarea>
                        @error('description.en')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <hr>

                    <div class="form-group">
                        <label for="edit_category_id" class="font-weight-bold">Kategori Produk <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="edit_category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                {{-- REVISI: Tampilkan nama kategori (id) di dropdown --}}
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->getTranslation('category_name', 'id') }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    {{-- =================================== --}}
                    {{-- PERBARUAN HARGA 2: Input "price" di Modal Edit --}}
                    {{-- =================================== --}}
                    <div class="form-group">
                        <label for="edit_price_formatted" class="font-weight-bold">Harga <span class="text-danger">*</span></label>
                        
                        <input type="text" 
                               class="form-control input-rupiah @error('price') is-invalid @enderror" 
                               id="edit_price_formatted" 
                               value="{{ old('price') }}" 
                               required>
                                
                        <input type="hidden" 
                               name="price" 
                               id="edit_price_raw" 
                               value="{{ old('price') }}">
                                
                        @error('price')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    {{-- =================================== --}}
                    {{-- AKHIR PERBARUAN HARGA 2 --}}
                    {{-- =================================== --}}


                    <div class="form-group">
                        <label class="font-weight-bold">Gambar Saat Ini</label>
                        <div style="border: 2px solid #dee2e6; padding: 10px; text-align: center; border-radius: 5px; background-color: #f8f9fa;">
                            <img src="" alt="Current Image" class="img-thumbnail" style="max-width: 100%; max-height: 250px;" id="edit_image_preview">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_image_url" class="font-weight-bold">Ganti Gambar (Opsional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image_url') is-invalid @enderror" id="edit_image_url" name="image_url" onchange="previewImage(event, 'edit_image_preview')">
                            <label class="custom-file-label" for="edit_image_url">Pilih file gambar baru...</label>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                        @error('image_url')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="edit_is_bestseller" name="is_bestseller" value="1">
                        <label class="form-check-label" for="edit_is_bestseller">Jadikan Produk Terlaris (Bestseller)</label>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
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
                    Apakah Anda yakin ingin menghapus produk<br>
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


{{-- =================================================================================== --}}
{{-- REVISI DI SINI: Menggunakan @section('js') agar seragam dengan file lain            --}}
{{-- =================================================================================== --}}
@section('js')

{{-- =================================== --}}
{{-- PERBARUAN HARGA 3: Tambahkan CDN Cleave.js --}}
{{-- =================================== --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

<script>
    // ------------------------------------
    // JAVASCRIPT UNTUK MODAL HAPUS
    // ------------------------------------
    let deleteFormId = null;

    function confirmDelete(id, title) {
        deleteFormId = id;
        document.getElementById('delete-item-name').textContent = title;
        $('#deleteConfirmModal').modal('show');
    }

    // ------------------------------------
    // FUNGSI PREVIEW GAMBAR
    // ------------------------------------
    function previewImage(event, previewId) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById(previewId);
            var container = document.getElementById(previewId + '_container');
            output.src = reader.result;
            
            if(container) { // Untuk modal create
                container.style.display = 'block';
            }
            output.style.display = 'block'; // Untuk modal edit
        };
        reader.readAsDataURL(event.target.files[0]);

        // Update label custom file input
        var fileName = event.target.files[0].name;
        $(event.target).next('.custom-file-label').html(fileName);
    }


    $(document).ready(function() {
        
        // Handler untuk tombol konfirmasi hapus
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById('delete-form-' + deleteFormId).submit();
            }
        });

        // =================================== --}}
        // PERBARUAN HARGA 4: Logika Cleave.js & Populasi Data
        // =================================== --}}
        
        // Simpan instance Cleave agar bisa diakses
        var cleaveInstances = {};

        // Fungsi untuk inisialisasi Cleave.js pada sebuah input
        function initCleave(inputId) {
            var cleaveInstance = new Cleave(inputId, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand', // 1.000.000
                delimiter: '.',                         // Pemisah ribuan (Rp 1.000.000)
                numeralDecimalMark: ',',                // <-- TAMBAHKAN BARIS INI
                numeralDecimalScale: 0,                 // Tidak ada desimal
                prefix: 'Rp ',                          // Awalan 'Rp '
                noImmediatePrefix: true,                // 'Rp ' muncul saat mulai mengetik
                rawValueTrimPrefix: true                // Hapus 'Rp ' saat mengambil raw value
            });
            
            // Simpan instance untuk referensi nanti
            cleaveInstances[inputId] = cleaveInstance;
            
            // Update input 'raw' (tersembunyi) setiap kali user mengetik
            $(inputId).on('input', function() {
                // Ambil nilai mentah (angka saja)
                var rawValue = cleaveInstances[inputId].getRawValue();
                // Cari input tersembunyi yang sesuai
                var rawInputId = inputId.replace('_formatted', '_raw');
                // Set nilai input tersembunyi
                $(rawInputId).val(rawValue);
            });
        }

        // Inisialisasi untuk modal create
        initCleave('#create_price_formatted');
        
        // Inisialisasi untuk modal edit
        initCleave('#edit_price_formatted');


        // ------------------------------------
        // JAVASCRIPT UNTUK MODAL EDIT (REVISI BAGIAN 4)
        // ------------------------------------
        $('#editProductModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); 
            var id = button.data('id');
            
            // REVISI: Ambil data terjemahan dari data- attribute
            var name_id = button.data('name-id');
            var name_en = button.data('name-en');
            var description_id = button.data('description-id');
            var description_en = button.data('description-en');
            
            var category_id = button.data('category_id');
            var price = button.data('price'); // Ini berisi angka mentah, misal: 200000
            var is_bestseller = button.data('is_bestseller');
            var image_url = button.data('image_url');
            var update_url = button.data('update_url');
            
            var modal = $(this);
            var form = modal.find('#editProductForm');
            form.attr('action', update_url);
            
            // REVISI: Gunakan nama 'id' untuk judul
            modal.find('.modal-title').text('Edit Produk: ' + name_id);
            modal.find('#edit_product_id').val(id);
            
            // REVISI: Isi kedua field nama
            modal.find('#edit_product_name_id').val(name_id);
            modal.find('#edit_product_name_en').val(name_en);
            
            // REVISI: Isi kedua field deskripsi
            modal.find('#edit_description_id').val(description_id);
            modal.find('#edit_description_en').val(description_en);
            
            modal.find('#edit_category_id').val(category_id);
            
            // --- GANTI LOGIKA POPULASI HARGA ---
            // Hapus baris lama: modal.find('#edit_price').val(price); 
            
            // 1. Set nilai mentah ke input tersembunyi
            modal.find('#edit_price_raw').val(price); 
            // 2. Set nilai mentah ke Cleave.js agar diformat otomatis
            if (cleaveInstances['#edit_price_formatted']) {
                cleaveInstances['#edit_price_formatted'].setRawValue(price);
            }
            // --- AKHIR GANTI LOGIKA ---
            
            modal.find('#edit_image_preview').attr('src', image_url).show();
            modal.find('#edit_is_bestseller').prop('checked', (is_bestseller == 1));
            modal.find('#edit_image_url').val('');
            modal.find('#edit_image_url').next('.custom-file-label').html('Pilih file gambar baru...');
        });
        
        // =================================== --}}
        // AKHIR PERBARUAN HARGA 4
        // =================================== --}}


        // ------------------------------------
        // JAVASCRIPT UNTUK ERROR HANDLING MODAL
        // ------------------------------------
        
        // Buka modal CREATE jika ada error validasi
        @if ($errors->any() && !old('_method'))
            $('#createProductModal').modal('show');
            
            // Set ulang nilai Cleave.js jika ada old input
            @if(old('price'))
                if (cleaveInstances['#create_price_formatted']) {
                    cleaveInstances['#create_price_formatted'].setRawValue('{{ old('price') }}');
                }
            @endif
        @endif

        // Buka modal EDIT jika ada error validasi
        @if ($errors->any() && old('_method') == 'PUT' && old('product_id'))
            var modal = $('#editProductModal');
            var form = modal.find('#editProductForm');
            var failedId = "{{ old('product_id') }}";
            var failedButton = $('.edit-btn[data-id="' + failedId + '"]');
            var update_url = failedButton.data('update_url');
            var image_url = failedButton.data('image_url'); 

            form.attr('action', update_url);
            // REVISI: Gunakan 'product_name.id' jika ada, jika tidak, fallback
            modal.find('.modal-title').text('Edit Produk: {{ old('product_name.id', old('product_name')) }}');
            modal.find('#edit_image_preview').attr('src', image_url).show();
            modal.find('#edit_is_bestseller').prop('checked', {{ old('is_bestseller') ? 'true' : 'false' }});
            
            // Set ulang nilai Cleave.js jika ada old input
            if (cleaveInstances['#edit_price_formatted']) {
                cleaveInstances['#edit_price_formatted'].setRawValue('{{ old('price') }}');
            }
            
            modal.modal('show');
        @endif

        // ------------------------------------
        // JAVASCRIPT UNTUK RESET MODAL
        // ------------------------------------
        
        // Reset form create ketika modal ditutup
        $('#createProductModal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
            
            // Reset Cleave.js
            if (cleaveInstances['#create_price_formatted']) {
                cleaveInstances['#create_price_formatted'].setRawValue('');
            }
            $('#create_price_raw').val('');

            $(this).find('.custom-file-label').html('Pilih file gambar...');
            $(this).find('#create_image_preview_container').hide();
            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove();
            $(this).find('.alert-danger').remove();
        });

        // Reset form edit ketika modal ditutup
        $('#editProductModal').on('hidden.bs.modal', function () {
            // Hanya reset jika TIDAK ada error validasi
            @if (!($errors->any() && old('_method') == 'PUT'))
                $(this).find('form')[0].reset();
                
                // Reset Cleave.js
                if (cleaveInstances['#edit_price_formatted']) {
                    cleaveInstances['#edit_price_formatted'].setRawValue('');
                }
                $('#edit_price_raw').val('');

                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
                $(this).find('.alert-danger').remove();
            @endif
        });

    });
</script>

{{-- Style untuk konsistensi modal --}}
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

/* CSS untuk Modal Hapus (disamakan) */
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

/* =================================== */
/* PERBAIKAN 3: Tambahkan CSS ini      */
/* =================================== */
.column-description {
    max-width: 200px;  /* Batasi lebar maksimum kolom (sesuaikan jika perlu) */
    min-width: 150px;  /* Beri lebar minimum */
    
    /* Ini adalah bagian terpenting: */
    overflow-wrap: break-word; /* Memaksa teks pindah baris jika katanya terlalu panjang */
    word-wrap: break-word;     /* (Fallback untuk browser lama) */
    white-space: normal !important; /* Memastikan teks bisa wrap */
}
</style>
@endsection