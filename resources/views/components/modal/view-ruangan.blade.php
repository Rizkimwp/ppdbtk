<div class="modal fade" id="viewRuangan" tabindex="-1" role="dialog" aria-labelledby="viewRuanganLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRuanganLabel">Kelas <span id="nama_kelas"></span></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="alert-placeholder"></div>
                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>NAMA SISWA</th>
                                <th>NOMOR HP</th>
                                <th>UMUR</th>
                            </tr>
                        </thead>
                        <tbody id="berkas-container">
                            <!-- Baris berkas akan ditambahkan di sini oleh JavaScript -->
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    Done</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showKelas(kelasId, namaKelas) {
        // Menampilkan nama kelas pada modal
        const nama_kelas = document.quer
        document.getElementById('nama_kelas').textContent =
            namaKelas; // Ganti ini jika ada nama kelas yang lebih deskriptif

        // Fetch data siswa berdasarkan kelas_id
        fetch(`/siswa-by-kelas/${kelasId}`)
            .then(response => response.json())
            .then(data => {
                // Mengisi tabel dengan data siswa
                const tbody = document.getElementById('berkas-container');
                tbody.innerHTML = ''; // Kosongkan tabel sebelum mengisi

                data.forEach(siswa => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${siswa.nama_lengkap}</td>
                        <td>${siswa.telepon}</td>
                        <td>${siswa.umur} tahun</td>
                    `;
                    tbody.appendChild(tr);
                });

                // Jika tidak ada data
                if (data.length === 0) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td colspan="3" class="text-center">Tidak ada data siswa</td>`;
                    tbody.appendChild(tr);
                }
            })
            .catch(error => {
                console.error('Error fetching siswa data:', error);
                // Tampilkan pesan kesalahan jika diperlukan
                const alertPlaceholder = document.getElementById('alert-placeholder');
                alertPlaceholder.innerHTML = `<div class="alert alert-danger">Gagal memuat data siswa.</div>`;
            });
    }
</script>
