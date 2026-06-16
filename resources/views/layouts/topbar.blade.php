<div class="topbar d-flex justify-content-between align-items-center">
    
    <div>
        <h5 class="mb-0 fw-bold text-dark" style="font-size: 16px;">Welcome Back, {{ auth()->user()->name }} 👋</h5>
        <small class="text-muted" style="font-size: 13px;">Have a nice day at work!</small>
    </div>

    <div class="dropdown">
        <button class="btn border-0 d-flex align-items-center gap-2 p-1" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: var(--radius-md); transition: var(--transition);">
            <div class="bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center rounded-circle fw-bold" style="width: 38px; height: 38px; font-size: 14px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="text-start d-none d-md-blockme-2">
                <span class="d-block fw-semibold" style="font-size: 13px; color: var(--text-main);">{{ auth()->user()->name }}</span>
                <span class="d-block text-muted" style="font-size: 11px;">Administrator</span>
            </div>
            <i class="bi bi-chevron-down text-muted" style="font-size: 12px;"></i>
        </button>
        
        <ul class="dropdown-menu dropdown-menu-end p-2 border-0 shadow-sm mt-2" aria-labelledby="dropdownUser" style="border-radius: var(--radius-md); min-width: 180px; background: #ffffff; border: 1px solid var(--border-color) !important;">
            <li><hr class="dropdown-divider my-2" style="border-color: var(--border-color);"></li>
            <li>
                <button type="button" class="dropdown-menu-item d-flex align-items-center gap-2 px-3 py-2 border-0 bg-transparent w-100 text-start text-danger rounded-2" id="btnLogout" style="font-size: 13px; transition: var(--transition);">
                    <i class="bi bi-box-arrow-right fs-5"></i> Logout
                </a>
            </li>
        </ul>
    </div>

</div>

<style>
    .dropdown-menu-item:hover {
        background-color: var(--bg-main) !important;
        color: var(--primary-color) !important;
    }
    .dropdown-menu-item.text-danger:hover {
        background-color: #fff1f2 !important;
        color: #dc2626 !important;
    }
</style>

<script>
    $('#btnLogout').click(function(e) {
        e.preventDefault();
        
        // Memanfaatkan SweetAlert2 (sudah di-load di layout utama) agar UI konfirmasi terasa premium
        Swal.fire({
            title: 'Are you sure?',
            text: "You will need to login again to access the dashboard.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5', // Menyesuaikan warna indigo tema utama
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, logout!',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-4 shadow',
                title: 'fw-bold text-dark'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Menampilkan loading state singkat sebelum redirect
                Swal.showLoading();
                
                $.ajax({
                    url: '{{ route("logout") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        window.location = res.redirect;
                    },
                    error: function() {
                        Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                    }
                });
            }
        });
    });
</script>