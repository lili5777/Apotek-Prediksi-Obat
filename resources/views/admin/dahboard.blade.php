@extends('admin.layout')
@section('judul', 'Home')
@section('content')
    <div class="container">
        <h3 class="text-center my-4">Selamat Datang Di Apotek</h3>
        <p class="text-center text-muted">Kelola data Anda dengan mudah dan tepat</p>
    
        <!-- Info Cards -->
        <div class="row mt-5">
            <!-- Card 1: Data Obat -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon bg-primary text-white rounded-circle mx-auto mb-3"
                            style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-capsule fs-4"></i>
                        </div>
                        <h5 class="card-title">Data Obat</h5>
                        <p class="card-text fs-5 fw-bold text-primary">{{ $obat }}</p>
                        <a href="{{ route('dataobat') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 2: Data Periode -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon bg-success text-white rounded-circle mx-auto mb-3"
                            style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <h5 class="card-title">Data Periode</h5>
                        <p class="card-text fs-5 fw-bold text-success">{{ $periode }}</p>
                        <a href="{{ route('dataperiode') }}" class="btn btn-outline-success btn-sm">View Details</a>
                    </div>
                </div>
            </div>
    
            @if (Auth::user()->level == 'admin')
                <!-- Card 3: Data Pegawai -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon bg-danger text-white rounded-circle mx-auto mb-3"
                                style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <h5 class="card-title">Data Pegawai</h5>
                            <p class="card-text fs-5 fw-bold text-danger">{{ $pegawai }}</p>
                            <a href="{{ route('datapegawai') }}" class="btn btn-outline-danger btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
