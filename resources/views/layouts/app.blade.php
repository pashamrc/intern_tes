<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Intern Test</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --bg-main: #f8fafc;
            --sidebar-bg: #ffffff;
            --primary-color: #4f46e5; /* Indigo Modern */
            --primary-light: #eeebff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #f1f5f9;
            --radius-lg: 16px;
            --radius-md: 12px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--bg-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        /* Sidebar Modern Styling */
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 24px 16px;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px 24px 12px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 24px;
        }

        .sidebar a {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
        }

        .sidebar a i {
            font-size: 18px;
        }

        /* Hover & Active State Menu */
        .sidebar a:hover {
            background: var(--bg-main);
            color: var(--primary-color);
        }

        .sidebar a.active {
            background: var(--primary-light);
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Content Area */
        .content {
            flex: 1;
            min-width: 0;
            background-color: var(--bg-main);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }

        /* Topbar Modern Styling (Glassmorphism) */
        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            padding: 16px 24px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            margin-bottom: 28px;
        }

        /* Card Modern Components */
        .card-modern {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .card-modern:hover {
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.2;
        }

        /* Footer Modern */
        footer {
            font-size: 13px;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        @include('layouts.sidebar')

        <div class="content p-4 lg-p-5">
            
            <div>
                @include('layouts.topbar')

                <main>
                    @yield('content')
                </main>
            </div>

            <footer class="mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div>
                    <span>&copy; {{ date('Y') }} <span style="color: var(--primary-color); font-weight: 600;">InternTest</span>. All rights reserved.</span>
                </div>
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none text-muted">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-muted">Terms of Service</a>
                </div>
            </footer>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    @stack('scripts')

</body>
</html>