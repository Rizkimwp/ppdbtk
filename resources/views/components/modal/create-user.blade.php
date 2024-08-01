<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserLabel">Buat User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus placeholder="NAMA">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Userusername</label>
                        <input id="username" type="text"
                            class="form-control @error('username') is-invalid @enderror" username="username"
                            value="{{ old('username') }}" required autofocus placeholder="USERNAME">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            email="email" value="{{ old('email') }}" required autofocus placeholder="EMAIL">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Hak Akses</label>
                        <select class="form-select form-select-md @error('role') is-invalid @enderror" id="role"
                            name="role" value="{{ old('role') }}" required>
                            <option value="">Pilih status</option>
                            <option value="admin">Admin</option>


                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Password</label>
                        <div class="input-group">
                            <input type="password" name="password"
                                class="form-control form-control-md @error('password') is-invalid @enderror"
                                id="password" placeholder="PASSWORD">

                            <span class="input-group-text" onclick="togglePassword('password', 'togglePasswordIcon')">
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
                        <label for="role">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="konfirmasi"
                                class="form-control form-control-md @error('konfirmasi') is-invalid @enderror"
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
