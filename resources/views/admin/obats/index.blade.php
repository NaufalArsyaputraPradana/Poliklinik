<x-layouts.app title="Data Obat">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- Flash messages will be handled by SweetAlert2 in the layout --}}

                <h1 class="mb-4">Data Obat</h1>

                <a href="{{ route('admin.obat.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Tambah Obat
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Kemasan</th>
                                <th>Stok</th>
                                <th>Status Stok</th>
                                <th>Harga</th>
                                <th style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                                <tr
                                    class="{{ $obat->isStokHabis() ? 'table-danger' : ($obat->isStokMenipis() ? 'table-warning' : '') }}">
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->kemasan }}</td>
                                    <td>
                                        <strong>{{ $obat->stok }}</strong> unit
                                        <br>
                                        <small class="text-muted">Min: {{ $obat->stok_minimum }} unit</small>
                                    </td>
                                    <td>
                                        <span class="{{ $obat->getStokBadgeClass() }}">
                                            @if ($obat->isStokHabis())
                                                <i class="fas fa-times-circle"></i> Stok Habis
                                            @elseif($obat->isStokMenipis())
                                                <i class="fas fa-exclamation-triangle"></i> Stok Menipis
                                            @else
                                                <i class="fas fa-check-circle"></i> Stok Aman
                                            @endif
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.obat.edit', $obat->id) }}"
                                            class="btn btn-sm btn-warning" title="Edit Obat">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirmDelete('{{ route('admin.obat.destroy', $obat->id) }}', 'Obat {{ $obat->nama_obat }}')"
                                            title="Hapus Obat">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">
                                        Belum ada data obat
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
