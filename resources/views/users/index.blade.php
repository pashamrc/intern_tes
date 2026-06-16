@extends('layouts.app')

@section('content')

<div class="card-modern">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="mb-1 fw-bold" style="color: var(--text-main);">Master User</h5>
            <small class="text-muted">Kelola hak akses dan data seluruh pengguna sistem</small>
        </div>
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" id="btnAddUser" style="background-color: var(--primary-color); border-color: var(--primary-color); border-radius: var(--radius-md); font-weight: 500; font-size: 14px;">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah User</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table align-middle w-100" id="userTable" style="border-color: var(--border-color);">
            <thead>
                <tr>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">No</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">Username</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">Nama</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">Email</th>
                    <th class="text-muted fw-semibold text-end" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px; width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px; color: var(--text-main);">
                </tbody>
        </table>
    </div>

</div>

@include('users.modal')

@endsection

@push('scripts')
<script>
    // Inisialisasi Modal Bootstrap
    let userModal = new bootstrap.Modal(document.getElementById('userModal'));

    // Server-side DataTables Styling Integration
    let table = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("users.data") }}',
        dom: '<"d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4"f>rt<"d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari data user...",
            processing: '<div class="spinner-border text-primary spinner-border-sm" role="status"></div>'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name', className: 'fw-medium' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
        ],
        drawCallback: function() {
            // Merapikan styling input pencarian bawaan datatables agar menyatu dengan tema
            $('.dataTables_filter input').addClass('form-control border-1').css({
                'border-radius': 'var(--radius-md)',
                'padding': '8px 16px',
                'font-size': '14px',
                'width': '260px',
                'border-color': 'var(--border-color)'
            });
            $('.dataTables_paginate .paginate_button').addClass('btn btn-sm mx-1');
        }
    });

    // Aksi Buka Modal Tambah User
    $('#btnAddUser').click(function () {
        $('#userForm')[0].reset();
        $('#user_id').val('');
        $('#password').prop('required', true);
        $('.modal-title').text('Tambah User');
        userModal.show();
    });

    // Proses Submit Form (Store & Update via AJAX)
    $('#userForm').submit(function (e) {
        e.preventDefault();

        let id = $('#user_id').val();
        let url = id ? '/users/' + id : '{{ route("users.store") }}';
        let formData = $(this).serialize();

        if (id) {
            formData += '&_method=PUT';
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (res) {
                userModal.hide();
                $('#userForm')[0].reset();
                table.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.message ?? 'Data berhasil disimpan',
                    confirmButtonColor: '#4f46e5',
                    customClass: { popup: 'rounded-4' }
                });
            },
            error: function (xhr) {
                let msg = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: msg,
                    confirmButtonColor: '#4f46e5',
                    customClass: { popup: 'rounded-4' }
                });
            }
        });
    });

    // Aksi Tombol Edit (Fetch Data)
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');

        $.get('/users/' + id, function (res) {
            $('#user_id').val(res.id);
            $('#username').val(res.username);
            $('#name').val(res.name);
            $('#email').val(res.email);
            $('#password').val('');
            $('#password').prop('required', false);
            $('.modal-title').text('Edit User');
            userModal.show();
        });
    });

    // Aksi Tombol Hapus (Soft/Hard Delete via AJAX)
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus data ini?',
            text: 'Data yang dihapus tidak bisa dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444', // Merah destructif modern
            cancelButtonColor: '#64748b',
            background: '#ffffff',
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/users/' + id,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}' // Mengamankan AJAX request dari proteksi CSRF Laravel
                    },
                    success: function (res) {
                        table.ajax.reload(null, false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus',
                            text: res.message ?? 'Data berhasil dihapus',
                            confirmButtonColor: '#4f46e5',
                            customClass: { popup: 'rounded-4' }
                        });
                    },
                    error: function (xhr) {
                        let msg = 'Terjadi kesalahan';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: msg,
                            confirmButtonColor: '#4f46e5',
                            customClass: { popup: 'rounded-4' }
                        });
                    }
                });
            }
        });
    });
</script>
@endpush