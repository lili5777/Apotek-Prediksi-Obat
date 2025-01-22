@extends('admin.layout')
@section('judul', 'Perhitungan')
@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-primary mb-3">Perhitungan Obat</h3>
    <p class="text-muted mb-4">Silakan masukkan data berikut untuk melakukan perhitungan.</p>

    <form action="{{ route('postperhitungan') }}" method="POST" class="shadow-sm p-4 rounded-3 bg-light">
        @csrf
        <!-- Select Obat -->
        <div class="mb-4">
            <label for="obat" class="form-label">Pilih Obat</label>
            <select class="form-select" id="obat" name="obat" required>
                <option value="" selected disabled>-- Pilih Obat --</option>
                @foreach ($obat as $o)
                    <option value="{{ $o->id }}">{{ $o->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input Bulan dan Tahun Mulai -->
        <div class="mb-4">
            <label for="mulai" class="form-label">Bulan dan Tahun Mulai</label>
            <input type="month" class="form-control" id="mulai" name="mulai" required>
            @error('mulai')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Bulan dan Tahun Selesai -->
        <div class="mb-4">
            <label for="selesai" class="form-label">Bulan dan Tahun Selesai</label>
            <input type="month" class="form-control" id="selesai" name="selesai" required>
            @error('selesai')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2">Prediksi</button>
        </div>
    </form>
</div>
@endsection