@extends('index')

@section('title', 'Gelombang')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-calendar-star"></i>
                </span> Gelombang
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-10 mb-3 mb-md-0">
                                <form action="{{ route('gelombang.index') }}" method="GET" id="filterForm">
                                    <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select form-select-sm">
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $tahunAjaranId == $item->id ? 'selected' : '' }}>
                                                {{ $item->tahun_ajaran }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-12 col-md-2 text-center">
                                @component('components.create-button', [
                                    'type' => 'button',
                                    'color' => 'success',
                                    'icon' => 'file-check',
                                    'toggle' => 'modal',
                                    'target' => '#createModal',
                                ])
                                    BUAT GELOMBANG
                                @endcomponent
                            </div>
                        </div>
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
                                        <th>Gelombang</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tahunAjaranId)
                                        @if (!empty($gelombangs) && $gelombangs->count())
                                            @foreach ($gelombangs as $gelombang)
                                                <tr>
                                                    <td>{{ $gelombang->name}}</td>
                                                    <td>{{ $gelombang->start_date }}</td>
                                                    <td>{{ $gelombang->end_date }}</td>
                                                    <td>
                                                        @if ($gelombang->status === 'open')
                                                            <label class="badge badge-success">Buka</label>
                                                        @elseif($gelombang->status === 'close')
                                                            <label class="badge badge-danger">Tutup</label>
                                                            @else
                                                            <label class="badge badge-info ">Kuota Full</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @component('components.dropdown', [
                                                            'editModal' => '#editModal',
                                                            'deleteModal' => '#deleteModal',

                                                            'id' => $gelombang->id,
                                                            'tahun_ajaran_id' => $gelombang->tahun_ajaran_id,
                                                            'name' => $gelombang->name,
                                                            'start_date' => $gelombang->start_date,
                                                            'end_date' => $gelombang->end_date,
                                                            'quota' => $gelombang->quota,
                                                            'registration_fee' => $gelombang->registration_fee,
                                                            'status' => $gelombang->status,
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

    @include('components.modal.create-gelombang')
    <!-- Edit Modal -->
    @include('components.modal.edit-gelombang')
    @include('components.modal.delete-gelombang')


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
