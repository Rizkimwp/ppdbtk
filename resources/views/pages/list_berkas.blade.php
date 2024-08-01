@extends('index')

@section('title', 'Persyaratan Berkas')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-calendar-refresh"></i>
                </span> Persyaratan Berkas
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
                            'target' => '#createTahunAjaranModal',
                        ])
                            TAMBAH PERSYARATAN BERKAS
                        @endcomponent
                    </div>
                </div>

            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                        <th>Ketetapan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$items->isEmpty())
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->nama_berkas }}</td>
                                                <td>
                                                    @if ($item->aktif == 1)
                                                        <label class="badge badge-success">Aktif</label>
                                                    @else
                                                        <label class="badge badge-danger">Tidak Aktif</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->wajib == 1)
                                                        <label class="badge badge-danger">Wajib</label>
                                                    @else
                                                        <label class="badge badge-info">Opsional</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @component('components.dropdown-list', [
                                                        'editModal' => '#editModal',
                                                        'deleteModal' => '#deleteModal',
                                                        'id' => $item->id,
                                                        'nama' => $item->nama_berkas,
                                                        'status' => $item->status,
                                                        'wajib' => $item->wajib,
                                                    ])
                                                        Aksi
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

    </div>

    @include('components.modal.create-list-berkas')
    @include('components.modal.edit-list-berkas')
    @include('components.modal.delete-list-berkas')

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
    </script>

@endsection
