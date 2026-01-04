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
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5">

                            <div id="lottie-animation" style="width: 280px; height: 280px;"></div>

                            <h4 class="mt-4 fw-semibold">
                                Belum Ada Tahun Ajaran / Gelombang Yang Aktif
                            </h4>

                            <p class="text-muted mt-2 mb-0">
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

                                    {{-- ===============================
                                SUDAH ADA PEMBAYARAN
                            ================================ --}}
                                    @if (!is_null($pembayaran))

                                        <div class="col-md-6">
                                            <table class="table-sm table">
                                                <tr>
                                                    <td class="fw-bold">Jenis</td>
                                                    <td>Pendaftaran</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Jumlah</td>
                                                    <td>Rp 200.000</td>
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

                                        {{-- ===============================
                                BELUM ADA PEMBAYARAN
                            ================================ --}}
                                    @else
                                        {{-- ALERT INFO --}}
                                        <div class="col-12">
                                            <div class="alert alert-info d-flex align-items-start">
                                                <i class="mdi mdi-information-outline fs-4 me-2"></i>
                                                <div>
                                                    <strong>Informasi Pembayaran</strong><br>
                                                    Biaya formulir pendaftaran sebesar
                                                    <strong>Rp 200.000</strong>.
                                                    Silakan transfer ke rekening tertera,
                                                    lalu upload bukti pembayaran sebelum melanjutkan.
                                                </div>
                                            </div>
                                        </div>

                                        {{-- FORM --}}
                                        <div class="col-12">
                                            <form action="{{ route('uploadbukti') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Jumlah Pembayaran</label>
                                                    <input type="text" id="amount_display" class="form-control"
                                                        value="Rp 200.000" readonly>

                                                    <!-- nilai asli untuk backend -->
                                                    <input type="hidden" name="amount" id="amount" value="200000">
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Upload Bukti Pembayaran</label>
                                                    <input type="file" name="file_path"
                                                        class="form-control @error('file_path') is-invalid @enderror"
                                                        required>
                                                    @error('file_path')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <button class="btn btn-primary w-100">
                                                    Upload Bukti Transaksi
                                                </button>
                                            </form>
                                        </div>

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
