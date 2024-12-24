<x-layouts.adminpanel :title="$title">
    @can('pengguna')
        <div class="row">
            @can('tambah-pengguna')
                <div class="col-12 col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah {{ $title }}</h3>
                        </div>
                        <form action="{{ route('manajemen-pengguna.pengguna.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fg-01">Nama Lengkap <span class="text-red">*</span></label>
                                    <input type="text" class="form-control @error('name', 'store') is-invalid @enderror" id="fg-01" name="name" value="{{ $errors->hasBag('store') ? old('name') : '' }}" placeholder="Isikan nama lengkap">
                                    @error('name', 'store')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fg-02">Email <span class="text-red">*</span></label>
                                    <input type="email" class="form-control @error('email', 'store') is-invalid @enderror" id="fg-02" name="email" value="{{ $errors->hasBag('store') ? old('email') : '' }}" placeholder="Isikan email">
                                    @error('email', 'store')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fg-03">Password <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="fg-03" name="password" value="password123" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="fg-04">Peran <span class="text-red">*</span></label>
                                    <select class="form-control select2bs4 @error('peran*', 'store') is-invalid @enderror" id="fg-04" name="peran[]" multiple="multiple" data-placeholder="Pilih beberapa peran" style="width: 100%;">
                                        @foreach ($peran as $name)
                                            <option value="{{ $name }}" {{ $errors->hasBag('store') && in_array($name, old('peran', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('peran*', 'store')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Reset</button>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan
            @can('daftar-pengguna')
                <div class="col-12 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar {{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <table id="table-pengguna" class="table-striped table-bordered table-hover nowrap table-dark table" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        @canany(['reset-password-pengguna', 'detail-pengguna', 'ubah-pengguna', 'hapus-pengguna'])
                                            <th>Menu</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengguna as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            @canany(['reset-password-pengguna', 'detail-pengguna', 'ubah-pengguna', 'hapus-pengguna'])
                                                <td class="text-center">
                                                    @can('reset-password-pengguna')
                                                        <button type="button" class="btn btn-success btn-xs btn-menu" data-toggle="modal" data-target="#modal-reset" data-id="{{ $item->id }}"><i class="fas fa-unlock-alt"></i></button>
                                                    @endcan
                                                    @can('detail-pengguna')
                                                        <button type="button" class="btn btn-info btn-xs btn-menu" data-toggle="modal" data-target="#modal-detail" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                                    @endcan
                                                    @can('ubah-pengguna')
                                                        <button type="button" class="btn btn-warning btn-xs btn-menu text-white" data-toggle="modal" data-target="#modal-ubah" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                    @endcan
                                                    @can('hapus-pengguna')
                                                        <button type="button" class="btn btn-danger btn-xs btn-menu" data-toggle="modal" data-target="#modal-hapus" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></button>
                                                    @endcan
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
        </div>

        @can('reset-password-pengguna')
            <div class="modal fade" id="modal-reset">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Reset Password {{ $title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="fg-03">Password <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="fg-03" name="password" value="password123" readonly>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('detail-pengguna')
            <div class="modal fade" id="modal-detail">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail {{ $title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mt-3">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <strong class="text-muted"><i class="fas fa-key mr-1"></i> ID</strong>
                                    <p id="id" class="m-0"></p>
                                </li>
                                <li class="list-group-item">
                                    <strong class="text-muted"><i class="fas fa-user mr-1"></i> Nama Lengkap</strong>
                                    <p id="name" class="m-0"></p>
                                </li>
                                <li class="list-group-item">
                                    <strong class="text-muted"><i class="fas fa-envelope mr-1"></i> Email</strong>
                                    <p id="email" class="m-0"></p>
                                </li>
                                <li class="list-group-item">
                                    <strong class="text-muted"><i class="fas fa-tag mr-1"></i> Peran</strong>
                                    <p id="peran" class="m-0"></p>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('ubah-pengguna')
            <div class="modal fade" id="modal-ubah">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Data {{ $title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{ $errors->hasBag('update') ? old('id') : '' }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="fg-11">Nama Lengkap <span class="text-red">*</span></label>
                                    <input type="text" class="form-control @error('name', 'update') is-invalid @enderror" id="fg-11" name="name" value="{{ $errors->hasBag('update') ? old('name') : '' }}" placeholder="Isikan nama lengkap">
                                    @error('name', 'update')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fg-12">Email <span class="text-red">*</span></label>
                                    <input type="email" class="form-control @error('email', 'update') is-invalid @enderror" id="fg-12" name="email" value="{{ $errors->hasBag('update') ? old('email') : '' }}" placeholder="Isikan email">
                                    @error('email', 'update')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fg-13">Peran <span class="text-red">*</span></label>
                                    <select class="form-control select2bs4 @error('peran*', 'update') is-invalid @enderror" id="fg-13" name="peran[]" multiple="multiple" data-placeholder="Pilih beberapa peran" style="width: 100%;">
                                        @foreach ($peran as $name)
                                            <option value="{{ $name }}" {{ $errors->hasBag('update') && in_array($name, old('peran', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('peran*', 'update')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('hapus-pengguna')
            <div class="modal fade" id="modal-hapus">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hapus Data {{ $title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            @method('delete')
                            @csrf
                            <div class="modal-body">
                                <p class="m-0 text-center">Apakah anda yakin untuk menghapus data pengguna dengan nama <span id="name" class="text-bold"></span>?</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Ya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @section('js')
            <script src="{{ asset('assets/myassets/dist/js/pages/manajemen-pengguna/pengguna.js') }}"></script>
        @endsection
    @endcan
</x-layouts.adminpanel>
