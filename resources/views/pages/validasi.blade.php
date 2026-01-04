@extends('index')

@section('title', 'Validasi Peserta')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary me-2 text-white">
                    <i class="mdi mdi-receipt-text-check"></i>
                </span> Validasi Berkas Siswa
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
                                <form action="{{ route('validasi-berkas.index') }}" method="GET">
                                    <div class="form-group">
                                        <select name="tahun_ajaran_id" id="tahun_ajaran_id"
                                            class="form-select form-select-lg">
                                            @foreach ($tahunAjaranList as $tahunAjaran)
                                                <option value="{{ $tahunAjaran->id }}"
                                                    {{ $tahunAjaranId == $tahunAjaran->id ? 'selected' : '' }}>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-hover table">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Nama Ayah/Wali</th>
                                        <th>Nomor Telepon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($siswa) && $siswa->count())
                                        @foreach ($siswa as $item)
                                            <tr>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->nama_ayah }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                @php
                                                    $countPeriksa = 0;
                                                    $countValid = 0;
                                                    $countTidakValid = 0;

                                                    foreach ($item->berkas as $data) {
                                                        if ($data->status === 'PERIKSA') {
                                                            $countPeriksa++;
                                                        } elseif ($data->status === 'VALID') {
                                                            $countValid++;
                                                        } elseif ($data->status === 'TIDAK_VALID') {
                                                            $countTidakValid++;
                                                        }
                                                    }

                                                    if ($countTidakValid > 0) {
                                                        $overallStatus = 'TIDAK VALID';
                                                        $badgeClass = 'badge-danger';
                                                    } elseif ($countPeriksa >= $countValid) {
                                                        $overallStatus = 'PERIKSA';
                                                        $badgeClass = 'badge-warning';
                                                    } else {
                                                        $overallStatus = 'VALID';
                                                        $badgeClass = 'badge-success';
                                                    }
                                                @endphp

                                                <td>
                                                    <label class="badge {{ $badgeClass }}">{{ $overallStatus }}</label>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#validasiModal"
                                                        onclick="validasi('{{ $item->berkas }}')">
                                                        <i class="mdi mdi-file-check btn-icon-prepend"></i> Validasi
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" align="center">
                                                <div id="lottie-animation" style="width: 200px; height: 200px;"></div>
                                                <p>Data Tidak Ditemukan</p>
                                            </td>
                                        </tr>
                                    @endif


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

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pagination justify-content-end">
                            @if (method_exists($siswa, 'links'))
                                {{ $siswa->links('vendor.pagination.custom') }}
                            @endif


                        </div> <!-- Menampilkan tautan pagination -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('components.modal.validasi-berkas')
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
