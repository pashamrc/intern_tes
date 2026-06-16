@extends('layouts.app')

@section('content')

<div class="card-modern">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="mb-1 fw-bold" style="color: var(--text-main);">Master Customer</h5>
            <small class="text-muted">Kelola data profil, status segmentasi, dan loyalitas pelanggan</small>
        </div>
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" id="btnAddCustomer" style="background-color: var(--primary-color); border-color: var(--primary-color); border-radius: var(--radius-md); font-weight: 500; font-size: 14px;">
            <i class="bi bi-person-plus"></i>
            <span>Tambah Customer</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table align-middle w-100" id="customerTable" style="border-color: var(--border-color);">
            <thead>
                <tr>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">No</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">ID Customer</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">Name</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">Email</th>
                    <th class="text-muted fw-semibold" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px;">Status</th>
                    <th class="text-muted fw-semibold text-end" style="font-size: 13px; background-color: var(--bg-main); padding: 14px 16px; width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px; color: var(--text-main);">
                </tbody>
        </table>
    </div>

</div>

@include('customers.modal')

@endsection

@push('scripts')
<script>
    // Inisialisasi Modal Bootstrap Customer
    let customerModal = new bootstrap.Modal(document.getElementById('customerModal'));

    // Server-side DataTables Integration & Styling
    let table = $('#customerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("customers.data") }}',
        dom: '<"d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4"f>rt<"d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari data customer...",
            processing: '<div class="spinner-border text-primary spinner-border-sm" role="status"></div>'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'user_id', name: 'user_id' },
            { data: 'name', name: 'name', className: 'fw-medium' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
        ],
        drawCallback: function() {
            // Sinkronisasi komponen input pencarian bawaan DataTables ke tema dashboard
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

    // Buka Modal Tambah Customer
    $('#btnAddCustomer').click(function () {
        $('#customerForm')[0].reset();
        $('#customer_id').val('');
        $('.modal-title').text('Tambah Customer');
        customerModal.show();
    });

    // Submit Form (Store & Update via AJAX)
    $('#customerForm').submit(function (e) {
        e.preventDefault();

        let id = $('#customer_id').val();
        let url = id ? '/customers/' + id : '{{ route("customers.store") }}';
        let formData = $(this).serialize();

        if (id) {
            formData += '&_method=PUT';
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (res) {
                customerModal.hide();
                $('#customerForm')[0].reset();
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

    // Ambil Data Saat Tombol Edit Ditekan
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');

        $.get('/customers/' + id, function (res) {
            $('#customer_id').val(res.user_id);
            $('#name').val(res.name);
            $('#email').val(res.email);
            $('.modal-title').text('Edit Customer');
            customerModal.show();
        });
    });

    // Proses Aksi Hapus dengan Dialog SweetAlert2 Premium
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus data ini?',
            text: 'Data customer yang dihapus tidak bisa dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            background: '#ffffff',
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/customers/' + id,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}' // Token CSRF Laravel aman terintegrasi
                    },
                    success: function (res) {
                        table.ajax.reload(null, false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus',
                            text: res.message ?? 'Customer berhasil dihapus',
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

    // Aksi Ubah Status Segmentasi/Loyalitas (PATCH Method)
    $(document).on('click', '.loyalBtn', function () {
        let id = $(this).data('id');

        $.ajax({
            url: '/customers/' + id + '/status',
            type: 'POST', // Menggunakan POST + _method PATCH agar kompatibel dengan sistem router bawaan
            data: {
                _method: 'PATCH',
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                table.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.message ?? 'Status berhasil diubah',
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
</script>
@endpush