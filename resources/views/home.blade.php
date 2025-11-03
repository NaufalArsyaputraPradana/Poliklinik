<x-layouts.auth title="Selamat Datang">
    @push('styles')
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }

            .welcome-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 0;
            }

            .welcome-card {
                background: rgba(255, 255, 255, 0.95);
                border-radius: 1.5rem;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .hero-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 3rem 2rem;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .hero-header::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 200%;
                height: 200%;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
                animation: float 20s linear infinite;
            }

            .hero-title {
                font-size: 3rem;
                font-weight: 800;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
                position: relative;
                z-index: 2;
            }

            .hero-subtitle {
                font-size: 1.3rem;
                opacity: 0.95;
                margin-bottom: 0;
                position: relative;
                z-index: 2;
            }

            .auth-options {
                padding: 2.5rem;
            }

            .auth-card-option {
                background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
                border: 2px solid #e3e6f0;
                border-radius: 1rem;
                padding: 2rem;
                text-align: center;
                transition: all 0.3s ease;
                height: 100%;
                position: relative;
                overflow: hidden;
            }

            .auth-card-option::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
                transition: left 0.5s;
            }

            .auth-card-option:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
                border-color: #667eea;
            }

            .auth-card-option:hover::before {
                left: 100%;
            }

            .auth-icon {
                font-size: 4rem;
                margin-bottom: 1.5rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                display: block;
            }

            .auth-title {
                font-size: 1.4rem;
                font-weight: 700;
                color: #5a5c69;
                margin-bottom: 1rem;
            }

            .auth-description {
                color: #6c757d;
                margin-bottom: 1.5rem;
                line-height: 1.6;
                font-size: 0.95rem;
            }

            .btn-auth {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                border-radius: 50px;
                padding: 0.8rem 2rem;
                color: white;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-block;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            }

            .btn-auth:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
                color: white;
                text-decoration: none;
            }



            @keyframes float {

                0%,
                100% {
                    transform: translateX(0);
                }

                50% {
                    transform: translateX(-20px);
                }
            }

            .floating-elements {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 1;
            }

            .floating-elements::before,
            .floating-elements::after {
                content: '';
                position: absolute;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 50%;
                animation: float 8s ease-in-out infinite;
            }

            .floating-elements::before {
                width: 300px;
                height: 300px;
                top: 10%;
                right: 10%;
                animation-delay: -2s;
            }

            .floating-elements::after {
                width: 200px;
                height: 200px;
                bottom: 10%;
                left: 10%;
                animation-delay: -4s;
            }
        </style>
    @endpush

    <div class="floating-elements"></div>

    <div class="welcome-section">
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12">
                <div class="welcome-card">
                    <!-- Hero Header -->
                    <div class="hero-header">
                        <h1 class="hero-title">
                            <i class="fas fa-hospital-alt mr-3"></i>Poliklinik Digital
                        </h1>
                        <p class="hero-subtitle">
                            Sistem Manajemen Klinik Terintegrasi
                        </p>
                    </div>

                    <!-- Auth Options -->
                    <div class="auth-options">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="auth-card-option">
                                    <i class="fas fa-sign-in-alt auth-icon"></i>
                                    <h3 class="auth-title">Masuk ke Sistem</h3>
                                    <p class="auth-description">
                                        Sudah memiliki akun? Masuk sebagai Admin, Dokter, atau Pasien untuk mengakses
                                        dashboard Anda.
                                    </p>
                                    <a href="{{ route('login') }}" class="btn-auth">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="auth-card-option">
                                    <i class="fas fa-user-plus auth-icon"></i>
                                    <h3 class="auth-title">Daftar Sebagai Pasien</h3>
                                    <p class="auth-description">
                                        Belum memiliki akun? Daftarkan diri Anda sebagai pasien baru untuk mulai
                                        menggunakan layanan kami.
                                    </p>
                                    <a href="{{ route('register') }}" class="btn-auth">
                                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
