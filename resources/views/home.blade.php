<x-layouts.auth title="Home">
    @push('styles')
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /* Override container default */
            .container {
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            body {
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                position: relative;
                overflow-x: hidden;
            }

            .animated-bg {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 1;
                overflow: hidden;
            }

            .shape {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                animation: float 20s infinite ease-in-out;
            }

            .shape:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 10%;
                left: 10%;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                width: 120px;
                height: 120px;
                top: 70%;
                left: 80%;
                animation-delay: 2s;
            }

            .shape:nth-child(3) {
                width: 100px;
                height: 100px;
                top: 40%;
                left: 70%;
                animation-delay: 4s;
            }

            .shape:nth-child(4) {
                width: 60px;
                height: 60px;
                top: 80%;
                left: 20%;
                animation-delay: 1s;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0) translateX(0);
                }

                33% {
                    transform: translateY(-30px) translateX(30px);
                }

                66% {
                    transform: translateY(-60px) translateX(-20px);
                }
            }

            .container {
                position: relative;
                z-index: 10;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
            }

            .hero-section {
                max-width: 1200px;
                width: 100%;
                text-align: center;
            }

            .logo-container {
                margin-bottom: 2rem;
                animation: fadeInDown 0.8s ease-out;
            }

            .logo-icon {
                width: 100px;
                height: 100px;
                background: white;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 3rem;
                color: #11998e;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                margin-bottom: 1rem;
            }

            .main-title {
                font-size: 3.5rem;
                font-weight: 900;
                color: white;
                margin-bottom: 1rem;
                text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                animation: fadeInDown 0.8s ease-out 0.2s both;
            }

            .subtitle {
                font-size: 1.5rem;
                color: rgba(255, 255, 255, 0.95);
                margin-bottom: 3rem;
                animation: fadeInDown 0.8s ease-out 0.4s both;
            }

            .cards-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }

            .action-card {
                background: white;
                border-radius: 20px;
                padding: 3rem 2rem;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                animation: fadeInUp 0.8s ease-out both;
                position: relative;
                overflow: hidden;
            }

            .action-card:nth-child(1) {
                animation-delay: 0.6s;
            }

            .action-card:nth-child(2) {
                animation-delay: 0.8s;
            }

            .action-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, #11998e, #38ef7d);
            }

            .action-card:hover {
                transform: translateY(-15px) scale(1.02);
                box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            }

            .card-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                font-size: 2.5rem;
                color: white;
            }

            .card-title {
                font-size: 1.8rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 1rem;
            }

            .card-description {
                color: #666;
                margin-bottom: 2rem;
                line-height: 1.6;
            }

            .card-btn {
                display: inline-block;
                padding: 1rem 3rem;
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                color: white;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 600;
                font-size: 1.1rem;
                transition: all 0.3s;
                box-shadow: 0 10px 30px rgba(17, 153, 142, 0.4);
            }

            .card-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 40px rgba(17, 153, 142, 0.6);
                color: white;
                text-decoration: none;
            }

            .features-showcase {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
                margin-top: 3rem;
                animation: fadeInUp 0.8s ease-out 1s both;
            }

            .feature-item {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                border-radius: 15px;
                padding: 1.5rem;
                text-align: center;
                color: white;
                transition: all 0.3s;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .feature-item:hover {
                background: rgba(255, 255, 255, 0.25);
                transform: translateY(-5px);
            }

            .feature-item i {
                font-size: 2rem;
                margin-bottom: 0.5rem;
                display: block;
            }

            .feature-item h4 {
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 0.3rem;
            }

            .feature-item p {
                font-size: 0.85rem;
                opacity: 0.9;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
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

            @media (max-width: 768px) {
                .main-title {
                    font-size: 2.5rem;
                }

                .subtitle {
                    font-size: 1.2rem;
                }

                .cards-container {
                    grid-template-columns: 1fr;
                }

                .features-showcase {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .main-title {
                    font-size: 2rem;
                }

                .logo-icon {
                    width: 80px;
                    height: 80px;
                    font-size: 2.5rem;
                }
            }
        </style>
    @endpush

    <div class="animated-bg">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="hero-section">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-hospital"></i>
                </div>
            </div>

            <h1 class="main-title">Sistem Poliklinik</h1>
            <p class="subtitle">Layanan Kesehatan Modern dan Profesional</p>

            <div class="cards-container">
                <div class="action-card">
                    <div class="card-icon">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <h3 class="card-title">Sudah Punya Akun?</h3>
                    <p class="card-description">Login untuk mengakses layanan poliklinik sebagai pasien atau dokter</p>
                    <a href="{{ route('login') }}" class="card-btn">Masuk Sekarang</a>
                </div>

                <div class="action-card">
                    <div class="card-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="card-title">Pasien Baru?</h3>
                    <p class="card-description">Daftar sekarang untuk mendapatkan pelayanan kesehatan terbaik</p>
                    <a href="{{ route('register') }}" class="card-btn">Daftar Gratis</a>
                </div>
            </div>

            <div class="features-showcase">
                <div class="feature-item">
                    <i class="fas fa-user-md"></i>
                    <h4>Dokter Profesional</h4>
                    <p>Tenaga medis berpengalaman</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-calendar-check"></i>
                    <h4>Jadwal Fleksibel</h4>
                    <p>Booking kapan saja</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-prescription-bottle"></i>
                    <h4>Obat Lengkap</h4>
                    <p>Stok obat terjamin</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <h4>Layanan Cepat</h4>
                    <p>Proses efisien</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
