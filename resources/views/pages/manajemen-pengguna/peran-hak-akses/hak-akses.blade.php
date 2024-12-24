<x-layouts.adminpanel :title="$title">
    @can('hak-akses.')
        <div class="row">
            @can('hak-akses.tambah')
                <div class="col-12 col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah {{ $title }}</h3>
                        </div>
                        <form action="{{ route('manajemen-pengguna.peran-hak-akses.hak-akses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fg-01">Nama Hak Akses <span class="text-red">*</span></label>
                                    <input type="text" class="form-control @error('name', 'store') is-invalid @enderror" id="fg-01" name="name" value="{{ $errors->hasBag('store') ? old('name') : '' }}" placeholder="Isikan nama hak akses">
                                    @error('name', 'store')
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
            @can('hak-akses.daftar')
                <div class="col-12 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar {{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <table id="table-hak-akses" class="table-striped table-bordered table-hover nowrap table-dark table" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Hak Akses</th>
                                        @canany(['hak-akses.detail', 'hak-akses.ubah', 'hak-akses.hapus'])
                                            <th>Menu</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hakAkses as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            @canany(['hak-akses.detail', 'hak-akses.ubah', 'hak-akses.hapus'])
                                                <td class="text-center">
                                                    @can('hak-akses.detail')
                                                        <button type="button" class="btn btn-info btn-xs btn-menu" data-toggle="modal" data-target="#modal-detail" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                                    @endcan
                                                    @can('hak-akses.ubah')
                                                        <button type="button" class="btn btn-warning btn-xs btn-menu text-white" data-toggle="modal" data-target="#modal-ubah" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                    @endcan
                                                    @can('hak-akses.hapus')
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

        @can('hak-akses.detail')
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
                                    <strong class="text-muted"><i class="fas fa-tag mr-1"></i> Nama Hak Akses</strong>
                                    <p id="nama_hak_akses" class="m-0"></p>
                                </li>
                                <li class="list-group-item">
                                    <strong class="text-muted"><i class="fas fa-shield-alt mr-1"></i> Nama pengaman</strong>
                                    <p id="nama_pengaman" class="m-0"></p>
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

        @can('hak-akses.ubah')
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
                                    <label for="fg-11">Nama Hak Akses <span class="text-red">*</span></label>
                                    <input type="text" class="form-control @error('name', 'update') is-invalid @enderror" id="fg-11" name="name" value="{{ $errors->hasBag('update') ? old('name') : '' }}" placeholder="Isikan nama hak akses">
                                    @error('name', 'update')
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

        @can('hak-akses.hapus')
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
                                <p class="m-0 text-center">Apakah anda yakin untuk menghapus data Hak Akses dengan Nama <span id="name" class="text-bold"></span>?</p>
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
            <script src="{{ asset('assets/myassets/dist/js/pages/manajemen-pengguna/peran-hak-akses/hak-akses.js') }}"></script>
        @endsection
    @endcan
</x-layouts.adminpanel>
