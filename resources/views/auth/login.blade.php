<x-layouts.auth title="Login">
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
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
                min-height: 100vh;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                padding: 1rem !important;
                position: relative;
                overflow: hidden;
            }

            @keyframes gradientBG {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            .particles {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            .particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: white;
                border-radius: 50%;
                opacity: 0.6;
                animation: rise 10s infinite ease-in;
            }

            .particle:nth-child(1) {
                left: 10%;
                animation-delay: 0s;
            }

            .particle:nth-child(2) {
                left: 20%;
                animation-delay: 2s;
            }

            .particle:nth-child(3) {
                left: 30%;
                animation-delay: 4s;
            }

            .particle:nth-child(4) {
                left: 40%;
                animation-delay: 1s;
            }

            .particle:nth-child(5) {
                left: 50%;
                animation-delay: 3s;
            }

            .particle:nth-child(6) {
                left: 60%;
                animation-delay: 5s;
            }

            .particle:nth-child(7) {
                left: 70%;
                animation-delay: 2.5s;
            }

            .particle:nth-child(8) {
                left: 80%;
                animation-delay: 4.5s;
            }

            .particle:nth-child(9) {
                left: 90%;
                animation-delay: 1.5s;
            }

            .particle:nth-child(10) {
                left: 15%;
                animation-delay: 3.5s;
            }

            @keyframes rise {
                0% {
                    bottom: -10px;
                    opacity: 0;
                }

                10% {
                    opacity: 0.6;
                }

                90% {
                    opacity: 0.6;
                }

                100% {
                    bottom: 100vh;
                    opacity: 0;
                }
            }

            .login-container {
                position: relative;
                z-index: 10;
                width: 100%;
                max-width: 480px;
                margin: 0 auto;
            }

            .login-box {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 30px;
                box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(50px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .login-header {
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                padding: 3rem 2rem;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .login-header::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
                animation: rotate 20s linear infinite;
            }

            @keyframes rotate {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }

            .login-icon {
                width: 90px;
                height: 90px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                font-size: 3rem;
                color: #11998e;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                position: relative;
                z-index: 1;
            }

            .login-header h1 {
                color: white;
                font-size: 2.2rem;
                font-weight: 800;
                margin-bottom: 0.5rem;
                position: relative;
                z-index: 1;
            }

            .login-header p {
                color: rgba(255, 255, 255, 0.95);
                font-size: 1.1rem;
                margin: 0;
                position: relative;
                z-index: 1;
            }

            .login-body {
                padding: 2.5rem;
            }

            .form-group {
                margin-bottom: 1.8rem;
            }

            .form-label {
                display: block;
                font-weight: 700;
                color: #333;
                margin-bottom: 0.6rem;
                font-size: 0.95rem;
            }

            .input-wrapper {
                position: relative;
            }

            .input-icon {
                position: absolute;
                left: 1.2rem;
                top: 50%;
                transform: translateY(-50%);
                color: #999;
                font-size: 1.1rem;
            }

            .form-control {
                width: 100%;
                padding: 1rem 1rem 1rem 3.2rem;
                border: 2px solid #e0e0e0;
                border-radius: 15px;
                font-size: 1rem;
                transition: all 0.3s;
                background: #f8f9fa;
            }

            .form-control:focus {
                outline: none;
                border-color: #11998e;
                background: white;
                box-shadow: 0 0 0 4px rgba(17, 153, 142, 0.1);
            }

            .form-control:focus+.input-icon {
                color: #11998e;
            }

            .btn-submit {
                width: 100%;
                padding: 1.1rem;
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                border: none;
                border-radius: 15px;
                color: white;
                font-size: 1.1rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s;
                box-shadow: 0 10px 30px rgba(17, 153, 142, 0.4);
                margin-top: 1rem;
            }

            .btn-submit:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 40px rgba(17, 153, 142, 0.5);
            }

            .btn-submit:active {
                transform: translateY(-1px);
            }

            .divider {
                display: flex;
                align-items: center;
                margin: 2rem 0;
            }

            .divider::before,
            .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #ddd;
            }

            .divider span {
                padding: 0 1rem;
                color: #999;
                font-weight: 600;
                font-size: 0.9rem;
            }

            .register-section {
                text-align: center;
                padding: 1.5rem;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 15px;
            }

            .register-section p {
                margin: 0 0 0.8rem 0;
                color: #666;
                font-weight: 600;
            }

            .btn-register {
                display: inline-block;
                padding: 0.8rem 2.5rem;
                background: white;
                border: 2px solid #11998e;
                color: #11998e;
                border-radius: 10px;
                text-decoration: none;
                font-weight: 700;
                transition: all 0.3s;
            }

            .btn-register:hover {
                background: #11998e;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(17, 153, 142, 0.3);
                text-decoration: none;
            }

            .alert {
                padding: 1rem;
                border-radius: 12px;
                margin-bottom: 1.5rem;
            }

            .alert-danger {
                background: #fee;
                border: 1px solid #fcc;
                color: #c33;
            }

            @media (max-width: 576px) {
                .login-header {
                    padding: 2.5rem 1.5rem;
                }

                .login-header h1 {
                    font-size: 1.8rem;
                }

                .login-body {
                    padding: 2rem 1.5rem;
                }

                .login-icon {
                    width: 70px;
                    height: 70px;
                    font-size: 2.5rem;
                }
            }
        </style>
    @endpush

    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h1>Welcome Back!</h1>
                <p>Login ke Sistem Poliklinik</p>
            </div>

            <div class="login-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 1.2rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required
                                autofocus>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Masukkan password Anda" required>
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                    </button>
                </form>

                <div class="divider">
                    <span>ATAU</span>
                </div>

                <div class="register-section">
                    <p>Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="btn-register">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
