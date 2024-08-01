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
            <div class="col-lg-3 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box text-center">
                        <img src="{{ asset('assets/images/dana.png') }}" alt="" class="img-fluid w-11 mb-4"
                            width="150" height="80">
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <label class="fw-bold" for="">0878-7497-9361</label>
                        <small><span class="fw-bold">An. Heryani</span> </small>
                    </div>
                </div>
            </div>




            <div class="col-12 mt-4">
                <div class="card p-3">

                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">UPLOAD BUKTI PEMBAYARAN</span>

                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">
                                @if (isset($pembayaran))
                                    <div class="col-lg-5 mb-lg-0 mb-3">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold">PEMBAYARAN</td>
                                                    <td class="c-green">Pendaftaran</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">JUMLAH</td>
                                                    <td class="c-green">Rp65.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">STATUS</td>
                                                    <td class="c-green">
                                                        @if ($pembayaran->status === 'lunas')
                                                            <label class="badge badge-success">LUNAS</label>
                                                        @elseif ($pembayaran->status === 'belum_lunas')
                                                            <label class="badge badge-info">BELUM LUNAS</label>
                                                        @elseif ($pembayaran->status === 'pending')
                                                            <label class="badge badge-warning">MENUNGGU VALIDASI</label>
                                                        @else
                                                            <label class="badge badge-danger">TIDAK VALID</label>
                                                        @endif
                                                    </td>
                                                </tr>
                                            <tbody>
                                        </table>
                                        <p class="fw-bold text-danger mt-2">Note: Jika sudah transfer, silahkan upload bukti
                                            transaksi
                                            untuk di cek oleh admin
                                        </p>
                                    </div>
                                @endif

                                <div class=" @if (isset($pembayaran)) col-lg-7 @else col-lg-12 @endif">
                                    @if (isset($pembayaran))
                                        <form action="{{ route('uploadbukti', $pembayaran->id) }}" class="form"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="file" name="file_path"
                                                        class="form-control file-upload-default custom-file-input @error('file_path') is-invalid @enderror"
                                                        placeholder="Masukan Bukti Transaksi Disini">
                                                    @error('file_path')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button class="btn btn-primary w-100"
                                                        @if ($pembayaran->status === 'lunas') disabled @endif>
                                                        Upload Bukti Transaksi
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                                            <div class="text-center" id="lottie-animation"
                                                style="width: 200px; height: 200px;"></div>
                                            <p>Belum Ada Tagihan</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
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
                </div>
            </div>

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
