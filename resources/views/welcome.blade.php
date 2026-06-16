<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lia Butik Binuang - Premium Cosmetics</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brand-color: #db2777; /* Pink Rose */
            --brand-light: #fce7f3;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --bg-soft: #fff1f2;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
        }

        h1, h2, h3, .brand-text {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: var(--brand-color) !important;
            font-weight: 600;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--brand-color) !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #fff1f2 0%, #fce7f3 100%);
            padding: 120px 0 80px;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.2;
            color: #0f172a;
            margin-bottom: 1.5rem;
        }

        .btn-brand {
            background-color: var(--brand-color);
            color: white;
            border-radius: 30px;
            padding: 12px 32px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-brand:hover {
            background-color: #be185d;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(219, 39, 119, 0.2);
            color: white;
        }

        /* Product Cards */
        .product-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .product-img-wrapper {
            height: 250px;
            background-color: var(--bg-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--brand-color);
        }

        .product-price {
            color: var(--brand-color);
            font-weight: 600;
            font-size: 1.25rem;
        }

        .badge-new {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--brand-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background-color: #0f172a;
            color: white;
            padding: 60px 0 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand brand-text" href="#">Lia Butik Binuang</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#products">Shop</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#">About Us</a></li>
                </ul>
                <div class="d-flex gap-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-dark rounded-pill px-4" style="font-weight: 500;">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
                    <span class="badge bg-white text-pink rounded-pill px-3 py-2 mb-3 shadow-sm" style="color: var(--brand-color);">✨ New Collection 2026</span>
                    <h1 class="hero-title">Pancarkan Kecantikan Alami Anda.</h1>
                    <p class="text-muted fs-5 mb-4" style="line-height: 1.6;">
                        Temukan rangkaian kosmetik eksklusif yang dirancang khusus untuk merawat dan menonjolkan pesona unik kulit Anda setiap hari.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#products" class="btn btn-brand">Belanja Sekarang <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative w-100" style="height: 400px; background: white; border-radius: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 25px 50px -12px rgba(219, 39, 119, 0.15);">
                        <i class="bi bi-stars" style="font-size: 8rem; color: var(--brand-light);"></i>
                        <h2 class="position-absolute brand-text" style="color: var(--brand-color);">Glow & Elegant</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Best Seller Kami</h2>
                <p class="text-muted">Produk kosmetik favorit pilihan pelanggan setia.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <span class="badge-new">Hot Item</span>
                            <div class="product-img-wrapper">
                                <i class="bi bi-magic"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1">Radiance Luminous Serum</h5>
                            <p class="text-muted small mb-3">Serum pencerah dengan ekstrak bunga sakura.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="product-price">Rp 185.000</span>
                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <div class="product-img-wrapper">
                                <i class="bi bi-droplet-half"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1">Velvet Matte Lip Cream</h5>
                            <p class="text-muted small mb-3">Tekstur ringan, tahan lama hingga 12 jam.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="product-price">Rp 95.000</span>
                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <div class="product-img-wrapper">
                                <i class="bi bi-palette"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1">Flawless Cushion Foundation</h5>
                            <p class="text-muted small mb-3">Coverage sempurna dengan hasil dewy finish.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="product-price">Rp 210.000</span>
                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row gy-4 border-bottom border-secondary pb-4 mb-4">
                <div class="col-lg-5">
                    <h3 class="brand-text text-white mb-3">Lia Butik Binuang</h3>
                    <p class="text-secondary pe-lg-5">Membawa keindahan alami ke setiap rutinitas perawatan kulit Anda. 100% Cruelty-Free & Vegan Kosmetik.</p>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white mb-3 fs-6 fw-bold">Shop</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Skincare</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Makeup</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Bundles</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white mb-3 fs-6 fw-bold">Support</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Shipping</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center text-secondary small">
                &copy; 2026 Lia Butik Binuang. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>