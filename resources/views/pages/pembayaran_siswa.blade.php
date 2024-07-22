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
                        <img src="{{ asset('assets/images/BCA-512.webp') }}" alt="" class="img-fluid w-11"
                            width="150" height="80">
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <label class="fw-bold" for="">45512332</label>
                        <small><span class="fw-bold">An. Susilawati</span> </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box text-center">
                        <img src="{{ asset('assets/images/BCA-512.webp') }}" alt="" class="img-fluid w-11"
                            width="150" height="80">
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <label class="fw-bold" for="">45512332</label>
                        <small><span class="fw-bold">An. Susilawati</span> </small>
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
                                                <td class="c-green">Belum Lunas</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="fw-bold text-danger mt-2">Note: Jika sudah transfer, silahkan upload bukti
                                        transaksi
                                        untuk di cek oleh admin
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="file" id="" name="file_berkas"
                                                    class="form-control file-upload-default custom-file-input"
                                                    placeholder="Masukan Bukti Transaksi Disini">


                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="btn btn-primary w-100">Upload Bukti Transaksi</div>
                                            </div>
                                        </div>
                                    </form>
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
    </script>
@endsection
