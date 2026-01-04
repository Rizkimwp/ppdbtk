@extends('index')

@push('styles')
<style>
    :root {
        --primary-color: #4361ee;
        --success-color: #2ec4b6;
        --warning-color: #ff9f1c;
        --info-color: #3a86ff;
    }

    .process-wrapper {
        padding: 40px 0;
    }

    /* Step Card Styling */
    .step-item {
        position: relative;
        padding: 30px;
        border-radius: 20px;
        background: #ffffff;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        border: 1px solid #f0f0f0;
    }

    .step-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
        border-color: transparent;
    }

    /* Floating Badge Number */
    .step-badge {
        width: 35px;
        height: 35px;
        background: var(--primary-color);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
    }

    /* Icon Styling */
    .icon-gradient {
        font-size: 2.5rem;
        margin-bottom: 20px;
        display: inline-block;
        background: -webkit-linear-gradient(45deg, #333, #777);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .step-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 12px;
    }

    .step-text {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #636e72;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .step-item { margin-bottom: 20px; }
    }
</style>
@endpush
@section('title', 'Dashboard')

@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
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
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="fw-bold mb-0">Alur Pendaftaran Peserta Didik Baru (PPDB)</h5>
                    </div>
                    <div class="card-body">
                        @if ($tahunAjaran && $gelombang)
                        <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-md-4 bg-success d-flex flex-column justify-content-center align-items-center p-3 text-white">
                                        <i class="mdi mdi-check-decagram mb-2" style="font-size: 2.5rem;"></i>
                                        <span class="fw-bold text-uppercase tracking-wider">Pendaftaran Aktif</span>
                                    </div>

                                    <div class="col-md-8 p-4 bg-white">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <p class="text-muted small mb-1 text-uppercase fw-semibold">Tahun Ajaran</p>
                                                <h5 class="fw-bold mb-0 text-dark">{{ $tahunAjaran->tahun_ajaran }}</h5>
                                            </div>
                                            <div class="text-end">
                                                <p class="text-muted small mb-1 text-uppercase fw-semibold">Gelombang</p>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                    {{ $gelombang->name }}
                                                </span>
                                            </div>
                                        </div>

                                        <hr class="my-3 opacity-25">

                                        <div class="d-flex align-items-center text-muted">
                                            <i class="mdi mdi-calendar-clock me-2 fs-5 text-success"></i>
                                            <div>
                                                <span class="small d-block">Batas Waktu Pendaftaran:</span>
                                                <span class="fw-semibold text-dark">
                                                    {{ \Carbon\Carbon::parse($gelombang->start_date)->translatedFormat('d M') }}
                                                    —
                                                    {{ \Carbon\Carbon::parse($gelombang->end_date)->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="flex-shrink-0 bg-warning-subtle text-warning rounded-3 p-3">
                                    <i class="mdi mdi-alert-circle-outline fs-1"></i>
                                </div>
                                <div class="ms-4">
                                    <h5 class="fw-bold text-dark mb-1">Pendaftaran Belum Dibuka</h5>
                                    <p class="text-muted mb-0">Sistem saat ini tidak menemukan periode pendaftaran atau gelombang yang aktif.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="container process-wrapper">
                            <div class="row g-4">

                                <div class="col-lg-3 col-md-6">
                                    <div class="step-item shadow-sm">
                                        <div class="step-badge" style="background: var(--primary-color);">01</div>
                                        <i class="bi bi-person-plus icon-gradient" style="background: linear-gradient(45deg, #4361ee, #4cc9f0); -webkit-background-clip: text;"></i>
                                        <h5 class="step-title">Registrasi Akun</h5>
                                        <p class="step-text">Buat akun menggunakan Email & WhatsApp aktif untuk mendapatkan akses masuk.</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="step-item shadow-sm">
                                        <div class="step-badge" style="background: var(--success-color);">02</div>
                                        <i class="bi bi-wallet2 icon-gradient" style="background: linear-gradient(45deg, #2ec4b6, #cbf3f0); -webkit-background-clip: text;"></i>
                                        <h5 class="step-title">Biaya Formulir</h5>
                                        <p class="step-text">Lakukan pembayaran sesuai instruksi untuk mengaktifkan formulir pendaftaran.</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="step-item shadow-sm">
                                        <div class="step-badge" style="background: var(--warning-color);">03</div>
                                        <i class="bi bi-pencil-square icon-gradient" style="background: linear-gradient(45deg, #ff9f1c, #ffbf69); -webkit-background-clip: text;"></i>
                                        <h5 class="step-title">Isi Biodata</h5>
                                        <p class="step-text">Lengkapi data diri dan unggah dokumen pendukung dengan teliti dan benar.</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="step-item shadow-sm">
                                        <div class="step-badge" style="background: var(--info-color);">04</div>
                                        <i class="bi bi-megaphone icon-gradient" style="background: linear-gradient(45deg, #3a86ff, #8338ec); -webkit-background-clip: text;"></i>
                                        <h5 class="step-title">Seleksi & Test</h5>
                                        <p class="step-text">Pantau dashboard untuk jadwal test, wawancara, hingga pengumuman akhir.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="step-item shadow-sm">
                                        <div class="step-badge" style="background: var(--info-color);">05</div>
                                        <i class="bi bi-megaphone icon-gradient" style="background: linear-gradient(45deg, #3a86ff, #8338ec); -webkit-background-clip: text;"></i>
                                        <h5 class="step-title">Pengumuman Kelolosan</h5>
                                        <p class="step-text">Lihat hasil seleksi akhir dan ikuti instruksi untuk tahap selanjutnya jika dinyatakan lolos.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                Pastikan seluruh data yang diinput sudah benar sebelum dikirim.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
