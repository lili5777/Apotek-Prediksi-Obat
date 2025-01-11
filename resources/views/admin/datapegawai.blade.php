@extends('admin.layout')
@section('judul', 'Data Pegawai')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Pegawai</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Tambah Pegawai</button>
        </div>
        {{-- <p>Below is the list of medicines available in the system.</p> --}}

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $no => $u)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->level }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMedicineModal"
                                data-id="{{ $u->id }}" data-nama="{{ $u->name }}"
                                data-email="{{ $u->email }}" data-role="{{ $u->level }}">Edit</button>
                            <a href="{{ route('hapuspegawai', $u->id) }}" class="btn btn-sm btn-danger">Hapus</a>
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
                    <h5 class="modal-title" id="addMedicineModalLabel">Tambah Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('postpegawai') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama"
                                name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Masukkan Email"
                                name="email">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan username"
                                name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password"
                                name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="level">
                                <option value="admin">admin</option>
                                <option value="user">user</option>
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


    <!-- Modal for editing medicine -->
    <div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMedicineModalLabel">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('postpegawai') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" id="editid" name="id" hidden>
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control" id="editNama" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" name="level">
                                <option value="admin">admin</option>
                                <option value="user">user</option>
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
                const email = button.getAttribute('data-email');
                const nama = button.getAttribute('data-nama');
                const role = button.getAttribute('data-role');

                document.getElementById('editid').value = id;
                document.getElementById('editEmail').value = email;
                document.getElementById('editNama').value = nama;
                document.getElementById('editRole').value = role;
            });
        });
    </script>
@endsection
