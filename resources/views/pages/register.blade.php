@extends('auth')

@section('title', 'Daftar Akun ')

@section('main')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0" style="background: #f4f7ff;">
            <div class="row w-100 mx-0">
                <div class="col-lg-5 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5 shadow-lg" style="border-radius: 20px; background: #ffffff;">

                        <div class="brand-logo text-center mb-4">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 70px; margin-bottom: 15px;">
                            <h3 class="font-weight-bold mb-1" style="color: #333;">REGISTRASI AKUN</h3>
                            <p class="text-muted font-weight-light">Silahkan lengkapi data untuk pendaftaran</p>
                        </div>

                        <form class="pt-3" action="{{ route('registerSiswa') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark ml-1">NIK Calon Siswa</label>
                                <input type="text" class="form-control form-control-lg border-light @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" id="username" name="username"
                                    placeholder="Masukkan 16 digit NIK" style="border-radius: 12px; background: #f8f9fa;">
                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark ml-1">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg border-light @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" id="name" name="name"
                                    placeholder="Nama sesuai ijazah" style="border-radius: 12px; background: #f8f9fa;">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark ml-1">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg border-light @error('email') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="nama@email.com" style="border-radius: 12px; background: #f8f9fa;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark ml-1">Nomor Whatsapp Aktif</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="form-control form-control-lg border-light @error('phone') is-invalid @enderror"
                                    id="phone" placeholder="081234567890" style="border-radius: 12px; background: #f8f9fa;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark ml-1">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg border-light @error('password') is-invalid @enderror"
                                        id="password" placeholder="Minimal 8 karakter" style="border-radius: 12px 0 0 12px; background: #f8f9fa;">
                                    <span class="input-group-text bg-light border-light" style="border-radius: 0 12px 12px 0; cursor: pointer;"
                                        onclick="togglePassword('password', 'togglePasswordIcon')">
                                        <i class="mdi mdi-eye-outline text-muted" id="togglePasswordIcon"></i>
                                    </span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="small font-weight-bold text-dark ml-1">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" name="konfirmasi"
                                        class="form-control form-control-lg border-light @error('konfirmasi') is-invalid @enderror"
                                        id="konfirmasi" placeholder="Ulangi password" style="border-radius: 12px 0 0 12px; background: #f8f9fa;">
                                    <span class="input-group-text bg-light border-light" style="border-radius: 0 12px 12px 0; cursor: pointer;"
                                        onclick="togglePassword('konfirmasi', 'toggleKonfirmasiIcon')">
                                        <i class="mdi mdi-eye-outline text-muted" id="toggleKonfirmasiIcon"></i>
                                    </span>
                                    @error('konfirmasi')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3 d-grid gap-2">
                                <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn shadow-sm"
                                    type="submit" style="border-radius: 12px; height: 55px; letter-spacing: 1px;">
                                    DAFTAR SEKARANG
                                </button>
                            </div>

                            <div class="text-center mt-4 font-weight-light">
                                Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-weight-bold">Masuk di sini</a>
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
        function togglePassword(fieldId, iconId) {
            var passwordField = document.getElementById(fieldId);
            var toggleIcon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("mdi-eye");
                toggleIcon.classList.add("mdi-eye-off");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("mdi-eye-off");
                toggleIcon.classList.add("mdi-eye");
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll(
                'input[id^="username"], input[id^="name"]'
            );

            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            });
        });
    </script>

@endsection
