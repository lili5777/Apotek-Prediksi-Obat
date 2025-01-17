<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding-top: 20px;
        }

        .sidebar h4 {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.2rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 5px 0;
            transition: background-color 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .content {
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .navbar .btn-outline-danger {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-center">Apotek NR</h4>
            <hr style="border-color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('admin') }}" class="{{ Request::routeIs('admin') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Home
            </a>
            <a href="{{ route('dataobat') }}" class="{{ Request::routeIs('dataobat') ? 'active' : '' }}">
                <i class="bi bi-capsule"></i> Data Obat
            </a>
            <a href="{{ route('dataperiode') }}" class="{{ Request::routeIs('dataperiode') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> Data Periode
            </a>
            <a href="{{ route('datapegawai') }}" class="{{ Request::routeIs('datapegawai') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Data Pegawai
            </a>
            <a href="{{ route('perhitungan') }}" class="{{ Request::routeIs('perhitungan') ? 'active' : '' }}">
                <i class="bi bi-calculator"></i> Perhitungan
            </a>
        </div>

        <!-- Content Area -->
        <div class="flex-grow-1 p-4">
            <nav class="navbar navbar-light mb-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">@yield('judul')</span>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
                </div>
            </nav>

            <div class="content">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; {{ date('Y') }} Admin Panel. All Rights Reserved.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>