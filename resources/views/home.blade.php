<x-layouts.sb-admin title="Selamat Datang - Poliklinik">
    @push('styles')
        <style>
            .hero-section {
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .hero-content {
                text-align: center;
                color: white;
                max-width: 800px;
                padding: 40px;
                padding-bottom: 60px;
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

            .hero-subtitle {
                font-size: 1.4rem;
                margin-bottom: 2rem;
                opacity: 0.9;
            }

            .hero-description {
                font-size: 1.1rem;
                margin-bottom: 3rem;
                opacity: 0.8;
                line-height: 1.6;
            }

            .auth-section {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                padding: 40px 0 20px 0;
            }

            .auth-card {
                background: white;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease;
            }

            .auth-card:hover {
                transform: translateY(-5px);
            }

            .auth-option {
                padding: 40px;
                text-align: center;
                transition: all 0.3s ease;
            }

            .auth-option:hover {
                background: #f8f9fa;
            }

            .auth-icon {
                font-size: 3rem;
                margin-bottom: 20px;
                color: #667eea;
            }

            .auth-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 15px;
                color: #333;
            }

            .auth-description {
                color: #666;
                margin-bottom: 25px;
                line-height: 1.6;
            }

            .auth-btn {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                border-radius: 25px;
                padding: 12px 30px;
                color: white;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-block;
            }

            .auth-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
                color: white;
                text-decoration: none;
            }

            .demo-section {
                background: #ffffff;
                padding: 30px;
                border-radius: 15px;
                margin-top: 20px;
                margin-bottom: 0;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .floating-shapes {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 1;
            }

            .floating-shapes::before,
            .floating-shapes::after {
                content: '';
                position: absolute;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }

            .floating-shapes::before {
                width: 200px;
                height: 200px;
                top: 20%;
                right: 10%;
                animation-delay: -2s;
            }

            .floating-shapes::after {
                width: 150px;
                height: 150px;
                bottom: 20%;
                left: 10%;
                animation-delay: -4s;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-20px);
                }
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section id="hero" class="hero-section">
        <div class="floating-shapes"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                <i class="fas fa-hospital-alt mr-3"></i>Poliklinik
            </h1>
            <p class="hero-subtitle">Sistem Manajemen Klinik Digital</p>
            <p class="hero-description">
                Platform terintegrasi untuk manajemen poliklinik modern. Kelola pasien, dokter, jadwal, dan layanan
                kesehatan dengan mudah dan efisien.
            </p>
        </div>
    </section>

    <!-- Auth Section -->
    <section id="auth" class="auth-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="auth-card">
                        <div class="auth-option">
                            <i class="fas fa-sign-in-alt auth-icon"></i>
                            <h3 class="auth-title">Masuk ke Sistem</h3>
                            <p class="auth-description">
                                Sudah memiliki akun? Masuk sebagai Admin, Dokter, atau Pasien untuk mengakses dashboard
                                Anda.
                            </p>
                            <a href="{{ route('login') }}" class="auth-btn">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="auth-card">
                        <div class="auth-option">
                            <i class="fas fa-user-plus auth-icon"></i>
                            <h3 class="auth-title">Daftar Sebagai Pasien</h3>
                            <p class="auth-description">
                                Belum memiliki akun? Daftarkan diri Anda sebagai pasien baru untuk mulai menggunakan
                                layanan kami.
                            </p>
                            <a href="{{ route('register') }}" class="auth-btn">
                                <i class="fas fa-user-plus mr-2"></i>Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demo Section -->
            <div class="demo-section">
                <div class="text-center">
                    <h4 class="mb-1">
                        <i class="fas fa-users mr-2"></i>Demo Login
                    </h4>
                    <p class="text-muted mb-2">Gunakan akun demo berikut untuk mencoba sistem:</p>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-primary h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-shield fa-2x text-primary mb-2"></i>
                                    <h6 class="font-weight-bold text-primary">ADMIN</h6>
                                    <small class="text-muted">
                                        admin@gmail.com<br>
                                        <span class="badge badge-primary">admin</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-success h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-md fa-2x text-success mb-2"></i>
                                    <h6 class="font-weight-bold text-success">DOKTER</h6>
                                    <small class="text-muted">
                                        dokter@gmail.com<br>
                                        <span class="badge badge-success">dokter</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-info h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-user fa-2x text-info mb-2"></i>
                                    <h6 class="font-weight-bold text-info">PASIEN</h6>
                                    <small class="text-muted">
                                        pasien@gmail.com<br>
                                        <span class="badge badge-info">pasien</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Smooth scrolling animation observer
            document.addEventListener('DOMContentLoaded', function() {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.animation = 'fadeInUp 0.6s ease-out';
                        }
                    });
                }, observerOptions);

                // Observe auth cards
                document.querySelectorAll('.auth-card').forEach(card => {
                    observer.observe(card);
                });
            });
        </script>
    @endpush
</x-layouts.sb-admin>
