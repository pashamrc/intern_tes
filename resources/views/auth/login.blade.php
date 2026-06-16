<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Sistem</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #e0e7ff; /* Lebih soft untuk background icon */
            --text-main: #1e293b; /* Lebih gelap sedikit untuk kontras */
            --text-muted: #64748b;
            --border-color: #cbd5e1;
            --bg-body: #f1f5f9; /* Abu-abu yang sangat muda */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        .login-card {
            border: none;
            border-radius: 20px; /* Sedikit lebih melengkung */
            background: #ffffff;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            transition: transform 0.3s ease;
        }

        /* Opsional: Efek melayang saat dihover (bisa dihapus jika tidak suka) */
        .login-card:hover {
            transform: translateY(-5px);
        }

        .custom-input {
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 12px 18px; /* Lebih lega */
            font-size: 14px;
            color: var(--text-main);
            background-color: #f8fafc;
            transition: all 0.25s ease;
        }

        .custom-input::placeholder {
            color: #94a3b8;
        }

        .custom-input:focus {
            background-color: #ffffff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15); /* Focus ring lebih halus */
            outline: none;
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px -1px rgba(79, 70, 229, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px -1px rgba(79, 70, 229, 0.2);
        }
        
        .icon-container {
            width: 56px;
            height: 56px;
            background-color: var(--primary-light);
            color: var(--primary-color);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">
                
                <div class="card login-card p-4 p-sm-5">
                    
                    <div class="text-center mb-4">
                        <div class="icon-container">
                            <i class="bi bi-shield-lock-fill" style="font-size: 26px;"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: #0f172a; letter-spacing: -0.5px;">Welcome Back</h4>
                        <p class="text-muted small" style="color: var(--text-muted) !important;">Silakan masuk untuk mengakses dashboard</p>
                    </div>

                    <form id="formLogin">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold small mb-2" style="color: #475569;">Username</label>
                            <input type="text" 
                                   name="username" 
                                   class="form-control custom-input" 
                                   placeholder="Masukkan username"
                                   required
                                   autocomplete="username">
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-semibold small mb-0" style="color: #475569;">Password</label>
                                </div>
                            <input type="password" 
                                   name="password" 
                                   class="form-control custom-input" 
                                   placeholder="••••••••"
                                   required
                                   autocomplete="current-password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-login w-100 mt-2">
                            Sign In
                        </button>
                    </form>

                </div>

                <p class="text-center text-muted mt-5" style="font-size: 13px; font-weight: 500;">
                    &copy; 2026 Admin Dashboard System.
                </p>

            </div>
        </div>
    </div>

    <script>
        $('#formLogin').submit(function (e) {
            e.preventDefault();

            let submitBtn = $(this).find('button[type="submit"]');
            let originalText = submitBtn.text();
            
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Signing in...');

            $.ajax({
                url: '{{ route("login.submit") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        confirmButtonColor: '#4f46e5',
                        customClass: { popup: 'rounded-4' },
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location = res.redirect;
                    });
                },
                error: function (xhr) {
                    submitBtn.prop('disabled', false).text(originalText);

                    let errorMsg = 'Username atau password salah.';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: errorMsg,
                        confirmButtonColor: '#4f46e5',
                        customClass: { popup: 'rounded-4' }
                    });
                }
            });
        });
    </script>

</body>
</html>