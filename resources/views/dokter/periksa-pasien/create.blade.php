<x-layouts.app title="Periksa Pasien">
    <div class="container-fluid px-4 mt-4">
        <h1 class="mb-4">Form Pemeriksaan Pasien</h1>

        <div class="row">
            <!-- KIRI: Informasi Pasien -->
            <div class="col-md-3">
                @if (isset($daftar) && $daftar)
                    <!-- CARD 1: Data Identitas -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Data Identitas Pasien</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $daftar->pasien->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. RM</th>
                                    <td>{{ $daftar->pasien->no_rm ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>{{ $daftar->pasien->no_hp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Antrian</th>
                                    <td><span class="badge badge-primary">{{ $daftar->no_antrian ?? '-' }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- CARD 2: Keluhan Pasien -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Keluhan Pasien</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $daftar->keluhan ?? 'Tidak ada keluhan' }}</p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> Data pasien tidak ditemukan!
                    </div>
                @endif
            </div>

            <!-- KANAN: Form Resep Obat -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Form Resep Obat & Pemeriksaan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dokter.periksa-pasien.store') }}" method="POST" id="form-periksa">
                            @csrf
                            <input type="hidden" name="id_daftar_poli" value="{{ $daftar->id ?? $id }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Obat</label>
                                        <select id="select-obat" class="form-control">
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}"
                                                    data-harga="{{ $obat->harga }}" data-stok="{{ $obat->stok }}"
                                                    {{ $obat->stok <= 0 ? 'disabled' : '' }}>
                                                    {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga) }}
                                                    (Stok: {{ $obat->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" id="jumlah-obat" class="form-control" min="1"
                                            value="1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="button" id="btn-tambah-obat" class="btn btn-primary btn-block">
                                            <i class="fas fa-plus"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Obat Terpilih</label>
                                <ul id="obat-terpilih" class="list-group mb-3"></ul>
                                <input type="hidden" name="biaya_periksa" id="biaya_periksa" value="0">
                                <input type="hidden" name="obat_json" id="obat_json">
                            </div>

                            <div class="form-group">
                                <label>Catatan Pemeriksaan</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="4" required>{{ old('catatan') }}</textarea>
                            </div>

                            <div class="form-group">
                                <div id="total-harga"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Pemeriksaan
                                </button>
                                <a href="{{ route('dokter.periksa-pasien.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const selectObat = document.getElementById('select-obat');
            const jumlahObat = document.getElementById('jumlah-obat');
            const btnTambahObat = document.getElementById('btn-tambah-obat');
            const listObat = document.getElementById('obat-terpilih');
            const inputBiaya = document.getElementById('biaya_periksa');
            const inputObatJson = document.getElementById('obat_json');
            const totalHargaEl = document.getElementById('total-harga');

            let daftarObat = [];

            // Event untuk tombol tambah obat
            btnTambahObat.addEventListener('click', () => {
                const selectedOption = selectObat.options[selectObat.selectedIndex];
                const id = selectedOption.value;
                const nama = selectedOption.dataset.nama;
                const harga = parseInt(selectedOption.dataset.harga || 0);
                const stok = parseInt(selectedOption.dataset.stok || 0);
                const jumlah = parseInt(jumlahObat.value || 1);

                // Validasi
                if (!id) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Silakan pilih obat terlebih dahulu!',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                if (jumlah <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Jumlah harus lebih dari 0!',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                if (jumlah > stok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Tidak Mencukupi!',
                        html: `
                            <div class="text-left">
                                <p><strong>Obat:</strong> ${nama}</p>
                                <p><strong>Jumlah diminta:</strong> <span class="text-danger">${jumlah} unit</span></p>
                                <p><strong>Stok tersedia:</strong> <span class="text-success">${stok} unit</span></p>
                            </div>
                        `,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK, Mengerti'
                    });
                    return;
                }

                // Cek apakah obat sudah ada di daftar
                const existingIndex = daftarObat.findIndex(o => o.id == id);
                if (existingIndex >= 0) {
                    const totalJumlahBaru = daftarObat[existingIndex].jumlah + jumlah;

                    if (totalJumlahBaru > stok) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Stok Tidak Mencukupi!',
                            html: `
                                <div class="text-left">
                                    <p><strong>Obat:</strong> ${nama}</p>
                                    <p><strong>Jumlah di keranjang:</strong> ${daftarObat[existingIndex].jumlah} unit</p>
                                    <p><strong>Jumlah akan ditambah:</strong> ${jumlah} unit</p>
                                    <p><strong>Total jumlah:</strong> <span class="text-danger">${totalJumlahBaru} unit</span></p>
                                    <p><strong>Stok tersedia:</strong> <span class="text-success">${stok} unit</span></p>
                                    <hr>
                                    <p class="text-danger mb-0"><i class="fas fa-exclamation-triangle"></i> Stok tidak cukup untuk jumlah tersebut!</p>
                                </div>
                            `,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK, Mengerti'
                        });
                        return;
                    }

                    daftarObat[existingIndex].jumlah = totalJumlahBaru;
                } else {
                    daftarObat.push({
                        id,
                        nama,
                        harga,
                        stok,
                        jumlah
                    });
                }

                renderObat();
                selectObat.selectedIndex = 0;
                jumlahObat.value = 1;
            });

            function renderObat() {
                listObat.innerHTML = '';
                let total = 0;

                daftarObat.forEach((obat, index) => {
                    const subtotal = obat.harga * obat.jumlah;
                    total += subtotal;

                    const item = document.createElement('li');
                    item.className = 'list-group-item d-flex justify-content-between align-items-center';
                    item.innerHTML = `
                    <div>
                        <strong>${obat.nama}</strong><br>
                        <small class="text-muted">
                            ${obat.jumlah} x Rp ${obat.harga.toLocaleString('id-ID')} = 
                            <strong>Rp ${subtotal.toLocaleString('id-ID')}</strong>
                        </small>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusObat(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                    listObat.appendChild(item);
                });

                // Update total
                const biayaJasaDokter = 150000; // Biaya jasa dokter tetap
                const totalBiaya = biayaJasaDokter + total;

                inputBiaya.value = totalBiaya;
                totalHargaEl.innerHTML = `
                    <div class="alert alert-info">
                        <div>Biaya Jasa Dokter: <strong>Rp ${biayaJasaDokter.toLocaleString('id-ID')}</strong></div>
                        <div>Biaya Obat: <strong>Rp ${total.toLocaleString('id-ID')}</strong></div>
                        <hr class="my-2">
                        <div class="fs-5">Total Biaya: <strong>Rp ${totalBiaya.toLocaleString('id-ID')}</strong></div>
                    </div>
                `;

                // Update JSON untuk dikirim ke controller (format: [{id: 1, jumlah: 2}, ...])
                inputObatJson.value = JSON.stringify(daftarObat.map(o => ({
                    id: o.id,
                    jumlah: o.jumlah
                })));
            }

            function hapusObat(index) {
                const obat = daftarObat[index];

                Swal.fire({
                    title: 'Hapus Obat?',
                    html: `Apakah Anda yakin ingin menghapus <strong>${obat.nama}</strong> dari daftar?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        daftarObat.splice(index, 1);
                        renderObat();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Obat berhasil dihapus dari daftar',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            }

            // Initial render (kosong)
            renderObat();

            // ========================================
            // KONFIRMASI SUBMIT FORM
            // ========================================
            document.getElementById('form-periksa').addEventListener('submit', function(e) {
                e.preventDefault();

                const catatan = document.getElementById('catatan').value.trim();
                const totalBiaya = document.getElementById('biaya_periksa').value;
                const jumlahObat = daftarObat.length;

                // Validasi catatan
                if (!catatan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Catatan pemeriksaan wajib diisi!',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                // Konfirmasi submit
                Swal.fire({
                    title: 'Konfirmasi Pemeriksaan',
                    html: `
                        <div class="text-left">
                            <p><strong>Pasien:</strong> {{ $daftar->pasien->nama ?? '-' }}</p>
                            <p><strong>Jumlah obat diresepkan:</strong> ${jumlahObat} item</p>
                            <p><strong>Total biaya:</strong> <span class="text-primary">Rp ${parseInt(totalBiaya).toLocaleString('id-ID')}</span></p>
                            <hr>
                            <p class="mb-0"><i class="fas fa-info-circle"></i> Apakah Anda yakin ingin menyimpan pemeriksaan ini?</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-check"></i> Ya, Simpan!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menyimpan...',
                            html: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit form
                        e.target.submit();
                    }
                });
            });
        </script>
    @endpush
</x-layouts.app>
