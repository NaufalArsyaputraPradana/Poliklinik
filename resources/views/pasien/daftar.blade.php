<x-layouts.app title="Daftar Poli">
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

                <h1 class="mb-4">Daftar Poli</h1>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Form Pendaftaran Poli</h5>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Terjadi Kesalahan!</strong>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('pasien.daftar-poli.submit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_pasien" value="{{ $pasien->id }}">

                                    <div class="mb-3">
                                        <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                                        <input type="text" class="form-control" id="no_rm"
                                            value="{{ $pasien->no_rm }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" id="nama_pasien"
                                            value="{{ $pasien->nama }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="selectPoli" class="form-label">Pilih Poli</label>
                                        <select name="id_poli" id="selectPoli" class="form-control">
                                            <option value="">-- Pilih Poli --</option>
                                            @foreach ($polis as $poli)
                                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="selectJadwal" class="form-label">Pilih Jadwal Periksa <span
                                                class="text-danger">*</span></label>
                                        <select name="id_jadwal" id="selectJadwal"
                                            class="form-control @error('id_jadwal') is-invalid @enderror" required>
                                            <option value="">-- Pilih Jadwal --</option>
                                            @foreach ($jadwals as $jadwal)
                                                <option value="{{ $jadwal->id }}"
                                                    data-id-poli="{{ $jadwal->dokter->poli->id ?? '' }}">
                                                    {{ $jadwal->dokter->poli->nama_poli ?? '' }} -
                                                    {{ $jadwal->hari }},
                                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                                    {{ date('H:i', strtotime($jadwal->jam_selesai)) }} -
                                                    Dr. {{ $jadwal->dokter->nama ?? '--' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_jadwal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="keluhan" class="form-label">Keluhan <span
                                                class="text-danger">*</span></label>
                                        <textarea name="keluhan" id="keluhan" rows="4" class="form-control @error('keluhan') is-invalid @enderror"
                                            placeholder="Jelaskan keluhan Anda..." required>{{ old('keluhan') }}</textarea>
                                        @error('keluhan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i> Daftar Poli
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Informasi</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle"></i> Petunjuk Pendaftaran:</h6>
                                    <ol class="mb-0">
                                        <li>Pilih poli yang sesuai dengan keluhan Anda</li>
                                        <li>Pilih jadwal periksa dokter yang tersedia</li>
                                        <li>Tuliskan keluhan Anda dengan jelas</li>
                                        <li>Klik tombol "Daftar Poli" untuk menyelesaikan pendaftaran</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectPoli = document.getElementById('selectPoli');
                const selectJadwal = document.getElementById('selectJadwal');

                // Filter jadwal berdasarkan poli yang dipilih
                selectPoli.addEventListener('change', function() {
                    const poliId = this.value;
                    Array.from(selectJadwal.options).forEach(option => {
                        if (option.value === "") return;

                        if (!poliId) {
                            option.style.display = '';
                        } else {
                            option.style.display = option.dataset.idPoli == poliId ? '' : 'none';
                        }
                    });
                    selectJadwal.value = "";
                });

                // Auto-select poli ketika jadwal dipilih
                selectJadwal.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const poliId = selected.dataset.idPoli;
                    if (!selectPoli.value && poliId) {
                        selectPoli.value = poliId;
                        selectPoli.dispatchEvent(new Event('change'));
                    }
                });

                // Auto-hide alerts
                setTimeout(() => {
                    const alert = document.querySelector('.alert');
                    if (alert && alert.classList.contains('alert-success')) {
                        alert.classList.remove('show');
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            });
        </script>
    @endpush
</x-layouts.app>
