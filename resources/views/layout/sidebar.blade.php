<nav class="sidebar sidebar-offcanvas" id="sidebar">
    @php
        // Mengambil peran pengguna dari session atau token
        $userRole = Auth::user()->role;
    @endphp

    <ul class="nav">
        @if ($userRole === 'admin')
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    {{-- <div class="nav-profile-image">
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div> --}}
                    <div class="nav-profile-text d-flex flex-column">
                        <!-- Display the logged-in user's name -->
                        <span class="font-weight-bold mb-2">{{ $username }}</span>
                        <!-- Display the user's role -->
                        <span class="text-secondary text-small">{{ Auth::user()->role }}</span>
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ $userRole === 'admin' ? url('/dashboard-admin') : url('/dashboard') }}">

                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <span class="menu-title">List User</span>
                    <i class="mdi mdi-human menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title">Master Registrasi</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tahun-ajaran.index') }}">Tahun Ajaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gelombang.index') }}">Gelombang</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list-berkas.index') }}">
                    <span class="menu-title">List Persyaratan</span>
                    <i class="mdi mdi-clipboard-list menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pernyataan.index') }}">
                    <span class="menu-title">List Pernyataan</span>
                    <i class="mdi mdi-clipboard-list menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false"
                    aria-controls="forms">
                    <span class="menu-title">Master Siswa</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calon-siswa.create') }}">
                                <span class="menu-title">Pendaftaran</span>
                                <i class="mdi mdi-plus-box menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calon-siswa.index') }}">
                                <span class="menu-title">Calon Siswa</span>
                                <i class="mdi mdi-human menu-icon"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pembayaran.index') }}">
                    <span class="menu-title">Pembayaran</span>
                    <i class="mdi mdi-contactless-payment menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('validasi-berkas.index') }}">
                    <span class="menu-title">Validasi Berkas</span>
                    <i class="mdi mdi-file-check menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#kelas" aria-expanded="false"
                    aria-controls="kelas">
                    <span class="menu-title">Master Kelas</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-seat menu-icon"></i>
                </a>
                <div class="collapse" id="kelas">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelas.index') }}">Ruangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ruangan.index') }}">Pembagian Kelas</a>
                        </li>
                    </ul>
                </div>
            </li>
        @else
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    {{-- <div class="nav-profile-image">
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div> --}}
                    <div class="nav-profile-text d-flex flex-column">
                        <!-- Display the logged-in user's name -->
                        <span class="font-weight-bold mb-2">{{ $username }}</span>
                        <!-- Display the user's role -->
                        @if (Auth::user()->role === 'siswa')
                            <span class="text-secondary text-small">CALON SISWA</span>
                        @else
                            <span class="text-secondary text-small">ADMIN</span>
                        @endif
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pembayaranSiswa') }}">
                    <span class="menu-title">Pembayaran</span>
                    <i class="mdi mdi-contactless-payment menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('calon-siswa.create') }}">
                    <span class="menu-title">Isi Biodata</span>
                    <i class="mdi mdi-plus-box menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
