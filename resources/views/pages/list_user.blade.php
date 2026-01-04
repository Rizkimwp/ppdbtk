@extends('index');

@section('title', 'List User')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary me-2 text-white">
                    <i class="mdi mdi-human"></i>
                </span> List User
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
            <div class="col-12 grid-margin">

                <div class="row">
                    <div class="col-md-12 text-end">
                        @component('components.create-button', [
                            'type' => 'button',
                            'color' => 'success',
                            'icon' => 'file-check',
                            'toggle' => 'modal',
                            'target' => '#createUser',
                        ])
                            TAMBAH USER
                        @endcomponent
                    </div>
                </div>

            </div>
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('user.index') }}" method="GET">
                                    <div class="form-group">
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            value="{{ request()->input('nama') }}" placeholder="Pencarian">
                                    </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
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
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (isset($user) && $user->count() > 0)
                                <table class="table-hover table">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Hak Akses</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    {{ $item->role }}
                                                </td>
                                                <td>
                                                    @component('components.dropdown-user', [
                                                        'editModal' => '#editModal',
                                                        'changeModal' => '#changeModal',
                                                        'id' => $item->id,
                                                        'nama' => $item->name,
                                                        'username' => $item->username,
                                                        'hak' => $item->role,
                                                        'email' => $item->email,
                                                    ])
                                                    @endcomponent
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pagination justify-content-end">
                            {{ $user->links('vendor.pagination.custom') }}
                        </div> <!-- Menampilkan tautan pagination -->
                    </div>
                @else
                    <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                        <div class="text-center" id="lottie-animation" style="width: 200px; height: 200px;"></div>
                        <p>Data Tidak Ditemukan</p>
                    </div>
                    @endif

                </div>
            </div>

        </div>

    </div>
    @include('components.modal.create-user')
    @include('components.modal.edit-user')
    @include('components.modal.ganti-password')
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
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.remove();
            });
        }, 2000);

        document.getElementById('tahun_ajaran_id').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button click
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    const username = this.getAttribute('data-username');
                    const email = this.getAttribute('data-email');
                    const hak = this.getAttribute('data-hak');

                    // Set form action
                    let urlTemplate = "{{ route('user.update', ':id') }}";
                    let url = urlTemplate.replace(':id', id);
                    const form = document.getElementById('editForm');
                    form.action = url;

                    // Fill form inputs
                    document.getElementById('edit_name').value = nama;
                    document.getElementById('edit_username').value = username;
                    document.getElementById('edit_email').value = email;
                    document.getElementById('edit_role').value = role;

                    // Show the modal
                    $('#editModal').modal('show');
                });
            });

            // Handle form submission
            document.getElementById('submitEditButton').addEventListener('click', function() {
                document.getElementById('editForm').submit();
            });

        })
    </script>
@endsection
