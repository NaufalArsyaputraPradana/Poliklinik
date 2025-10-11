<x-layouts.app title="Pasien Dashboard - Poliklinik">
    @push('styles')
        <style>
            .welcome-card {
                background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
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

            .patient-info {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 10px;
                padding: 15px;
                margin-bottom: 15px;
            }
        </style>
    @endpush

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <i class="fas fa-user mr-2"></i>Dashboard Pasien
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
                                        <i class="fas fa-heartbeat mr-2"></i>
                                        Selamat Datang, {{ Auth::user()->nama }}!
                                    </h3>
                                    <div class="patient-info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-white-50">No. Rekam Medis</small>
                                                <div class="font-weight-bold">{{ Auth::user()->no_rm ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-white-50">No. KTP</small>
                                                <div class="font-weight-bold">{{ Auth::user()->no_ktp ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">
                                        Kelola jadwal pemeriksaan dan lihat riwayat kesehatan Anda dengan mudah.
                                    </p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="fas fa-user-injured fa-5x opacity-75"></i>
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
                            <h3>{{ \App\Models\DaftarPoli::where('id_pasien', Auth::id())->count() }}</h3>
                            <p>Riwayat Kunjungan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ \App\Models\DaftarPoli::where('id_pasien', Auth::id())->whereNull('id_periksa')->count() }}
                            </h3>
                            <p>Jadwal Mendatang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ \App\Models\Poli::count() }}</h3>
                            <p>Poli Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hospital"></i>
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
                                <i class="fas fa-clipboard-list mr-2"></i>Layanan Pasien
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-plus-circle text-primary mr-2"></i>Daftar Poli</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-calendar-check text-success mr-2"></i>Lihat Jadwal
                                        Dokter</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-file-medical text-info mr-2"></i>Riwayat Pemeriksaan</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-download text-warning mr-2"></i>Unduh Hasil</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card stats-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-2"></i>Status Kesehatan
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-stethoscope text-success mr-2"></i>Pemeriksaan Selesai</span>
                                    <span class="badge badge-success badge-pill">
                                        {{ \App\Models\DaftarPoli::where('id_pasien', Auth::id())->whereNotNull('id_periksa')->count() }}
                                    </span>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-clock text-warning mr-2"></i>Menunggu Pemeriksaan</span>
                                    <span class="badge badge-warning badge-pill">
                                        {{ \App\Models\DaftarPoli::where('id_pasien', Auth::id())->whereNull('id_periksa')->count() }}
                                    </span>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-pills text-danger mr-2"></i>Resep Obat</span>
                                    <span class="badge badge-danger badge-pill">
                                        {{ \App\Models\DetailPeriksa::whereHas('periksa.daftarPoli', function ($q) {$q->where('id_pasien', Auth::id());})->count() }}
                                    </span>
                                </div>
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span><i class="fas fa-hospital-alt text-info mr-2"></i>Poli Dikunjungi</span>
                                    <span class="badge badge-info badge-pill">
                                        {{ \App\Models\DaftarPoli::where('id_pasien', Auth::id())->distinct('id_jadwal')->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
