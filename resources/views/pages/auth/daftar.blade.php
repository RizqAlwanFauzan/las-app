<x-layouts.auth :title="$title" bodyClass="register-page" divClass="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="mb-0"><b>LAS</b> App</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Daftar sebagai pengguna baru</p>
            <form action="{{ route('auth.daftar.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name', 'store') is-invalid @enderror" name="name" value="{{ $errors->hasBag('store') ? old('name') : '' }}" placeholder="Nama Lengkap">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name', 'store')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email', 'store') is-invalid @enderror" name="email" value="{{ $errors->hasBag('store') ? old('email') : '' }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email', 'store')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password', 'store') is-invalid @enderror" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password', 'store')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('confirm_password', 'store') is-invalid @enderror" name="confirm_password" placeholder="Konfirmasi password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('confirm_password', 'store')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> Daftar</button>
            </form>
        </div>
        <div class="card-footer">
            <p class="mb-0 text-center">
                Sudah memiliki akun?
                <a href="{{ route('auth.masuk') }}" class="text-center">Masuk sekarang!</a>
            </p>
        </div>
    </div>
</x-layouts.auth>
