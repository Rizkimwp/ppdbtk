<div class="modal fade" id="validasiModal" tabindex="-1" role="dialog" aria-labelledby="validasiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validasiModalLabel">Validasi Berkas</h5>
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
                                <th>NAMA BERKAS</th>
                                <th>PREVIEW</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="berkas-container">
                            <!-- Baris berkas akan ditambahkan di sini oleh JavaScript -->
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="restartWindow()">
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    function validasi(berkas) {
        function displayBerkas(data) {
            const container = document.getElementById('berkas-container');
            container.innerHTML = ''; // Kosongkan container sebelum memapping data baru

            let berkasArray = [];
            try {
                berkasArray = JSON.parse(data);
            } catch (error) {
                console.error('Gagal parse data JSON:', error);
                return;
            }

            if (!Array.isArray(berkasArray)) {
                console.error('Data bukan array setelah parsing:', berkasArray);
                return;
            }

            berkasArray.forEach((berkas, index) => {
                const tr = document.createElement('tr');

                const tdNamaBerkas = document.createElement('td');
                const namaBerkas = findNamaBerkasById(window.berkasData, berkas.list_berkas_id);
                tdNamaBerkas.textContent = namaBerkas ? namaBerkas : `Berkas ${berkas.list_berkas_id}`;

                const tdValidasi = document.createElement('td');
                const button = document.createElement('button');
                button.className = 'btn btn-info';
                button.textContent = 'Lihat Berkas';
                button.onclick = function() {
                    window.open(berkas.file_path, '_blank');
                };

                tdValidasi.appendChild(button);

                const tdAksi = document.createElement('td');
                const select = document.createElement('select');
                select.className = 'form-select';
                select.innerHTML = `
                    <option value="VALID">Valid</option>
                    <option value="TIDAK_VALID">Tidak Valid</option>
                    <option value="PERIKSA">Periksa</option>
                `;
                select.value = berkas.status;
                select.onchange = function() {
                    const status = this.value;
                    axios.put(`/validasi-berkas/${berkas.id}`, {
                            status: status
                        })
                        .then(response => {
                            showAlert(`Status berkas ${namaBerkas} diperbarui menjadi ${status}`,
                                'success');
                        });

                };

                tdAksi.appendChild(select);
                tr.appendChild(tdNamaBerkas);
                tr.appendChild(tdValidasi);
                tr.appendChild(tdAksi);
                container.appendChild(tr);
            });
        }

        displayBerkas(berkas);
    }


    // Mengambil data berkas dari server
    axios.get('/findBerkas')
        .then(response => {
            const berkasData = response.data; // Data berkas dari server
            console.log(berkasData);

            // Lakukan sesuatu dengan data, misalnya menyimpannya untuk digunakan di tempat lain
            window.berkasData = berkasData; // Menyimpan data ke window untuk akses global
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

    function findNamaBerkasById(data, id) {
        const berkas = data.find(item => item.id === id);
        return berkas ? `Berkas ${berkas.nama_berkas}` : null;
    }

    function showAlert(message, type) {
        const alertPlaceholder = document.getElementById('alert-placeholder');
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.role = 'alert';
        alert.innerHTML = `
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;
        alertPlaceholder.appendChild(alert);

        // Hapus alert setelah 3 detik
        setTimeout(() => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            alert.addEventListener('transitionend', () => alert.remove());
        }, 3000);
    }

    function restartWindow() {
        // Memuat ulang halaman
        window.location.reload();
    }
</script>
