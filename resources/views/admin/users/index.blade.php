@extends('admin.layouts.app')

@section('title', 'Daftar User')

@section('content_header')
    <h1>Manajemen User</h1>
@stop

@section('content')

    {{-- 1. NOTIFIKASI SUKSES/ERROR --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUserModal">
                <i class="fas fa-plus"></i> Buat User Baru
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width: 280px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'super_admin')
                                    <span class="badge badge-danger">Super Admin</span>
                                @else
                                    <span class="badge badge-info">Admin</span>
                                @endif
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                @if($user->id !== Auth::id())
                                    {{-- Tombol Edit (Sudah Benar) --}}
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-primary edit-btn" 
                                        data-toggle="modal" 
                                        data-target="#editUserModal"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-username="{{ $user->username }}"
                                        data-email="{{ $user->email }}"
                                        data-role="{{ $user->role }}"
                                        data-update-url="{{ route('admin.users.update', $user) }}"
                                    >
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    
                                    {{-- Tombol Aksi (Sudah Benar) --}}
                                    @if($user->is_active)
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            onclick="confirmAction(
                                                'deactivate-form-{{ $user->id }}', 
                                                'Konfirmasi Nonaktifkan', 
                                                'Apakah Anda yakin ingin menonaktifkan user <strong>{{ $user->name }}</strong>?', 
                                                'warning'
                                            )">
                                            <i class="fas fa-times-circle"></i> Nonaktifkan
                                        </button>
                                        <form id="deactivate-form-{{ $user->id }}" action="{{ route('admin.users.deactivate', $user) }}" method="POST" style="display: none;">
                                            @csrf @method('PUT')
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick="confirmAction(
                                                'activate-form-{{ $user->id }}', 
                                                'Konfirmasi Aktifkan', 
                                                'Apakah Anda yakin ingin mengaktifkan user <strong>{{ $user->name }}</strong>?', 
                                                'success'
                                            )">
                                            <i class="fas fa-check-circle"></i> Aktifkan
                                        </button>
                                        <form id="activate-form-{{ $user->id }}" action="{{ route('admin.users.activate', $user) }}" method="POST" style="display: none;">
                                            @csrf @method('PUT')
                                        </form>
                                    @endif

                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmAction(
                                            'delete-form-{{ $user->id }}', 
                                            'Konfirmasi Hapus', 
                                            'Apakah Anda yakin ingin menghapus user <strong>{{ $user->name }}</strong>? Tindakan ini tidak bisa dibatalkan.', 
                                            'danger'
                                        )">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: none;">
                                        @csrf @method('DELETE')
                                    </form>

                                @else
                                    <span class="text-muted">— Diri Sendiri —</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- =================================================================================== --}}
    {{-- 2. MODAL UNTUK "BUAT USER BARU" (Sudah Rapi)                                     --}}
    {{-- =================================================================================== --}}
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Buat User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('admin.users.store') }}">
                    <div class="modal-body">
                        @csrf
                        
                        @if ($errors->any() && !old('_method'))
                            <div class="alert alert-danger">
                                <strong>Whoops! Ada yang salah.</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" 
                                name="name" 
                                id="name"
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" 
                                id="username" 
                                name="username" 
                                class="form-control @error('username') is-invalid @enderror" 
                                value="{{ old('username') }}" 
                                required 
                                minlength="3"
                                maxlength="255">
                            @error('username')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" 
                                id="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email') }}" 
                                required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" 
                                id="role" 
                                name="role"
                                required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" 
                                id="password" 
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                required 
                                minlength="6"
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <small class="form-text text-muted">Minimal 6 karakter.</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-control" 
                                required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- =================================================================================== --}}
    {{-- 3. MODAL UNTUK "EDIT USER" (Sudah Rapi)                                           --}}
    {{-- =================================================================================== --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form method="POST" action="" id="editUserForm"> 
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="user_id" id="edit_user_id" value="{{ old('user_id') }}">
                        
                        @if ($errors->any() && old('_method') == 'PUT')
                            <div class="alert alert-danger">
                                <strong>Whoops! Ada yang salah.</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="edit_name">Nama Lengkap</label>
                            <input type="text" id="edit_name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" id="edit_username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                            @error('username')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" id="edit_email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="edit_role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="edit_role" name="role">
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <hr>
                        <p class="text-muted">Ganti Password (Opsional)</p>

                        <div class="form-group">
                            <label for="edit_password">Password (Opsional)</label>
                            <input type="password" id="edit_password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin ganti password">
                            <small class="form-text text-muted">Isi hanya jika Anda ingin mengubah password.</small>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="edit_password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Modal Konfirmasi Aksi Generik --}}
    <div class="modal fade" id="confirmActionModal" tabindex="-1" role="dialog" aria-labelledby="confirmActionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden;">
                <div class="modal-body text-center" style="padding: 40px 30px;">
                    <div id="confirm-icon-container" style="width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i id="confirm-icon" class="fas" style="font-size: 40px; color: white;"></i>
                    </div>
                    <h4 id="confirm-title" class="font-weight-bold mb-3" style="color: #2d3748;"></h4>
                    <p id="confirm-message" style="color: #718096; font-size: 15px; margin-bottom: 25px;"></p>
                    <div class="d-flex justify-content-center" style="gap: 10px;">
                        <button type="button" class="btn btn-light px-4 py-2" data-dismiss="modal" style="border-radius: 8px; border: 1px solid #e2e8f0; font-weight: 500;">
                            <i class="fas fa-times mr-1"></i> Batal
                        </button>
                        <button type="button" class="btn px-4 py-2" id="confirmActionBtn" style="border-radius: 8px; font-weight: 500; border: none;">
                            <i id="confirm-btn-icon" class="fas mr-1"></i> 
                            <span id="confirm-btn-text"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- =================================================================================== --}}
{{-- 4. JAVASCRIPT & CSS                                                              --}}
{{-- =================================================================================== --}}

