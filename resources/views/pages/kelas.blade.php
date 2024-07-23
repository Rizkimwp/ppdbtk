@extends('index');

@section('title', 'List User')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-human"></i>
                </span> List Kelas
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
                            'target' => '#createKelasModal',
                        ])
                            TAMBAH KELAS
                        @endcomponent
                    </div>
                </div>

            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Kelas</th>
                                    <th>Limit Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$kelas->isEmpty())
                                    @foreach ($kelas as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->limit }}</td>
                                            <td>
                                                @component('components.dropdown-kelas', [
                                                    'editModal' => '#editModal',
                                                    'deleteModal' => '#deleteModal',
                                                    'id' => $item->id,
                                                    'nama' => $item->nama,
                                                    'limit' => $item->limit,
                                                ])
                                                @endcomponent
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" align="center">
                                            <div id="lottie-animation" style="width: 200px; height: 200px;"></div>
                                            <p>Data Tidak Ditemukan</p>
                                        </td>
                                    </tr>
                                @endif

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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('components.modal.create-kelas')
    @include('components.modal.edit-kelas')
    @include('components.modal.delete-kelas')
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
@endsection
