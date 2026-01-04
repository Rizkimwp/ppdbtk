@extends('index')

@section('title', 'Dashboard')

@section('content')

<div class="content-wrapper">
    <div class="page-header mb-4">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2 p-2 rounded shadow">
                <i class="mdi mdi-home"></i>
            </span> Dashboard PPDB
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="badge bg-light text-primary px-3 py-2 shadow-sm">
                        Overview <i class="mdi mdi-alert-circle-outline ms-1"></i>
                    </span>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info border-0 shadow-sm text-white">
                <div class="card-body p-4">
                    <h4 class="font-weight-normal mb-3">Total Pendaftar <i class="mdi mdi-account-group mdi-24px float-right"></i></h4>
                    <h2 class="mb-5">1,250</h2>
                    <h6 class="card-text">Peningkatan 5% bulan ini</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger border-0 shadow-sm text-white">
                <div class="card-body p-4">
                    <h4 class="font-weight-normal mb-3">Verifikasi Bayar <i class="mdi mdi-wallet mdi-24px float-right"></i></h4>
                    <h2 class="mb-5">45</h2>
                    <h6 class="card-text">Menunggu konfirmasi</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success border-0 shadow-sm text-white">
                <div class="card-body p-4">
                    <h4 class="font-weight-normal mb-3">Lulus Seleksi <i class="mdi mdi-checkbox-marked-circle mdi-24px float-right"></i></h4>
                    <h2 class="mb-5">320</h2>
                    <h6 class="card-text">Tahun Ajaran 2024/2025</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-warning border-0 shadow-sm text-white">
                <div class="card-body p-4">
                    <h4 class="font-weight-normal mb-3">Kuota Tersisa <i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                    <h2 class="mb-5">80</h2>
                    <h6 class="card-text">Dari total 400 kursi</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Pendaftar Terbaru</h4>
                        <a href="#" class="btn btn-sm btn-link text-primary font-weight-bold">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Nama Siswa</th>
                                    <th class="border-0">No. Pendaftaran</th>
                                    <th class="border-0">Tanggal</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-soft-primary p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background: #eef2ff;">
                                                <i class="mdi mdi-account text-primary"></i>
                                            </div>
                                            <span>Ahmad Rivai</span>
                                        </div>
                                    </td>
                                    <td>REG/2024/001</td>
                                    <td>02 Jan 2024</td>
                                    <td><label class="badge bg-warning text-dark">Menunggu Verifikasi</label></td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3">Detail</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-soft-success p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background: #ecfdf5;">
                                                <i class="mdi mdi-account text-success"></i>
                                            </div>
                                            <span>Siti Aminah</span>
                                        </div>
                                    </td>
                                    <td>REG/2024/002</td>
                                    <td>02 Jan 2024</td>
                                    <td><label class="badge bg-success">Sudah Bayar</label></td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3">Detail</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
