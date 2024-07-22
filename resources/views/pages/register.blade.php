@extends('auth')

@section('title', 'Daftar Akun ')

@section('main')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <h2>PENERIMAAN SISWA BARU </h2>
                                <h4>Silahkan registrasi akun untuk masuk</h4>
                            </div>
                            <form class="pt-3" action="{{ route('registerSiswa') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('username')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('username') }}" id="exampleInputUsername1" name="username"
                                        placeholder="NIK CALON SISWA">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('name')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('name') }}" id="exampleInputUsername1" name="name"
                                        placeholder="NAMA LENGKAP">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="{{ old('email   ') }}"
                                        class="form-control form-control-lg @error('email')
                                        is-invalid
                                    @enderror"
                                        id="exampleInputEmail1" placeholder="EMAIL  ">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            id="password" placeholder="PASSWORD">

                                        <span class="input-group-text"
                                            onclick="togglePassword('password', 'togglePasswordIcon')">
                                            <i class="mdi mdi-eye" id="togglePasswordIcon"></i>
                                        </span>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="konfirmasi"
                                            class="form-control form-control-lg @error('konfirmasi') is-invalid @enderror"
                                            id="konfirmasi" placeholder="KONFIRMASI PASSWORD">

                                        <span class="input-group-text"
                                            onclick="togglePassword('konfirmasi', 'toggleKonfirmasiIcon')">
                                            <i class="mdi mdi-eye" id="toggleKonfirmasiIcon"></i>
                                        </span>

                                        @error('konfirmasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mt-3 d-grid gap-2">
                                    <button
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Daftar</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Sudah punya akun? <a
                                        href="{{ route('login') }}" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
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
    </script>

@endsection
