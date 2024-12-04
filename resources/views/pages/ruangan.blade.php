@extends('index');

@section('title', 'List User')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-human"></i>
                </span> Ruangan
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

                <div class="row">
                    <div class="col-md-12 text-end">
                        @component('components.create-button', [
                            'type' => 'button',
                            'color' => 'success',
                            'icon' => 'file-check',
                            'toggle' => 'modal',
                            'target' => '#createRuangan',
                        ])
                            GENERATE RUANGAN
                        @endcomponent
                    </div>

                </div>

            </div>
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-7">
                                <form action="{{ route('ruangan.index') }}" method="GET">
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
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            </form>
                            <div class="col-md-3">
                                <a href="{{ route('cetakcalonsiswa') }}" class="btn btn-primary btn-icon-text "> <i
                                        class="mdi mdi-printer btn-icon-prepend"></i>
                                    Cetak Siswa</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Jumlah Siswa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($ruangan) && !$ruangan->isEmpty())
                                        @php
                                            // Mengelompokkan data berdasarkan kelas_id dan memilih hanya satu item per kelas_id
                                            $uniqueKelas = $ruangan->unique('kelas_id');
                                        @endphp

                                        @foreach ($uniqueKelas as $item)
                                            <tr>
                                                <td>{{ $item->kelas->nama }}</td>
                                                <td>{{ $kelasCounts[$item->kelas_id] ?? 0 }} Orang</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-kelas="{{ $item->kelas->nama }}" data-bs-toggle="modal"
                                                        data-bs-target="#viewRuangan"
                                                        onclick="showKelas({{ $item->kelas_id }}, '{{ $item->kelas->nama }}')">
                                                        View
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
                </div>
            </div>

        </div>
    </div>

    @include('components.modal.create-ruangan')
    @include('components.modal.view-ruangan')

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
        // setTimeout(function() {
        //     document.querySelectorAll('.alert').forEach(function(alert) {
        //         alert.remove();
        //     });
        // }, 2000);

        document.getElementById('tahun_ajaran_id').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
    <script>
        function showKelas(kelasId, namaKelas) {
            // Menampilkan nama kelas pada modal
            const nama_kelas = document.quer
            document.getElementById('nama_kelas').textContent =
                namaKelas; // Ganti ini jika ada nama kelas yang lebih deskriptif

            // Fetch data siswa berdasarkan kelas_id
            fetch(`/siswa-by-kelas/${kelasId}`)
                .then(response => response.json())
                .then(data => {
                    // Mengisi tabel dengan data siswa
                    const tbody = document.getElementById('berkas-container');
                    tbody.innerHTML = ''; // Kosongkan tabel sebelum mengisi

                    data.forEach(siswa => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${siswa.nama_lengkap}</td>
                            <td>${siswa.telepon}</td>
                            <td>${siswa.umur} tahun</td>
                        `;
                        tbody.appendChild(tr);
                    });

                    // Jika tidak ada data
                    if (data.length === 0) {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `<td colspan="3" class="text-center">Tidak ada data siswa</td>`;
                        tbody.appendChild(tr);
                    }
                })
                .catch(error => {
                    console.error('Error fetching siswa data:', error);
                    // Tampilkan pesan kesalahan jika diperlukan
                    const alertPlaceholder = document.getElementById('alert-placeholder');
                    alertPlaceholder.innerHTML = `<div class="alert alert-danger">Gagal memuat data siswa.</div>`;
                });
        }
    </script>
@endsection
