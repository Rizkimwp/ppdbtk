@extends('index')

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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <p class="fw-bold">Profil Sekolah</p>
                    </div>
                    <img src="assets/images/hero_5.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tk Al-Hikmah didirikan pada tanggal 16 Juli 2013 dan terletak di kecamatan
                            Jayanti, Kabupaten Tangerang, Provinsi Banten tepatnya di Kp.Jayanti Timur RT/RW.06/03 TK ini
                            diselenggarakan oleh yayasan TK Al-Hikmah Jayanti Timur dan berada dibawah tanggung jawab ibu
                            HERYANI,S.Pd.
                            Sejak awal pendiriannya, TK Al-Hikmah telah berkomitmen untuk menyediakan pendidikan dasar yang
                            berkualitas bagi anak-anak usia dini. Dengan menggunakan kurikulum 2013 (K13), sekolah ini
                            bertujuan untuk mengembangkan potensi anak-anak secara holistik, mencakup aspek akademis,
                            sosial, emosional, dan spiritual.
                            Fasilitas yang memadai dan tenaga pendidikan yang berkompeten menjadi salah satu keunggulan TK
                            Al-Hikmah. Sekolah ini tidak hanya fokus pada pencapaian akademis, tetapi juga pada pembentukan
                            karakter anak-anak melalui berbagai kegiatan ekstrakulikuler dan program pengembangan diri.
                            Dengan dukungan dari yayasan TK Al-Hikmah Jayanti Timur, sekolah ini terus berupaya meningkatkan
                            mutu pendidikan dan menjadi lembaga yang unggul dalam membentuk generasi yang cerdas, berakhlak
                            mulia, dan berwawadan luas.

                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card" style="width: 18rem;">
                    <img src="assets/images/hero_1.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Studi Tour Siswa </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card" style="width: 18rem;">
                    <img src="assets/images/hero_2.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Agenda Pelatihan Manasik Haji Tahun Pelajaran 2023-2024 .</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card" style="width: 18rem;">
                    <img src="assets/images/hero_6.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Pelepasan Siswa / Siswi Angkatan XI </p>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
