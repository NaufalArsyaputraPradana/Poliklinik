<x-layouts.app title="Manajemen Poli">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Poli</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Poli</li>
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
                            <h3 class="card-title">Daftar Poli</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.polis.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Poli
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Poli</th>
                                            <th>Keterangan</th>
                                            <th style="width: 150px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($polis as $index => $poli)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $poli->nama_poli }}</td>
                                                <td>{{ $poli->keterangan ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.polis.edit', $poli) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.polis.destroy', $poli) }}"
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
                                                <td colspan="4" class="text-center">Tidak ada data poli</td>
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
