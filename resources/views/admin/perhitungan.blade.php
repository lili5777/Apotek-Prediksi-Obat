@extends('admin.layout')
@section('judul', 'Perhitungan')
@section('content')
    <div class="container">
        <h3>Perhitungan Obat</h3>
        <p>Silakan masukkan data berikut untuk melakukan perhitungan.</p>

        <form action="" method="POST">
            @csrf
            <!-- Select Obat -->
            <div class="mb-3">
                <label for="obat" class="form-label">Pilih Obat</label>
                <select class="form-select" id="obat" name="obat" required>
                    <option value="" selected disabled>-- Pilih Obat --</option>
                    @foreach ($obat as $o)
                        <option value="{{ $o->id }}">{{ $o->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input Bulan dan Tahun Mulai -->
            <div class="mb-3">
                <label for="mulai" class="form-label">Bulan dan Tahun Mulai</label>
                <input type="month" class="form-control" id="mulai" name="mulai" required>
            </div>

            <!-- Input Bulan dan Tahun Selesai -->
            <div class="mb-3">
                <label for="selesai" class="form-label">Bulan dan Tahun Selesai</label>
                <input type="month" class="form-control" id="selesai" name="selesai" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Pediksi</button>
        </form>
    </div>
@endsection
