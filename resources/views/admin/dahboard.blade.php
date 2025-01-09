@extends('admin.layout')
@section('judul', 'Home')
@section('content')
    <div class="container">
        <h3>Welcome to the Admin Dashboard</h3>
        <p>Manage your data efficiently from here.</p>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Obat</h5>
                        <p class="card-text">1.</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Periode</h5>
                        <p class="card-text">2</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Pegawai</h5>
                        <p class="card-text">3</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Perhitungan</h5>
                        <p class="card-text">4</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
