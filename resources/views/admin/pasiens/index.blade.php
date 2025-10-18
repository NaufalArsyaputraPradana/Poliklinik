<x-layouts.app title="Manajemen Pasien">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Pasien</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Pasien</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.pasien.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Pasien
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>No RM</th>
                                            <th>Nama Pasien</th>
                                            <th>Alamat</th>
                                            <th>No KTP</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th style="width: 150px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pasiens as $index => $pasien)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $pasien->no_rm }}</span>
                                                </td>
                                                <td>{{ $pasien->nama }}</td>
                                                <td>{{ $pasien->alamat }}</td>
                                                <td>{{ $pasien->no_ktp }}</td>
                                                <td>{{ $pasien->no_hp }}</td>
                                                <td>{{ $pasien->email }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.pasien.edit', $pasien) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.pasien.destroy', $pasien) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data pasien</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
