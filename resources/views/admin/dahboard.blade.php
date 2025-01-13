@extends('admin.layout')
@section('judul', 'Home')
@section('content')
    <div class="container">
        <h3 class="text-center my-4">Welcome to the Admin Dashboard</h3>
        <p class="text-center">Manage your data efficiently from here.</p>

        <div class="row mt-4">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Obat</h5>
                        <p class="card-text">{{ $obat }}</p>
                        <a href="{{ route('dataobat') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Periode</h5>
                        <p class="card-text">{{ $periode }}</p>
                        <a href="{{ route('dataperiode') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Pegawai</h5>
                        <p class="card-text">{{ $pegawai }}</p>
                        <a href="{{ route('datapegawai') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Perhitungan</h5>
                        <p class="card-text">4</p>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
