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
                        <td>a</td>
                        <td>0</td>
                        @foreach ($obat as $o)
                            <td>{{ $o->id }}</td>
                        @endforeach
                        <td>s</td>
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
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kodeObat" class="form-label">Periode</label>
                            <input type="month" class="form-control" id="kodeObat" placeholder="Masukkan Periode"
                                name="periode">
                        </div>
                        @foreach ($obat as $o)
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">{{ $o->nama }}</label>
                                <input type="number" class="form-control" id="jumlah" placeholder="Masukkan Jumlah Obat"
                                    name="jumlah">
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


    <!-- Modal for editing medicine -->
    <div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMedicineModalLabel">Edit Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" id="editid" name="id" hidden>
                        <div class="mb-3">
                            <label for="editKodeObat" class="form-label">Kode Obat</label>
                            <input type="text" class="form-control" id="editKodeObat" name="kode">
                        </div>
                        <div class="mb-3">
                            <label for="editNamaObat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="editNamaObat" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="editKategori" class="form-label">Kategori</label>
                            <select class="form-select" id="editKategori" name="kategori">
                                <option value="Obat Keras">Obat Keras</option>
                                <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                <option value="Obat Bebas">Obat Bebas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editSatuan" class="form-label">Satuan</label>
                            <select class="form-select" id="editSatuan" name="satuan">
                                <option value="Strip">Strip</option>
                                <option value="Botol">Botol</option>
                                <option value="Sachet">Sachet</option>
                                <option value="Tube">Tube</option>
                            </select>
                        </div>

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
        // Example of populating the Edit Modal with data
        const editButtons = document.querySelectorAll('[data-bs-target="#editMedicineModal"]');
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const kode = button.getAttribute('data-kode');
                const nama = button.getAttribute('data-nama');
                const kategori = button.getAttribute('data-kategori');
                const satuan = button.getAttribute('data-satuan');

                document.getElementById('editid').value = id;
                document.getElementById('editKodeObat').value = kode;
                document.getElementById('editNamaObat').value = nama;
                document.getElementById('editKategori').value = kategori;
                document.getElementById('editSatuan').value = satuan;
            });
        });
    </script>
@endsection
