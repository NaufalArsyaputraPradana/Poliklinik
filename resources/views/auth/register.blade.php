<x-layouts.auth title="Daftar Akun">
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
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                padding: 2rem 1rem !important;
                position: relative;
                overflow-x: hidden;
            }

            body::before {
                content: '';
                position: fixed;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
                background-size: 50px 50px;
                animation: moveBackground 20s linear infinite;
                z-index: 1;
            }

            @keyframes moveBackground {
                0% {
                    transform: translate(0, 0);
                }

                100% {
                    transform: translate(50px, 50px);
                }
            }

            .register-container {
                position: relative;
                z-index: 10;
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
            }

            .register-box {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                border-radius: 30px;
                box-shadow: 0 30px 90px rgba(0, 0, 0, 0.4);
                overflow: hidden;
                animation: fadeInScale 0.7s ease-out;
            }

            @keyframes fadeInScale {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .register-header {
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                padding: 2.5rem 2rem;
                text-align: center;
                position: relative;
            }

            .register-header::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg,
                        transparent,
                        rgba(255, 255, 255, 0.5),
                        transparent);
            }

            .register-icon {
                width: 80px;
                height: 80px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                font-size: 2.5rem;
                color: #11998e;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .register-header h1 {
                color: white;
                font-size: 2rem;
                font-weight: 800;
                margin-bottom: 0.5rem;
            }

            .register-header p {
                color: rgba(255, 255, 255, 0.95);
                font-size: 1rem;
                margin: 0;
            }

            .register-body {
                padding: 2.5rem;
            }

            .form-row-custom {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.2rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                font-weight: 700;
                color: #333;
                margin-bottom: 0.6rem;
                font-size: 0.95rem;
            }

            .form-label i {
                margin-right: 0.4rem;
                color: #11998e;
            }

            .form-control {
                width: 100%;
                padding: 0.95rem 1.2rem;
                border: 2px solid #e0e0e0;
                border-radius: 12px;
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

            textarea.form-control {
                resize: vertical;
                min-height: 80px;
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

            .login-section {
                text-align: center;
                padding: 1.5rem;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 15px;
            }

            .login-section p {
                margin: 0 0 0.8rem 0;
                color: #666;
                font-weight: 600;
            }

            .btn-login {
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

            .btn-login:hover {
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

            .password-strength {
                margin-top: 0.5rem;
                font-size: 0.85rem;
            }

            .strength-bar {
                height: 4px;
                background: #e0e0e0;
                border-radius: 2px;
                margin-top: 0.3rem;
                overflow: hidden;
            }

            .strength-fill {
                height: 100%;
                width: 0;
                transition: all 0.3s;
                border-radius: 2px;
            }

            @media (max-width: 768px) {
                .register-body {
                    padding: 2rem 1.5rem;
                }

                .form-row-custom {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 576px) {
                body {
                    padding: 1rem;
                }

                .register-header {
                    padding: 2rem 1.5rem;
                }

                .register-header h1 {
                    font-size: 1.6rem;
                }

                .register-icon {
                    width: 65px;
                    height: 65px;
                    font-size: 2rem;
                }
            }
        </style>
    @endpush

    <div class="register-container">
        <div class="register-box">
            <div class="register-header">
                <div class="register-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Buat Akun Baru</h1>
                <p>Daftar sebagai pasien poliklinik</p>
            </div>

            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 1.2rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required autofocus>
                        @error('nama')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i>Alamat
                        </label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            placeholder="Masukkan alamat lengkap" rows="2" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row-custom">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-id-card"></i>Nomor KTP
                            </label>
                            <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                                name="no_ktp" value="{{ old('no_ktp') }}" placeholder="16 digit" maxlength="16"
                                required>
                            @error('no_ktp')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone"></i>Nomor HP
                            </label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                            @error('no_hp')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row-custom">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>Password
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Min. 8 karakter" required>
                            @error('password')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>Konfirmasi Password
                            </label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </button>
                </form>

                <div class="divider">
                    <span>ATAU</span>
                </div>

                <div class="login-section">
                    <p>Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
