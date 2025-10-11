<x-layouts.guest title="Login">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}" class="text-white" style="color:#fff;"><b>Poli</b>klinik</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email" required value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                            </button>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{ route('register') }}">Daftar sebagai anggota baru</a>
                </p>
                <p class="mb-0">
                    <a href="{{ url('/') }}" class="text-center">Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.guest>
