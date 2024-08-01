<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeModalLabel">Buat Tahun Ajaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changeForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <div class="input-group">
                            <input id="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" value="{{ old('current_password') }}" required autofocus
                                placeholder="Password Lama">
                            <span class="input-group-text"
                                onclick="togglePassword('current_password', 'toggleCurrentPasswordIcon')">
                                <i id="toggleCurrentPasswordIcon" class="mdi mdi-eye"></i>
                            </span>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <div class="input-group">
                            <input id="new_password" type="password"
                                class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                value="{{ old('new_password') }}" required autofocus placeholder="Password Baru">

                            <span class="input-group-text"
                                onclick="togglePassword('new_password', 'toggleNewPasswordIcon')">
                                <i id="toggleNewPasswordIcon" class="mdi mdi-eye"></i>
                            </span>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password</label>
                        <div class="input-group">
                            <input id="new_password_confirmation" type="password"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required
                                autofocus placeholder="Password Baru">
                            <span class="input-group-text"
                                onclick="togglePassword('new_password_confirmation', 'toggleConfirmPasswordIcon')">
                                <i id="toggleConfirmPasswordIcon" class="mdi mdi-eye"></i>
                            </span>
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitChangeButton" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
        // Handle edit button click
        document.querySelectorAll('.btn-change').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');


                // Set form action
                const form = document.getElementById('changeForm');
                form.action = `change-password/${id}`;

                // Show the modal
                $('#changeModal').modal('show');
            });
        });

        // Handle form submission
        document.getElementById('submitChangeButton').addEventListener('click', function() {
            document.getElementById('changeForm').submit();
        });

    })
</script>
