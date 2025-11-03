<x-layouts.auth title="Daftar Akun">
    @push('styles')
        <style>
            .register-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 0;
            }

            .register-card {
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
                border: none;
                background: white;
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .register-image-side {
                background: linear-gradient(135deg, #36b9cc 0%, #1cc88a 100%);
                min-height: 700px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .register-image-side::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('{{ asset('template-admin/img/undraw_medical_care_movn.svg') }}');
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
                opacity: 0.1;
            }

            .register-image-content {
                position: relative;
                z-index: 2;
                padding: 2rem;
            }

            .register-form-side {
                padding: 2rem 1.5rem;
                min-height: 700px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .brand-logo {
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .brand-title {
                font-size: 2rem;
                font-weight: 800;
                color: #5a5c69;
                margin-bottom: 0.5rem;
            }

            .brand-subtitle {
                color: #858796;
                font-size: 0.9rem;
                margin-bottom: 0;
            }

            .welcome-text {
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .welcome-title {
                color: #5a5c69;
                font-size: 1.3rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .welcome-subtitle {
                color: #858796;
                font-size: 0.9rem;
            }

            .form-control-user {
                border-radius: 10rem;
                padding: 1rem 1rem;
                border: 1px solid #d1d3e2;
                font-size: 0.85rem;
                color: #6e707e;
            }

            .form-control-user:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            }

            .btn-user {
                border-radius: 10rem;
                padding: 1rem 2rem;
                font-weight: 600;
                font-size: 0.9rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                color: white;
                transition: all 0.3s ease;
            }

            .btn-user:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
                color: white;
            }

            .divider {
                margin: 1.5rem 0;
                text-align: center;
                position: relative;
            }

            .divider::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: #e3e6f0;
            }

            .divider span {
                background: white;
                padding: 0 1rem;
                color: #858796;
                font-size: 0.8rem;
            }

            .link-login {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
            }

            .link-login:hover {
                color: #764ba2;
                text-decoration: none;
            }

            .floating-icon {
                font-size: 4rem;
                margin-bottom: 1rem;
                opacity: 0.9;
            }

            .form-row .col-sm-6 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .info-text {
                background: linear-gradient(135deg, #f8f9fc 0%, #e2e5e9 100%);
                border-radius: 0.75rem;
                padding: 0.8rem;
                margin-bottom: 1.2rem;
                border: 1px solid #e3e6f0;
                font-size: 0.8rem;
                color: #5a5c69;
            }

            .info-text i {
                color: #667eea;
                margin-right: 0.5rem;
            }

            @media (max-width: 991.98px) {
                .register-container {
                    padding: 1rem 0;
                }

                .register-form-side {
                    padding: 1.5rem 1.2rem;
                    min-height: auto;
                }

                .form-row .col-sm-6 {
                    padding-left: 0.5rem;
                    padding-right: 0.5rem;
                }

                .brand-title {
                    font-size: 1.8rem;
                }

                .welcome-title {
                    font-size: 1.2rem;
                }
            }

            @media (max-width: 575.98px) {
                .register-form-side {
                    padding: 1rem 0.8rem;
                }

                .brand-title {
                    font-size: 1.6rem;
                }

                .welcome-title {
                    font-size: 1.1rem;
                }

                .form-row .col-sm-6 {
                    margin-bottom: 0.5rem;
                }
            }
        </style>
    @endpush

    <div class="register-container">
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card register-card">
                    <div class="card-body p-0">
                        <div class="row">
                            <!-- Image Side -->
                            <div class="col-lg-5 d-none d-lg-block">
                                <div class="register-image-side">
                                    <div class="register-image-content">
                                        <div class="floating-icon">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <h4 class="font-weight-bold mb-3">Bergabung dengan Kami</h4>
                                        <p class="mb-4">
                                            Dapatkan akses ke layanan kesehatan digital yang memudahkan Anda dalam:
                                        </p>
                                        <div class="text-left">
                                            <div class="mb-3">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                <span>Daftar online tanpa antri</span>
                                            </div>
                                            <div class="mb-3">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                <span>Riwayat pemeriksaan digital</span>
                                            </div>
                                            <div class="mb-3">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                <span>Notifikasi jadwal praktik</span>
                                            </div>
                                            <div class="mb-3">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                <span>Akses 24/7 dari mana saja</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Side -->
                            <div class="col-lg-7">
                                <div class="register-form-side">
                                    <!-- Brand -->
                                    <div class="brand-logo">
                                        <h1 class="brand-title">
                                            <i class="fas fa-hospital-alt medical-icon"></i>Poliklinik
                                        </h1>
                                        <p class="brand-subtitle">Sistem Manajemen Digital</p>
                                    </div>

                                    <!-- Welcome Text -->
                                    <div class="welcome-text">
                                        <h4 class="welcome-title">Buat Akun Pasien Baru</h4>
                                        <p class="welcome-subtitle">Isi formulir di bawah untuk mendaftar sebagai pasien
                                        </p>
                                    </div>

                                    <!-- Info -->
                                    <div class="info-text">
                                        <i class="fas fa-info-circle"></i>
                                        <strong>Informasi:</strong> Akun yang didaftarkan akan menjadi akun pasien.
                                        Untuk akses admin atau dokter, silakan hubungi administrator.
                                    </div>

                                    <!-- Register Form -->
                                    <form class="user" action="{{ route('register') }}" method="POST">
                                        @csrf

                                        <!-- Personal Information -->
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                id="nama" name="nama" value="{{ old('nama') }}"
                                                placeholder="Nama Lengkap" required autocomplete="name">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}"
                                                placeholder="Alamat Email" required autocomplete="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control form-control-user @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                                rows="2" style="border-radius: 10rem; resize: none;" placeholder="Alamat Lengkap" required>{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text"
                                                    class="form-control form-control-user @error('no_ktp') is-invalid @enderror"
                                                    id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                                                    placeholder="Nomor KTP (16 digit)" maxlength="16"
                                                    pattern="[0-9]{16}" title="Nomor KTP harus 16 digit angka" required>
                                                @error('no_ktp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text"
                                                    class="form-control form-control-user @error('no_hp') is-invalid @enderror"
                                                    id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                                    placeholder="Nomor HP" required>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="password" name="password"
                                                    placeholder="Password (min. 8 karakter)" required
                                                    autocomplete="new-password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Konfirmasi Password" required
                                                    autocomplete="new-password">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-user-plus mr-2"></i>Daftar Akun
                                        </button>
                                    </form>

                                    <!-- Divider -->
                                    <div class="divider">
                                        <span>atau</span>
                                    </div>

                                    <!-- Login Link -->
                                    <div class="text-center">
                                        <p class="mb-0">
                                            Sudah punya akun?
                                            <a class="link-login" href="{{ route('login') }}">
                                                Masuk di sini
                                            </a>
                                        </p>
                                    </div>

                                    <!-- Back to Home -->
                                    <div class="text-center mt-3">
                                        <a class="small text-muted" href="{{ route('home') }}">
                                            <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
