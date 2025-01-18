@extends('admin.layout')
@section('judul', 'Data Periode')
@section('content')
    <div class="container">
        <!-- Header Section -->
       <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">Data Periode</h3>
            <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Periode
            </button>
        </div>

        <!-- Error Message Section -->
        @error('periode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        @error('jumlah.*')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <!-- Table Section with improved scrolling -->
        <div class="card shadow-sm">
            <div class="card-body">
                <style>
                    .custom-table-responsive {
                        width: 100%;
                        overflow-x: auto;
                        -webkit-overflow-scrolling: touch;
                    }
                    .custom-table {
                        margin-bottom: 0;
                        min-width: 100%;
                    }
                    /* Ensure table doesn't get too compressed */
                    .custom-table th,
                    .custom-table td {
                        min-width: 100px; /* Minimum width for data columns */
                    }
                    .custom-table th:first-child,
                    .custom-table td:first-child {
                        min-width: 60px; /* Width for No column */
                    }
                    .custom-table th:nth-child(2),
                    .custom-table td:nth-child(2) {
                        min-width: 120px; /* Width for Period column */
                    }
                    .custom-table th:last-child,
                    .custom-table td:last-child {
                        min-width: 180px; /* Width for Action column */
                    }
                </style>
                
                <div class="custom-table-responsive">
                    <table class="table table-striped table-hover align-middle text-center custom-table">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Periode</th>
                                @foreach ($obat as $o)
                                    <th>{{ $o->nama }}</th>
                                @endforeach
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode as $i => $p)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->periode)->format('F Y') }}</td>
                                    @foreach ($obat as $o)
                                        @php
                                            $jumlah_obat = $jumlah[$p->id]->where('id_obat', $o->id)->first()->jumlah ?? 0;
                                        @endphp
                                        <td>{{ $jumlah_obat }}</td>
                                    @endforeach
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editMedicineModal"
                                            data-id="{{ $p->id }}" data-periode="{{ $p->periode }}"
                                            data-obat="{{ json_encode($jumlah[$p->id]->mapWithKeys(fn($item) => [$item->id_obat => $item->jumlah])->toArray()) }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <a href="{{ route('hapusperiode', $p->id) }}" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <!-- Modal for adding period -->
    <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMedicineModalLabel">Tambah Periode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('postperiode') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kodeObat" class="form-label">Periode</label>
                            <input type="month" class="form-control" id="kodeObat" placeholder="Masukkan Periode" name="periode">
                        </div>
                        @foreach ($obat as $o)
                            <div class="mb-3">
                                <input type="hidden" value="{{ $o->id }}" name="id_obat[]">
                                <label for="jumlah" class="form-label">{{ $o->nama }}</label>
                                <input type="number" class="form-control" id="jumlah{{ $o->nama }}"
                                    placeholder="Masukkan Jumlah Obat {{ $o->nama }}" name="jumlah[]">
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMedicineModalLabel">Edit Periode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('postperiode') }}" method="POST">
                    @csrf
                    <input hidden id="editid" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editPeriode" class="form-label">Periode</label>
                            <input type="month" class="form-control" id="editPeriode" name="periode">
                        </div>
                        @foreach ($obat as $o)
                            <div class="mb-3">
                                <input type="hidden" value="{{ $o->id }}" name="id_obat[]">
                                <label for="jumlahEdit{{ $o->id }}" class="form-label">{{ $o->nama }}</label>
                                <input type="number" class="form-control jumlah-obat" id="jumlahEdit{{ $o->id }}"
                                    name="jumlah[]" data-id="{{ $o->id }}" placeholder="Masukkan Jumlah Obat {{ $o->nama }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Populate the Edit Modal with data
        const editButtons = document.querySelectorAll('[data-bs-target="#editMedicineModal"]');
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const periode = button.getAttribute('data-periode');
                const formattedPeriode = periode.substring(0, 7)
                const obatData = JSON.parse(button.getAttribute('data-obat'));

                document.getElementById('editid').value = id;
                document.getElementById('editPeriode').value = formattedPeriode;

                const jumlahInputs = document.querySelectorAll('#editMedicineModal .jumlah-obat');
                jumlahInputs.forEach(input => {
                    const obatId = input.getAttribute('data-id');
                    input.value = obatData[obatId] || 0;
                });
            });
        });
    </script>
@endsection
