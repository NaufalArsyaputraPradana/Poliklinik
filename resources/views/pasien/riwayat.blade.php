<x-layouts.app title="Riwayat Kunjungan">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-4">Riwayat Kunjungan</h1>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Antrian</th>
                                        <th>Dokter</th>
                                        <th>Poli</th>
                                        <th>Jadwal</th>
                                        <th>Keluhan</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($daftars as $i => $daftar)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $daftar->no_antrian }}</td>
                                            <td>{{ $daftar->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                                            <td>{{ $daftar->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</td>
                                            <td>
                                                {{ $daftar->jadwalPeriksa->hari ?? '-' }}
                                                ({{ date('H:i', strtotime($daftar->jadwalPeriksa->jam_mulai ?? '00:00')) }}
                                                -
                                                {{ date('H:i', strtotime($daftar->jadwalPeriksa->jam_selesai ?? '00:00')) }})
                                            </td>
                                            <td>{{ $daftar->keluhan }}</td>
                                            <td>
                                                @if ($daftar->periksa)
                                                    <span class="badge badge-success">Sudah Periksa</span>
                                                @else
                                                    <span class="badge badge-warning">Belum Periksa</span>
                                                @endif
                                            </td>
                                            <td>{{ $daftar->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada riwayat kunjungan</td>
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
</x-layouts.app>
