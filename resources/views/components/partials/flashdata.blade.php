@if (session('success'))
    <div class="d-none toastr" type="success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="d-none toastr" type="error">
        {{ session('error') }}
    </div>
@endif

@if ($errors->hasBag('authenticate'))
    <div class="d-none toastr" type="warning">
        Login gagal, periksa inputan Anda!
    </div>
@endif

@if (in_array(true, [$errors->hasBag('store'), $errors->hasBag('update'), $errors->hasBag('kelolaHakAkses'), $errors->hasBag('resetPassword')]))
    <div class="d-none toastr" type="warning">
        Data gagal disimpan, periksa inputan Anda!
    </div>
@endif

@if ($errors->any())
    <div class="d-none toastr" type="error">
        Server error, silahkan coba lagi!
    </div>
@endif
