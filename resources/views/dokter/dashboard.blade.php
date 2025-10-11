<x-layouts.app title="Dokter Dashboard - Poliklinik">
    @push('styles')
        <style>
            .welcome-card {
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: white;
                border-radius: 15px;
                border: none;
                margin-bottom: 20px;
            }

            .stats-card {
                border-radius: 15px;
                border: none;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .stats-card:hover {
                transform: translateY(-5px);
            }

            .small-box {
                border-radius: 15px;
                position: relative;
                overflow: hidden;
            }

            .small-box .icon {
                transition: all 0.3s ease;
            }

            .small-box:hover .icon {
                transform: scale(1.1);
            }

            .content-header h1 {
                color: #495057;
                font-weight: 600;
            }

            .breadcrumb {
                background: transparent;
            }

            .card {
                border-radius: 15px;
                border: none;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }

            .card-header {
                background: #f8f9fa;
                border-bottom: 1px solid #dee2e6;
                border-radius: 15px 15px 0 0 !important;
            }
        </style>
    @endpush

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <i class="fas fa-user-md mr-2"></i>Dashboard Dokter
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <i class="fas fa-home mr-1"></i>Dashboard
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Welcome Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card welcome-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="mb-3">
                                        <i class="fas fa-stethoscope mr-2"></i>
                                        Selamat Datang, Dr. {{ Auth::user()->nama }}!
                                    </h3>
                                    <p class="mb-0">
                                        Anda login sebagai <strong>Dokter</strong>.
                                        Kelola jadwal praktik dan riwayat pemeriksaan pasien Anda.
                                    </p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="fas fa-user-md fa-5x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ \App\Models\JadwalPeriksa::where('id_dokter', Auth::id())->count() }}</h3>
                            <p>Jadwal Periksa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ \App\Models\DaftarPoli::whereHas('jadwalPeriksa', function ($q) {$q->where('id_dokter', Auth::id());})->whereDate('created_at', today())->count() }}
                            </h3>
                            <p>Pasien Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ \App\Models\Periksa::whereHas('daftarPoli.jadwalPeriksa', function ($q) {$q->where('id_dokter', Auth::id());})->count() }}
                            </h3>
                            <p>Total Riwayat Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Management Cards -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card stats-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-alt mr-2"></i>Jadwal Praktik
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-clock text-info mr-2"></i>Jadwal Aktif</span>
                                    <span class="badge badge-info badge-pill">
                                        {{ \App\Models\JadwalPeriksa::where('id_dokter', Auth::id())->where('aktif', 'Y')->count() }}
                                    </span>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-calendar-times text-warning mr-2"></i>Jadwal Non-Aktif</span>
                                    <span class="badge badge-warning badge-pill">
                                        {{ \App\Models\JadwalPeriksa::where('id_dokter', Auth::id())->where('aktif', 'T')->count() }}
                                    </span>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-users text-success mr-2"></i>Pasien Menunggu</span>
                                    <span class="badge badge-success badge-pill">
                                        {{ \App\Models\DaftarPoli::whereHas('jadwalPeriksa', function ($q) {$q->where('id_dokter', Auth::id());})->whereNull('id_periksa')->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card stats-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-tasks mr-2"></i>Aktivitas Dokter
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-stethoscope text-primary mr-2"></i>Mengatur Jadwal</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-clipboard-check text-success mr-2"></i>Periksa Pasien</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-history text-info mr-2"></i>Riwayat Pemeriksaan</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-prescription-bottle-alt text-danger mr-2"></i>Kelola
                                        Resep</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
