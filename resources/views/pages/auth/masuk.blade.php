<x-layouts.auth :title="$title" bodyClass="login-page" divClass="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="mb-0"><b>LAS</b> App</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
            <form action="{{ route('auth.masuk.authenticate') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email', 'authenticate') is-invalid @enderror" name="email" value="{{ $errors->hasBag('authenticate') ? old('email') : '' }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email', 'authenticate')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password', 'authenticate') is-invalid @enderror" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password', 'authenticate')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Masuk</button>
            </form>
        </div>
        <div class="card-footer">
            <p class="mb-0 text-center">
                Belum memiliki akun?
                <a href="{{ route('auth.daftar') }}" class="text-center">Daftar sekarang!</a>
            </p>
        </div>
    </div>
</x-layouts.auth>
