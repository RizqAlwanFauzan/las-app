@if (session('success'))
    <div class="d-none toastr" type="success">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="d-none toastr" type="warning">
        {{ session('warning') }}
    </div>
@endif

@if (in_array(true, [$errors->hasBag('store'), $errors->hasBag('update'), $errors->hasBag('kelolaHakAkses')]))
    <div class="d-none toastr" type="error">
        Data gagal disimpan, periksa inputan Anda!
    </div>
@endif

@if ($errors->any())
    <div class="d-none toastr" type="error">
        Server error, silahkan coba lagi!
    </div>
@endif
