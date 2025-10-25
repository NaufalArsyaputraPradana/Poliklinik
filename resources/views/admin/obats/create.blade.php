<x-layouts.app title="Tambah Obat">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="mb-4">Tambah Obat</h1>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.obat.store') }}" method="POST" id="obatForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_obat" class="form-label">Nama Obat <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat"
                                            name="nama_obat" value="{{ old('nama_obat') }}" required>
                                        @error('nama_obat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="kemasan" class="form-label">Kemasan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="kemasan" name="kemasan"
                                            class="form-control @error('kemasan') is-invalid @enderror"
                                            value="{{ old('kemasan') }}" placeholder="Contoh: Strip, Botol, Tube"
                                            required>
                                        @error('kemasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga" class="form-label">Harga <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="harga" name="harga"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ old('harga') }}" min="0" step="1" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button type="button" class="btn btn-success"
                                    onclick="confirmSubmit('#obatForm', 'Apakah Anda yakin ingin menambahkan obat ini?')">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
