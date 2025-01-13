@extends('admin.layout')
@section('judul', 'Data Periode')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Periode</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Tambah Periode</button>
        </div>
        {{-- <p>Below is the list of medicines available in the system.</p> --}}

        <table class="table table-striped table-bordered">
            <thead>
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
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMedicineModal"
                                data-id="{{ $p->id }}" data-periode="{{ $p->periode }}"
                                data-obat="{{ json_encode($jumlah[$p->id]->mapWithKeys(fn($item) => [$item->id_obat => $item->jumlah])->toArray()) }}">
                                Edit
                            </button>
                            <a href="{{ route('hapusperiode', $p->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Modal for adding medicine -->
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
                            <input type="month" class="form-control" id="kodeObat" placeholder="Masukkan Periode"
                                name="periode">
                        </div>
                        @foreach ($obat as $o)
                            <div class="mb-3">
                                <input type="hidden" value="{{ $o->id }}" name="id_obat[]"> <!-- Menjadi array -->
                                <label for="jumlah" class="form-label">{{ $o->nama }}</label>
                                <input type="number" class="form-control" id="jumlah{{ $o->nama }}"
                                    placeholder="Masukkan Jumlah Obat {{ $o->nama }}" name="jumlah[]">
                                <!-- Menjadi array -->
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


    {{-- // Edit Modal --}}
    <div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel"
        aria-hidden="true">
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
                                    name="jumlah[]" data-id="{{ $o->id }}"
                                    placeholder="Masukkan Jumlah Obat {{ $o->nama }}">
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
