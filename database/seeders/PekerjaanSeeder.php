<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $pekerjaan = [
            '2D/3D Artist',
            'Akuntan',
            'Android Developer',
            'Anggota BPK',
            'Anggota DPD',
            'Anggota DPR-RI',
            'Anggota DPRD Kabupaten/Kota',
            'Anggota DPRD Provinsi',
            'Anggota Kabinet/Kementerian',
            'Anggota Mahkamah Konstitusi',
            'Apoteker',
            'Arsitek',
            'Back-End Developer',
            'Belum/Tidak Bekerja',
            'Biarawati',
            'Bidan',
            'Bupati',
            'Buruh Harian Lepas',
            'Buruh Nelayan/Perikanan',
            'Buruh Peternakan',
            'Buruh Tani/Perkebunan',
            'Chief Accountant Officers (CAO)',
            'Chief Executive Officers (CEO)',
            'Chief Financial Officers (CFO)',
            'Chief Information Officers (CIO)',
            'Chief Marketing Officers (CMO)',
            'Chief Operating Officers (COO)',
            'Chief Product Officer (CPO)',
            'Chief Technical Officers (CTO)',
            'Cloud Engineer',
            'Data Analyst',
            'Data Engineer',
            'Data Scientist',
            'Database Administration',
            'DevOps',
            'Dokter',
            'Dosen',
            'Duta Besar',
            'Front-End Developer',
            'Full-Stack Developer',
            'Game Designer',
            'Game Developer',
            'Game Tester',
            'Gubernur',
            'Guru',
            'Hardware Engineer',
            'Imam Mesjid',
            'Industri',
            'Juru Masak',
            'Karyawan BUMD',
            'Karyawan BUMN',
            'Karyawan Honorer',
            'Karyawan Swasta',
            'Kepala Desa',
            'Kepolisian RI',
            'Konstruksi',
            'Konsultan',
            'Lainnya',
            'Mekanik',
            'Mengurus Rumah Tangga',
            'Mobile Apps Developer',
            'Nelayan/Perikanan',
            'Network Engineer',
            'Notaris',
            'Paraji',
            'Paranormal',
            'Pastor',
            'Pedagang',
            'Pegawai Negeri Sipil',
            'Pekerja Lepas / Freelance',
            'Pelajar/Mahasiswa',
            'Pelaut',
            'Pembantu Rumah Tangga',
            'Penata Busana',
            'Penata Rambut',
            'Penata Rias',
            'Pendeta',
            'Peneliti',
            'Pengacara',
            'Pensiunan',
            'Penterjemah',
            'Penyiar Radio',
            'Penyiar Televisi',
            'Perancang Busana',
            'Perangkat Desa',
            'Perawat',
            'Perdagangan',
            'Petani/Pekebun',
            'Peternak',
            'Pialang',
            'Pilot',
            'Programmer',
            'Promotor Acara',
            'Psikiater/Psikolog',
            'Quality Assurance (QA)',
            'Security Engineer',
            'Seniman',
            'Site Reliability Engineer (SRE)',
            'Software Engineer',
            'Sopir',
            'System Analyst',
            'Tabib',
            'Tentara Nasional Indonesia',
            'Transportasi',
            'Tukang Batu',
            'Tukang Cukur',
            'Tukang Gigi',
            'Tukang Jahit',
            'Tukang Kayu',
            'Tukang Las/Pandai Besi',
            'Tukang Listrik',
            'Tukang Sol Sepatu',
            'UI/UX Designer',
            'Ustadz/Mubaligh',
            'Wakil Gubernur',
            'Wakil Presiden',
            'Walikota',
            'Wartawan',
            'Web Designer',
            'Web Developer',
            'Web Engineer',
            'Web Programmer',
            'Wiraswasta',
            'Wirausaha/Entrepreneur/Founder',
        ];
        foreach ($pekerjaan as $job) {
            DB::table('pekerjaan')->insert([
                'nama' => $job,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}