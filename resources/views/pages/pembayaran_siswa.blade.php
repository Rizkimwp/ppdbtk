@extends('index')

@section('title', 'Pembayaran')

@section('content')
    <div class="content-wrapper">
        {{-- HEADER --}}
        <div class="page-header mb-4">
            <h3 class="page-title d-flex align-items-center">
                <span class="page-title-icon bg-gradient-primary me-2 text-white">
                    <i class="mdi mdi-contactless-payment"></i>
                </span>
                Pembayaran
            </h3>
        </div>

        <div class="row g-4">
            @if (is_null($tahunAjaran) || is_null($gelombang))
                {{-- TAHUN AJARAN TIDAK AKTIF --}}
                {{-- ANIMASI LOTTIE --}}
                <div class="col-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-5 text-center">

                            <div id="lottie-animation" style="width: 280px; height: 280px;"></div>

                            <h4 class="fw-semibold mt-4">
                                Belum Ada Tahun Ajaran / Gelombang Yang Aktif
                            </h4>

                            <p class="text-muted mb-0 mt-2">
                                Silakan hubungi admin atau tunggu pengumuman pembukaan PPDB.
                            </p>

                        </div>
                    </div>
                </div>
            @else
                {{-- INFO REKENING --}}
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/dana.png') }}" class="img-fluid mb-3" width="150">

                            <hr>

                            <p class="fw-bold fs-5 mb-1">0878-7497-9361</p>
                            <small class="text-muted">An. <strong>Heryani</strong></small>
                        </div>
                    </div>
                </div>

                {{-- FORM PEMBAYARAN --}}
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="show collapse" id="collapseExample">
                                <div class="row g-3">

                                    @if (!is_null($pembayaran))
                                        @if ($pembayaran->status === 'gagal')
                                            {{-- Jika pembayaran gagal, tampilkan form upload ulang --}}
                                            @include('components.berkas-upload', [
                                                'pembayaran' => $pembayaran,
                                                'gelombang' => $gelombang,
                                            ])
                                        @else
                                            <div class="col-md-6">
                                                <table class="table-sm table">
                                                    <tr>
                                                        <td class="fw-bold">Jenis</td>
                                                        <td>Pendaftaran</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Jumlah</td>
                                                        <td>{{ number_format($gelombang->registration_fee, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Status</td>
                                                        <td>
                                                            @if ($pembayaran->status === 'lunas')
                                                                <span class="badge bg-success">LUNAS</span>
                                                            @elseif ($pembayaran->status === 'pending')
                                                                <span class="badge bg-warning">MENUNGGU VALIDASI</span>
                                                            @else
                                                                <span class="badge bg-secondary">BELUM LUNAS</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>

                                                <p class="text-muted small">
                                                    Bukti pembayaran sudah diupload.
                                                    @if ($pembayaran->status === 'pending')
                                                        Menunggu validasi admin.
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="col-md-6 d-flex align-items-center">
                                                <button class="btn btn-secondary w-100" disabled>
                                                    Bukti Pembayaran Sudah Diupload
                                                </button>
                                            </div>
                                        @endif
                                    @else
                                        {{-- Belum ada pembayaran, tampilkan form upload --}}
                                        @include('components.upload-pembayaran', ['gelombang' => $gelombang])
                                    @endif


                                    {{-- ALERT SESSION --}}
                                    <div class="col-12">
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
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
