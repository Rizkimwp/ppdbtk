@extends('index')

@section('title', 'Pendaftaran')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary me-2 text-white">
                    <i class="mdi mdi-plus-box"></i>
                </span> Pendaftaran
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        @if ($berkasTidakValid->isNotEmpty())
            @include('components.berkas-upload')
        @elseif($siswa)
            @include('components.biodata')
        @elseif(!$hasOpen)
            @include('components.pendaftaran-tutup')
        @else
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-title">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            @php
                                // Default values
                                $user = Auth::user();
                                $defaultNisn = old('nisn');
                                $defaultName = old('nama_lengkap');
                                $defaultEmail = old('email');

                                // Check if user is authenticated and has the 'siswa' role
                                if (Auth::check() && Auth::user()->role === 'siswa') {
                                    $defaultNisn = $user->username;
                                    $defaultName = $user->name;
                                    $defaultEmail = $user->email;
                                }
                            @endphp

                        </div>
                        <div class="card-body">
                            @if ($user->role === 'admin' || ($user->role === 'siswa' && $hasPaid))
                                <form class="form-sample" action="{{ route('calon-siswa.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h4 class="font-bold"> Data Siswa </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">NIK</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="nik" name="nik"

                                                        class="form-control @error('nik') is-invalid @enderror" />
                                                </div>
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="nama_lengkap" name="nama_lengkap"
                                                        value="{{ $defaultName }}"
                                                        class="form-control @error('nama_lengkap') is-invalid @enderror" />
                                                </div>
                                                @error('nama_lengkap')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">NISN</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="nisn" name="nisn"
                                                        value="{{ $defaultNisn }}"
                                                        class="form-control @error('nisn') is-invalid @enderror" />
                                                </div>
                                                @error('nisn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Asal Sekolah</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="asal_sekolah" name="asal_sekolah"
                                                        value="{{ $defaultName }}"
                                                        class="form-control @error('asal_sekolah') is-invalid @enderror" />
                                                </div>
                                                @error('asal_sekolah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Panggilan</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('nama_panggilan') is-invalid @enderror"
                                                        id="nama_panggilan" name="nama_panggilan"
                                                        value="{{ old('nama_panggilan') }}" />
                                                </div>
                                                @error('nama_panggilan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Umur</label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control @error('umur') is-invalid @enderror"
                                                        id="umur" name="umur" value="{{ old('umur') }}" />
                                                </div>
                                                @error('umur')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                        id="tempat_lahir" name="tempat_lahir"
                                                        value="{{ old('tempat_lahir') }}" />
                                                </div>
                                                @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date"
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        placeholder="dd/mm/yyyy" id="tanggal_lahir" name="tanggal_lahir"
                                                        value="{{ old('tanggal_lahir') }}" />
                                                </div>
                                                @error('tanggal_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                        id="jenis_kelamin" name="jenis_kelamin"
                                                        value="{{ old('jenis_kelamin') }}">
                                                        <option value="laki_laki">Laki-Laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                @error('jenis_kelamin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Anak Ke</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('anak_ke') is-invalid @enderror"
                                                        value="{{ old('anak_ke') }}" name="anak_ke" id="anak_ke" />
                                                </div>
                                                @error('anak_ke')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status Dikeluarga</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('status_dalam_keluarga') is-invalid @enderror"
                                                        id="status_dalam_keluarga" name="status_dalam_keluarga"
                                                        value="{{ old('status_dalam_keluarga') }}" />
                                                </div>
                                                @error('status_dalam_keluarga')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Agama</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select @error('agama') is-invalid @enderror"
                                                        value="{{ old('id_agama') }}" id="agama" name="id_agama">
                                                        @foreach ($agama as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_agama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('id_agama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="customRange3" class="col-sm-3 col-form-label">Tinggi
                                                    Badan</label>
                                                <div class="col-sm-9">
                                                    <input type="range"
                                                        class="form-range @error('tinggi_badan') is-invalid @enderror"
                                                        min="0" max="100" step="0.5" id="customRange3"
                                                        oninput="updateRangeTinggi(this.value)" id="tinggi_badan"
                                                        name="tinggi_badan" value="{{ old('tinggi_badan') }}">
                                                    <span id="rangeValue">2.5</span>CM
                                                    <!-- Awalnya diatur ke nilai tengah -->
                                                </div>
                                                @error('tinggi_badan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="customRange2" class="col-sm-3 col-form-label">Berat
                                                    Badan</label>
                                                <div class="col-sm-9">
                                                    <input type="range"
                                                        class="form-range @error('berat_badan') is-invalid @enderror"
                                                        id="berat_badan" name="berat_badan" min="0"
                                                        max="100" value="{{ old('berat_badan') }}" step="0.5"
                                                        id="customRange2" oninput="updateRangeBerat(this.value)">
                                                    <span id="rangeValue2">2.5</span>KG
                                                    <!-- Awalnya diatur ke nilai tengah -->
                                                </div>
                                                @error('berat_badan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Riwayat Hafalan Qur'an</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('riwayat_hafalan') is-invalid @enderror"
                                                        id="riwayat_hafalan" name="riwayat_hafalan"
                                                        value="{{ old('riwayat_hafalan') }}" />
                                                </div>
                                                @error('riwayat_hafalan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    <h4 class="font-bold"> Data Orang Tua </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Ayah</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('nama_ayah') is-invalid @enderror"
                                                        id="nama_ayah" name="nama_ayah"
                                                        value="{{ old('nama_ayah') }}" />
                                                </div>
                                                @error('nama_ayah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Ibu</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('nama_ibu') is-invalid @enderror"
                                                        id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" />
                                                </div>
                                                @error('nama_ibu')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                                                <div class="col-sm-9">
                                                    <select
                                                        class="form-select @error('pekerjaan_ayah_id') is-invalid @enderror"
                                                        id="" name="pekerjaan_ayah_id"
                                                        value="{{ old('pekerjaan_ayah_id') }}">
                                                        @foreach ($pekerjaan as $item)
                                                            <option value={{ $item->id }}> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('pekerjaan_ayah_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                                                <div class="col-sm-9">
                                                    <select
                                                        class="form-select @error('pekerjaan_ibu_id') is-invalid @enderror"
                                                        value="{{ old('pekerjaan_ibu_id') }}" id=""
                                                        name="pekerjaan_ibu_id">
                                                        @foreach ($pekerjaan as $item)
                                                            <option value={{ $item->id }}> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('pekerjaan_ibu_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pendidikan Ayah</label>
                                                <div class="col-sm-9">
                                                    <select
                                                        class="form-select @error('pendidikan_ayah_id') is-invalid @enderror"
                                                        value="{{ old('pendidikan_ayah_id') }}" id=""
                                                        name="pendidikan_ayah_id">
                                                        @foreach ($pendidikan as $item)
                                                            <option value={{ $item->id }}> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('pendidikan_ayah_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                                                <div class="col-sm-9">
                                                    <select
                                                        class="form-select @error('pendidikan_ibu_id') is-invalid @enderror"
                                                        value="{{ old('pendidikan_ibu_id') }}" id=""
                                                        name="pendidikan_ibu_id">
                                                        @foreach ($pendidikan as $item)
                                                            <option value={{ $item->id }}> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('pendidikan_ibu_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tahun Kelahiran Ayah</label>
                                                <div class="col-sm-9">
                                                    <input
                                                        class="form-control @error('tahun_lahir_ayah') is-invalid @enderror"
                                                        value="{{ old('tahun_lahir_ayah') }}" placeholder="example: 1999"
                                                        type="text" id="" name="tahun_lahir_ayah" />
                                                </div>
                                                @error('tahun_lahir_ayah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tahun Kelahiran Ibu</label>
                                                <div class="col-sm-9">
                                                    <input
                                                        class="form-control @error('tahun_lahir_ibu') is-invalid @enderror"
                                                        value="{{ old('tahun_lahir_ibu') }}" placeholder="example: 1999"
                                                        type="text" id="" name="tahun_lahir_ibu" />
                                                </div>
                                                @error('tahun_lahir_ibu')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Penghasilan Orangtua</label>
                                                <div class="col-sm-9">
                                                    <select
                                                        class="form-select @error('penghasilan_orang_tua_id') is-invalid @enderror"
                                                        value="{{ old('penghasilan_orang_tua_id') }}" id=""
                                                        name="penghasilan_orang_tua_id">
                                                        @foreach ($penghasilan as $item)
                                                            <option value={{ $item->id }}> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('penghasilan_orang_tua_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="font-bold">Data Wali Siswa</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Wali</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('nama_wali') is-invalid @enderror"
                                                        value="{{ old('nama_wali') }}" id="nama_wali"
                                                        name="nama_wali" />
                                                </div>
                                                @error('nama_wali')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pekerjaan Wali</label>
                                                <div class="col-sm-9">
                                                    <select
                                                        class="form-select @error('pekerjaan_wali_id') is-invalid @enderror"
                                                        value="{{ old('pekerjaan_wali_id') }}" id=""
                                                        name="pekerjaan_wali_id">
                                                        @foreach ($pekerjaan as $item)
                                                            <option value={{ $item->id }}> {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('pekerjaan_wali_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nomor Telepon Wali</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('nomor_wali') is-invalid @enderror"
                                                        value="{{ old('nomor_wali') }}" id=""
                                                        name="nomor_wali" />
                                                </div>
                                                @error('nomor_wali')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    <h4 class="font-bold"> Alamat Lengkap </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Provinsi</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('telepon') is-invalid @enderror"
                                                        id="" name="telepon" />
                                                </div>
                                                @error('telepon')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="" name="email" value="{{ $defaultEmail }}" />
                                                </div>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kecamatan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        id="alamat" name="alamat" value="{{ old('alamat') }}" />
                                                </div>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kelurahan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="font-bold"> Berkas Persyaratan </h4>

                                    @foreach ($listBerkas as $berkas)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{ $berkas->nama_berkas }}
                                                        @if ($berkas->wajib == 1)
                                                            <label class="badge badge-danger">Wajib</label>
                                                        @else
                                                            <label class="badge badge-info">Opsional</label>
                                                        @endif
                                                    </label>
                                                    <div class="input-group col-xs-12">
                                                        @if ($berkas->file_path)
                                                            <input type="text" class="form-control"
                                                                value="{{ $berkas->file_path }}" disabled>
                                                        @else
                                                            <input type="file" id=""
                                                                name="file_berkas_{{ $berkas->id }}"
                                                                class="form-control file-upload-default custom-file-input">
                                                            <input type="text"
                                                                class="form-control file-upload-info file-input-value"
                                                                disabled placeholder="Upload File">
                                                            <span class="input-group-append">
                                                                <button
                                                                    class="file-upload-browse btn btn-gradient-primary btn-upload py-3"
                                                                    type="button">Upload</button>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="row">
                                        <div class="col-md-12 d-grid gap-2 text-end">
                                            <button class="btn btn-gradient-primary btn-lg w-full">DAFTAR</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                {{-- ===============================
                                SISWA BELUM BAYAR
                            ================================ --}}
                                <div class="alert alert-warning d-flex flex-column gap-2">
                                    <h5 class="fw-bold mb-1">⚠️ Akses Dibatasi</h5>

                                    <p class="mb-1">
                                        Untuk melanjutkan pengisian formulir pendaftaran, silakan selesaikan
                                        <strong>Pembayaran Formulir</strong> terlebih dahulu.
                                    </p>

                                    <div>
                                        <a href="{{ route('pembayaranSiswa') }}" class="btn btn-primary btn-sm">
                                            💳 Bayar disini
                                        </a>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        var uploadButtons = document.querySelectorAll('.btn-upload');

        // Attach click event listeners to each button
        uploadButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Find the associated file input
                var fileInput = this.closest('.input-group').querySelector('.custom-file-input');
                // Trigger click on the file input
                if (fileInput) {
                    fileInput.click();
                }
            });
        });

        // Update file input label when a file is selected
        var fileInputs = document.querySelectorAll('.custom-file-input');
        fileInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                var fileName = this.files[0].name;
                var label = this.nextElementSibling; // Assuming label follows input
                if (label) {
                    label.value = fileName;
                }
            });
        });

        function updateRangeTinggi(value) {
            document.getElementById('rangeValue').innerText = value;
        }

        // Inisialisasi nilai awal
        document.addEventListener('DOMContentLoaded', (event) => {
            updateRangeValue(document.getElementById('customRange3').value);
        });

        function updateRangeBerat(value) {
            document.getElementById('rangeValue2').innerText = value;
        }

        // Inisialisasi nilai awal
        document.addEventListener('DOMContentLoaded', (event) => {
            updateRangeValue(document.getElementById('customRange2').value);
        });

        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll(
                'input[id^="nik"], input[id^="nama_lengkap"], input[id^="nama_panggilan"], input[id^="tanggal_lahir"],input[id^="tempat_lahir"], input[id^="umur"], input[id^="id_agama"], input[id^="jenis_kelamin"], input[id^="alamat"], input[id^="telepon"], input[id^="email"], input[id^="tinggi_badan"], input[id^="berat_badan"], input[id^="anak_ke"], input[id^="status_dalam_keluarga"], input[id^="nama_ayah"], input[id^="tahun_lahir_ayah"], input[id^="pekerjaan_ayah_id"], input[id^="pendidikan_ayah_id"], input[id^="nama_ibu"], input[id^="tahun_lahir_ibu"], input[id^="pekerjaan_ibu_id"], input[id^="pendidikan_ibu_id"], input[id^="penghasilan_orang_tua_id"], input[id^="nama_wali"], input[id^="nomor_wali"], input[id^="pekerjaan_wali_id"]'
            );

            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            });
        });
    </script>

@endsection
