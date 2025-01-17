@extends('admin.layout')
@section('judul', 'Hasil Prediksi')
@section('content')

<div class="card shadow p-4">
    <h2 class="text-center mb-4">Hasil Prediksi</h2>

    <!-- Bagian Trend -->
    <div class="mb-4">
        <h4>Trend Parameters</h4>
        <ul>
            <li><strong>Slope (m):</strong> {{ number_format($trend['m'], 0) }}</li>
            <li><strong>Intercept (b):</strong> {{ number_format($trend['b'], 0) }}</li>
        </ul>
    </div>

    <!-- Bagian Seasonal -->
    <div class="mb-4">
        <h4>Seasonal Values</h4>
        <ul>
            @foreach ($seasonal as $index => $value)
                <li><strong>Bulan {{ $index + 1 }}:</strong> {{ number_format($value, 0) }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Bagian Prediksi -->
    <div class="alert alert-info text-center">
        <h4>Prediksi Bulan Berikutnya</h4>
        <p>
            <strong>Stok Keluar:</strong> 
            @if ($prediction > 0)
                {{ number_format($prediction, 0) }}
            @else
            0
            @endif
            
        </p>
    </div>
</div>

@endsection