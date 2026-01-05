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

                @if ($siswa->berkas->contains('status', 'PERIKSA'))
                    <div class="alert alert-warning text-center">
                        <i class="mdi mdi-alert-outline"></i> Berkas Persyaratan Sedang Diperiksa oleh Admin, Periksa
                        Notifikasi Secara Berkala.
                    </div>
                @else
                    <div class="alert alert-success text-center">
                        <i class="mdi mdi-check-outline"></i> Berkas Persyaratan Sudah Valid, Silahkan Menunggu Info Selanjutnya untuk Test & Wawancara
                        <a href="{{ route('pembayaranSiswa') }}" class="btn btn-primary"> Disini</a>
                    </div>
                @endif


            </div>
            <div class="card-body">
                <form class="form-sample" action="{{ route('calon-siswa.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h4 class="font-bold"> Data Siswa </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nik" name="nik" value="{{ $siswa->nik }}"
                                        class="form-control"disabled />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ $siswa->nama_lengkap }}" class="form-control "
                                        disabled />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Panggilan</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->nama_panggilan }}" disabled />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Umur</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control" value="{{ $siswa->umur }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control  "
                                        value="{{ $siswa->tempat_lahir }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input disabled type="date" class="form-control "
                                        value="{{ $siswa->tanggal_lahir }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <input disabled class="form-control " value="{{ $siswa->jenis_kelamin }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Anak Ke</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control  "
                                        value="{{ $siswa->anak_ke }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Dikeluarga</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->status_dalam_keluarga }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->agama->nama_agama }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="customRange3" class="col-sm-3 col-form-label">Tinggi Badan</label>
                                <div class="col-sm-9">
                                    <input disabled class="form-control "type="text" class="form-range "
                                        value="{{ $siswa->tinggi_badan }}CM">

                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="customRange2" class="col-sm-3 col-form-label">Berat Badan</label>
                                <div class="col-sm-9">
                                    <input disabled class="form-control " type="text" class="form-range "
                                        value="{{ $siswa->berat_badan }}KG">
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
                    <h4 class="font-bold"> Data Orang Tua </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Ayah</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control"
                                        value="{{ $siswa->nama_ayah }}" />
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Ibu</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->nama_ibu }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->pekerjaanAyah->nama }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->pekerjaanIbu->nama }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pendidikan Ayah</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->pendidikanAyah->nama }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->pendidikanIbu->nama }}" />
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tahun Kelahiran Ayah</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->tahun_lahir_ayah }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tahun Kelahiran Ibu</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->tahun_lahir_ibu }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Penghasilan Orangtua</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->penghasilanOrangTua->nama }}" />
                                </div>

                            </div>
                        </div>
                    </div>

                    <h4 class="font-bold">Data Wali Siswa</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Wali</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control"
                                        value="{{ $siswa->nama_wali }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pekerjaan Wali</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control"
                                        value="{{ $siswa->pekerjaanWali->nama }}" />
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Telepon Wali</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->nomor_wali }}" />
                                </div>

                            </div>
                        </div>


                    </div>
                    <h4 class="font-bold"> Alamat Lengkap </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->telepon }}" />
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->email }}" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control "
                                        value="{{ $siswa->alamat }}" />
                                </div>

                            </div>
                        </div>
                    </div>

                    <h4 class="font-bold"> Berkas Persyaratan </h4>

                    @foreach ($siswa->berkas as $item)
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <a class="btn btn-primary btn-lg" target="_blank"
                                        href="/{{ $item->file_path }}">{{ $item->listBerkas->nama_berkas }}</a>

                                </div>
                            </div>
                        </div>
                    @endforeach


                </form>
            </div>
        </div>
    </div>
</div>
