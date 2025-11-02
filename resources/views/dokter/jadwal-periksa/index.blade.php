<x-layouts.app title="Jadwal Periksa - Dokter">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">
                {{-- Alert flash message --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h1 class="mb-4">Jadwal Periksa</h1>

                <a href="{{ route('dokter.jadwal-periksa.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Tambah Jadwal Periksa
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalPeriksas as $index => $jadwalPeriksa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jadwalPeriksa->hari }}</td>
                                    <td>{{ date('H:i', strtotime($jadwalPeriksa->jam_mulai)) }}</td>
                                    <td>{{ date('H:i', strtotime($jadwalPeriksa->jam_selesai)) }}</td>
                                    <td>
                                        @if ($jadwalPeriksa->aktif == 'Y')
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dokter.jadwal-periksa.edit', $jadwalPeriksa) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwalPeriksa) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus jadwal periksa ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">
                                        Belum ada jadwal periksa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-hide alerts after 3 seconds
            setTimeout(() => {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endpush
</x-layouts.app>
