@extends('auth')

@section('title', 'Masuk - Login')

@section('main')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <a href="{{ route('login') }}" class="btn btn-icon-text btn-sm">
                            <i class="mdi mdi-arrow-left-bold">Kembali</i></a>
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <h2>LOGIN SSO</h2>

                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="pt-3" action="{{ route('loginpost') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="name" id="name"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            id="password" placeholder="Password">

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
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Login</button>
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
