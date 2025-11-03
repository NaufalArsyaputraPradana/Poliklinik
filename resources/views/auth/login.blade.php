<x-layouts.auth title="Login">
    @push('styles')
        <style>
            .login-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 0;
            }

            .login-card {
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

            .login-image-side {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 600px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .login-image-side::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('{{ asset('template-admin/img/undraw_medicine_b1ol.svg') }}');
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
                opacity: 0.1;
            }

            .login-image-content {
                position: relative;
                z-index: 2;
                padding: 2rem;
            }

            .login-form-side {
                padding: 2.5rem 2rem;
                display: flex;
                flex-direction: column;
                justify-content: center;
                min-height: 600px;
            }

            .brand-logo {
                text-align: center;
                margin-bottom: 2rem;
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
                margin-bottom: 2rem;
            }

            .welcome-title {
                color: #5a5c69;
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .welcome-subtitle {
                color: #858796;
                font-size: 0.9rem;
            }

            .form-control-user {
                border-radius: 10rem;
                padding: 1.5rem 1rem;
                border: 1px solid #d1d3e2;
                font-size: 0.9rem;
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



            .link-register {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
            }

            .link-register:hover {
                color: #764ba2;
                text-decoration: none;
            }

            .floating-icon {
                font-size: 4rem;
                margin-bottom: 1rem;
                opacity: 0.9;
            }

            @media (max-width: 991.98px) {
                .login-container {
                    padding: 1rem 0;
                }

                .login-form-side {
                    padding: 2rem 1.5rem;
                    min-height: auto;
                }

                .brand-title {
                    font-size: 1.8rem;
                }

                .welcome-title {
                    font-size: 1.3rem;
                }
            }

            @media (max-width: 575.98px) {
                .login-form-side {
                    padding: 1.5rem 1rem;
                }

                .brand-title {
                    font-size: 1.6rem;
                }

                .welcome-title {
                    font-size: 1.2rem;
                }
            }
        </style>
    @endpush

    <div class="login-container">
        <!-- Outer Row -->
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card login-card">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- Image Side -->
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="login-image-side">
                                    <div class="login-image-content">
                                        <div class="floating-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <h3 class="font-weight-bold mb-3">Sistem Poliklinik Digital</h3>
                                        <p class="lead mb-4">
                                            Platform manajemen terintegrasi untuk pelayanan kesehatan yang lebih efisien
                                            dan modern.
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <div class="text-center mx-3">
                                                <i class="fas fa-calendar-check fa-2x mb-2"></i>
                                                <p class="small">Jadwal Praktik</p>
                                            </div>
                                            <div class="text-center mx-3">
                                                <i class="fas fa-prescription-bottle-alt fa-2x mb-2"></i>
                                                <p class="small">Resep Digital</p>
                                            </div>
                                            <div class="text-center mx-3">
                                                <i class="fas fa-chart-line fa-2x mb-2"></i>
                                                <p class="small">Laporan Real-time</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Side -->
                            <div class="col-lg-6">
                                <div class="login-form-side">
                                    <!-- Brand -->
                                    <div class="brand-logo">
                                        <h1 class="brand-title">
                                            <i class="fas fa-hospital-alt medical-icon"></i>Poliklinik
                                        </h1>
                                        <p class="brand-subtitle">Sistem Manajemen Digital</p>
                                    </div>

                                    <!-- Welcome Text -->
                                    <div class="welcome-text">
                                        <h4 class="welcome-title">Masuk ke Akun Anda</h4>
                                        <p class="welcome-subtitle">Silakan masukkan kredensial login Anda</p>
                                    </div>

                                    <!-- Login Form -->
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}"
                                                placeholder="Masukkan Alamat Email..." required autocomplete="email"
                                                autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="Password" required
                                                autocomplete="current-password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                        </button>
                                    </form>

                                    <!-- Divider -->
                                    <div class="divider">
                                        <span>atau</span>
                                    </div>

                                    <!-- Register Link -->
                                    <div class="text-center">
                                        <p class="mb-0">
                                            Belum punya akun?
                                            <a class="link-register" href="{{ route('register') }}">
                                                Daftar Sebagai Pasien
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
