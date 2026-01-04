@extends('index')

@section('title', 'Calon Siswa')

@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary me-2 text-white">
                    <i class="mdi mdi-human"></i>
                </span> Calon Siswa
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <form action="{{ route('calon-siswa.index') }}" method="GET">
                                    <div class="form-group">
                                        <select name="tahun_ajaran_id"
                                        id="tahun_ajaran_id"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="" disabled {{ empty($tahunAjaranId) ? 'selected' : '' }}>
                                        -- Pilih Tahun Ajaran --
                                    </option>

                                    @foreach ($tahunAjaranList as $tahunAjaran)
                                        <option value="{{ $tahunAjaran->id }}"
                                            {{ (string)$tahunAjaranId === (string)$tahunAjaran->id ? 'selected' : '' }}>
                                            {{ $tahunAjaran->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>


                                    </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="{{ request()->input('nama') }}" placeholder="Pencarian">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            </form>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (isset($siswa) && $siswa->count() > 0)
                                <table class="table-hover table">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Umur</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $item)
                                            <tr>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->umur }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>
                                                    {{ $item->alamat }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#viewModal"
                                                        onclick="showSiswaDetail(
            '{{ $item->nik }}',
            '{{ $item->nama_lengkap }}',
            '{{ $item->nama_panggilan }}',
            '{{ $item->umur }}',
            '{{ $item->tempat_lahir }}',
            '{{ $item->tanggal_lahir }}',
            '{{ $item->jenis_kelamin }}',
            '{{ $item->anak_ke }}',
            '{{ $item->status_dalam_keluarga }}',
            '{{ $item->agama->nama_agama }}',
            '{{ $item->tinggi_badan }}',
            '{{ $item->berat_badan }}',
            '{{ $item->nama_ayah }}',
            '{{ $item->nama_ibu }}',
            '{{ $item->pekerjaanAyah->nama }}',
            '{{ $item->pekerjaanIbu->nama }}',
            '{{ $item->pendidikanAyah->nama }}',
            '{{ $item->pendidikanIbu->nama }}',
            '{{ $item->tahun_lahir_ayah }}',
            '{{ $item->tahun_lahir_ibu }}',
            '{{ $item->penghasilanOrangtua->nama }}',
            '{{ $item->nama_wali }}',
            '{{ $item->pekerjaanWali->nama }}',
            '{{ $item->nomor_wali }}',
            '{{ $item->telepon }}',
            '{{ $item->email }}',
            '{{ $item->alamat }}',
            '{{ $item->berkas }}',
        );">
                                                        <i class="mdi mdi-eye btn-icon-prepend"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pagination justify-content-end">
                            {{ $siswa->links('vendor.pagination.custom') }}
                        </div> <!-- Menampilkan tautan pagination -->
                    </div>
                @else
                    <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                        <div class="text-center" id="lottie-animation" style="width: 200px; height: 200px;"></div>
                        <p>Data Tidak Ditemukan</p>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    @include('components.modal.view-calon-siswa')
@endsection
@section('script')
    <script>
        const animationPath = '{{ asset('assets/animations/search.json') }}';
        const animation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg', // pilih renderer yang sesuai (svg/html/canvas)
            loop: true,
            autoplay: true,
            path: animationPath // ganti dengan path animasi Lottie Anda
        });
    </script>


@endsection
