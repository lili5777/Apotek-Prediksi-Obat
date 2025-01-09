<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(90deg, #ff512f, #dd2476);
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 10px;
            margin: 5px 0;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .content {
            padding: 20px;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-center">Admin Panel</h4>
            <hr style="border-color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('admin') }}">Home</a>
            <a href="{{ route('dataobat') }}">Data Obat</a>
            <a href="{{ route('dataperiode') }}">Data Periode</a>
            <a href="{{ route('datapegawai') }}">Data Pegawai</a>
            <a href="{{ route('perhitungan') }}">Perhitungan</a>
        </div>

        <!-- Content Area -->
        <div class="content flex-grow-1">
            <nav class="navbar navbar-light bg-white mb-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Dashboard</span>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
