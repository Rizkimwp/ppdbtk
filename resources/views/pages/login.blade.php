@extends('auth')

@section('title', 'Masuk - Login')

@section('main')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0" style="background: #f8f9fa;">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5 shadow-sm" style="border-radius: 15px; background: #ffffff;">

                        <div class="brand-logo text-center mb-4">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 80px; margin-bottom: 15px;">
                            <h3 class="font-weight-bold mb-1">PENERIMAAN SISWA BARU</h3>
                            <p class="text-muted font-weight-light">Silahkan masuk untuk pendaftaran calon siswa</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class="pt-3" action="{{ route('loginpost') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">NIK Calon Siswa</label>
                                <input type="text" class="form-control form-control-lg border-light" name="username"
                                    id="username" required placeholder="Contoh: 3210xxxx"
                                    style="border-radius: 10px; background-color: #fcfcfc;">
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg border-light @error('password') is-invalid @enderror"
                                        required id="password" placeholder="********"
                                        style="border-radius: 10px 0 0 10px; background-color: #fcfcfc;">

                                    <span class="input-group-text bg-light border-light"
                                          style="border-radius: 0 10px 10px 0; cursor: pointer;"
                                          onclick="togglePassword('password', 'togglePasswordIcon')">
                                        <i class="mdi mdi-eye-outline text-muted" id="togglePasswordIcon"></i>
                                    </span>
                                </div>

                                @error('password')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror

                                @if (session('error'))
                                    <div class="alert alert-danger mt-3 border-0 py-2 small" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 d-grid gap-2">
                                <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn shadow-sm"
                                    type="submit" style="border-radius: 10px; height: 50px;">
                                    MASUK SEKARANG
                                </button>
                            </div>

                            <div class="mt-4 text-center">
                                <p class="font-weight-light mb-0">
                                    Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-weight-bold">Daftar Disini</a>
                                </p>
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("mdi-eye");
                icon.classList.add("mdi-eye-off");
            } else {
                input.type = "password";
                icon.classList.remove("mdi-eye-off");
                icon.classList.add("mdi-eye");
            }
        }

        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.remove();
            });
        }, 2000);
    </script>
@endsection
