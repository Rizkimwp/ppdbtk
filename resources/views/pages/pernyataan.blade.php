@extends('index')

@section('title', 'Daftar Pernyataan')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-file-document-outline"></i>
            </span> Pernyataan
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
                        'icon' => 'file-plus',
                        'toggle' => 'modal',
                        'target' => '#createPernyataanModal',
                    ])
                        TAMBAH PERNYATAAN
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
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Status</th>
                                    <th>Ketetapan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$pernyataan->isEmpty())
                                    @foreach ($pernyataan as $item)
                                        <tr>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ Str::limit($item->isi, 50) }}</td>
                                            <td>
                                                @if ($item->aktif)
                                                    <label class="badge badge-success">Aktif</label>
                                                @else
                                                    <label class="badge badge-danger">Tidak Aktif</label>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->wajib)
                                                    <label class="badge badge-danger">Wajib</label>
                                                @else
                                                    <label class="badge badge-info">Opsional</label>
                                                @endif
                                            </td>
                                            <td>
                                                @component('components.dropdown-list', [
                                                    'editModal' => '#editPernyataanModal',
                                                    'deleteModal' => '#deletePernyataanModal',
                                                    'id' => $item->id,
                                                    'nama' => $item->judul,
                                                    'aktif' => $item->aktif,
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

@include('components.modal.create-pernyataan')
@include('components.modal.edit-pernyataan')
@include('components.modal.delete-pernyataan')

@endsection

@section('script')
<script>
    const animationPath = '{{ asset('assets/animations/search.json') }}';
    const animation = lottie.loadAnimation({
        container: document.getElementById('lottie-animation'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: animationPath
    });

    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.remove();
        });
    }, 2000);
</script>
@endsection
