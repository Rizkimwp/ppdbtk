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
