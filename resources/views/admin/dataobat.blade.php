@extends('admin.layout')
@section('judul', 'Data Obat')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Obat</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Tambah Obat</button>
        </div>
        {{-- <p>Below is the list of medicines available in the system.</p> --}}

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>OB002</td>
                    <td>Amoxicillin</td>
                    <td>Antibiotik</td>
                    <td>Kapsul</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMedicineModal"
                            data-id="2" data-kode="OB002" data-nama="Amoxicillin" data-kategori="Obat Keras"
                            data-satuan="Botol">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- Modal for adding medicine -->
    <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMedicineModalLabel">Tambah Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="kodeObat" class="form-label">Kode Obat</label>
                            <input type="text" class="form-control" id="kodeObat" placeholder="Masukkan Kode Obat">
                        </div>
                        <div class="mb-3">
                            <label for="namaObat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="namaObat" placeholder="Masukkan Nama Obat">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori">
                                <option value="Obat Keras">Obat Keras</option>
                                <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                <option value="Obat Bebas">Obat Bebas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" id="satuan">
                                <option value="Strip">Strip</option>
                                <option value="Botol">Botol</option>
                                <option value="Sachet">Sachet</option>
                                <option value="Tube">Tube</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
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
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editKodeObat" class="form-label">Kode Obat</label>
                            <input type="text" class="form-control" id="editKodeObat" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="editNamaObat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="editNamaObat">
                        </div>
                        <div class="mb-3">
                            <label for="editKategori" class="form-label">Kategori</label>
                            <select class="form-select" id="editKategori">
                                <option value="Obat Keras">Obat Keras</option>
                                <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                <option value="Obat Bebas">Obat Bebas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editSatuan" class="form-label">Satuan</label>
                            <select class="form-select" id="editSatuan">
                                <option value="Strip">Strip</option>
                                <option value="Botol">Botol</option>
                                <option value="Sachet">Sachet</option>
                                <option value="Tube">Tube</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
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

                document.getElementById('editKodeObat').value = kode;
                document.getElementById('editNamaObat').value = nama;
                document.getElementById('editKategori').value = kategori;
                document.getElementById('editSatuan').value = satuan;
            });
        });
    </script>
@endsection
