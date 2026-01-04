@extends('index')

@section('title', 'Pembayaran')

@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-contactless-payment"></i>
                </span> Pembayaran
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
                            <div class="col-md-12">
                                <form action="{{ route('pembayaran.index') }}" method="GET">
                                    <div class="row g-2 align-items-end">

                                        {{-- FILTER TAHUN --}}
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Tahun</label>
                                            <select name="tahun" class="form-select">
                                                <option value="">Semua Tahun</option>
                                                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                                        {{ $y }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        {{-- FILTER BULAN --}}
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Bulan</label>
                                            <select name="bulan" class="form-select">
                                                <option value="">Semua Bulan</option>
                                                @for ($m = 1; $m <= 12; $m++)
                                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        {{-- CARI NAMA --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Nama Siswa</label>
                                            <input
                                                type="text"
                                                name="nama"
                                                class="form-control"
                                                placeholder="Cari nama siswa"
                                                value="{{ request('nama') }}"
                                            >
                                        </div>

                                        {{-- BUTTON --}}
                                        <div class="col-md-2 d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-magnify"></i> Cari
                                            </button>
                                        </div>

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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Nomor Telepon</th>
                                        <th>Status Pembayaran</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$pembayaran->isEmpty())
                                        @foreach ($pembayaran as $item)
                                            <tr>
                                                <td>{{ $item->pendaftaran->user->name }}</td>
                                                <td>{{ $item->pendaftaran->user->phone }}</td>
                                                <td>
                                                    @if ($item->status === 'lunas')
                                                        <label class="badge badge-success">LUNAS</label>
                                                    @elseif ($item->status === 'belum_lunas')
                                                        <label class="badge badge-info">BELUM LUNAS</label>
                                                    @elseif ($item->status === 'pending')
                                                        <label class="badge badge-warning">MENUNGGU VALIDASI</label>
                                                    @else
                                                        <label class="badge badge-danger">TIDAK VALID</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status === 'lunas')
                                                    <a href={{ $item->file_path }} class="btn btn-info btn-sm"  target="_blank"> <i
                                                        class="mdi mdi-eye"></i>LIHAT</a>
                                                    @else
                                                        <button
                                                            type="button"
                                                            class="btn btn-warning btn-sm btn-cek"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#cekModal"
                                                            data-metode="{{ $item->payment_method }}"
                                                            data-id="{{ $item->id }}"
                                                            data-file="{{ $item->file_path }}"
                                                            data-nama="{{ $item->pendaftaran->user->name }}"
                                                        >
                                                            <i class="mdi mdi-eye btn-icon-prepend"></i>
                                                            CEK PEMBAYARAN
                                                        </button>
                                                    @endif
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

                                    {{ $pembayaran->links() }} <!-- Menampilkan tautan pagination -->
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

    @include('components.modal.cek-pembayaran')
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
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.remove();
            });
        }, 2000);

        document.getElementById('tahun_ajaran_id').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
@endsection
