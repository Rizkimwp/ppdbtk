<div class="modal fade" id="cekModal" tabindex="-1" role="dialog" aria-labelledby="cekModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cekModalLabel">Cek Pembayaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cekForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div id="alert-placeholder"></div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>JENIS PEMBAYARAN</th>
                                    <th>BUKTI PEMBAYARAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="method_pembayaran"></td>
                                    <td><a href="" class="btn btn-info btn-sm" id="file_path" target="_blank"> <i
                                                class="mdi mdi-eye"></i>LIHAT</a>
                                    </td>
                                    <td id="select">
                                        <select id="selectStatus" name="status" class="form-select">
                                            <option value="lunas">LUNAS</option>
                                            <option value="gagal">TIDAK VALID</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Baris berkas akan ditambahkan di sini oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submitEditButton" type="button" class="btn btn-primary"
                        data-bs-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button click
        document.querySelectorAll('.btn-cek').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const metode = this.getAttribute('data-metode') || 'TIDAK ADA';
                const file = this.getAttribute('data-file') || 'TIDAK ADA';


                // Set form action
                let urlTemplate = "{{ route('pembayaran.update', ':id') }}";
                let url = urlTemplate.replace(':id', id);
                const form = document.getElementById('cekForm');
                form.action = url;

                // Update method pembayaran
                document.getElementById('method_pembayaran').textContent = metode;
                document.getElementById('file_path').href = file


                // Show the modal
                $('#cekModal').modal('show');
            });
        });

        // Handle form submission
        document.getElementById('submitEditButton').addEventListener('click', function() {
            document.getElementById('cekForm').submit();
        });
    });
</script>