{{-- ================================================== --}}
{{-- PERUBAHAN DI SINI: dari @section('js') ke @push('js_page') --}}
{{-- ================================================== --}}
@push('js_page')
<script>
    // JAVASCRIPT UNTUK MODAL GENERIK
    let actionFormId = null; 

    function confirmAction(formId, title, message, theme) {
        actionFormId = formId; 
        $('#confirm-title').text(title);
        $('#confirm-message').html(message); 

        var iconContainer = $('#confirm-icon-container');
        var icon = $('#confirm-icon');
        var confirmBtn = $('#confirmActionBtn');
        var confirmBtnIcon = $('#confirm-btn-icon');
        var confirmBtnText = $('#confirm-btn-text');

        icon.removeClass('fa-exclamation-triangle fa-check-circle fa-trash');
        confirmBtnIcon.removeClass('fa-times-circle fa-check-circle fa-trash');
        iconContainer.css('background', '');
        confirmBtn.css('background', '');
        confirmBtn.removeClass('btn-danger btn-warning btn-success');

        switch(theme) {
            case 'danger': 
                iconContainer.css('background', 'linear-gradient(135deg, #f56565 0%, #c53030 100%)');
                icon.addClass('fa-exclamation-triangle');
                confirmBtn.addClass('btn-danger').css('background', 'linear-gradient(135deg, #f56565 0%, #c53030 100%)');
                confirmBtnIcon.addClass('fa-trash');
                confirmBtnText.text('Ya, Hapus');
                break;
            case 'warning': 
                iconContainer.css('background', 'linear-gradient(135deg, #f6e05e 0%, #ed8936 100%)');
                icon.addClass('fa-exclamation-triangle');
                confirmBtn.addClass('btn-warning').css({
                    'background': 'linear-gradient(135deg, #f6e05e 0%, #ed8936 100%)',
                    'color': '#2d3748'
                });
                confirmBtnIcon.addClass('fa-times-circle');
                confirmBtnText.text('Ya, Nonaktifkan');
                break;
            case 'success': 
                iconContainer.css('background', 'linear-gradient(135deg, #68d391 0%, #38a169 100%)');
                icon.addClass('fa-check-circle');
                confirmBtn.addClass('btn-success').css('background', 'linear-gradient(135deg, #68d391 0%, #38a169 100%)');
                confirmBtnIcon.addClass('fa-check-circle');
                confirmBtnText.text('Ya, Aktifkan');
                break;
            default: 
                iconContainer.css('background', 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)');
                icon.addClass('fa-question-circle');
                confirmBtn.addClass('btn-primary');
                confirmBtnIcon.addClass('fa-check');
                confirmBtnText.text('Ya, Lanjutkan');
        }
        $('#confirmActionModal').modal('show');
    }

    $(document).ready(function() {
        
        // Handler untuk tombol modal generik
        document.getElementById('confirmActionBtn').addEventListener('click', function() {
            if (actionFormId) {
                document.getElementById(actionFormId).submit();
            }
        });
        
        // SCRIPT UNTUK MENGISI MODAL EDIT SAAT DIKLIK
        $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var username = button.data('username');
            var email = button.data('email');
            var role = button.data('role');
            var updateUrl = button.data('update-url');
            
            var modal = $(this);
            var form = modal.find('#editUserForm');
            form.attr('action', updateUrl); 
            
            modal.find('.modal-title').text('Edit User: ' + username);
            modal.find('#edit_user_id').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_username').val(username);
            modal.find('#edit_email').val(email);
            modal.find('#edit_role').val(role);
            modal.find('#edit_password').val('');
            modal.find('#edit_password_confirmation').val('');
        });

        
        // SCRIPT UNTUK OTOMATIS MEMBUKA MODAL "CREATE" JIKA ADA ERROR VALIDASI
        @if ($errors->any() && !old('_method'))
            $('#createUserModal').modal('show');
        @endif

        
        // SCRIPT UNTUK OTOMATIS MEMBUKA MODAL "EDIT" JIKA ADA ERROR VALIDASI
        @if ($errors->any() && old('_method') == 'PUT' && old('user_id'))
            var modal = $('#editUserModal');
            var form = modal.find('#editUserForm');
            var failedId = "{{ old('user_id') }}";
            var failedButton = $('.edit-btn[data-id="' + failedId + '"]');
            var updateUrl = failedButton.data('update-url');

            form.attr('action', updateUrl);
            modal.find('.modal-title').text('Edit User: {{ old('username') }}');
            modal.modal('show');
        @endif

    });
</script>

{{-- CSS untuk Modal --}}
<style>
/* Styling untuk modal create/edit */
.modal-content {
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,.3);
}
.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.modal-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

/* Hover effect untuk semua tombol */
.btn {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,.2);
}

/* Styling untuk modal konfirmasi aksi */
#confirmActionModal .modal-dialog {
    max-width: 450px;
}
#confirmActionModal .modal-content {
    animation: modalSlideIn 0.3s ease-out;
}
@keyframes modalSlideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
#confirmActionModal .btn-light:hover {
    background-color: #f7fafc;
    border-color: #cbd5e0;
}

/* Hover effects untuk tombol tema */
#confirmActionBtn.btn-danger:hover {
    box-shadow: 0 6px 12px rgba(245, 101, 101, 0.4);
}
#confirmActionBtn.btn-warning:hover {
    box-shadow: 0 6px 12px rgba(237, 137, 54, 0.4);
}
#confirmActionBtn.btn-success:hover {
    box-shadow: 0 6px 12px rgba(56, 161, 105, 0.4);
}
</style>
@endpush
{{-- ================================================== --}}
{{-- PERUBAHAN DI SINI: dari @stop ke @endpush --}}
{{-- ================================================== --}}