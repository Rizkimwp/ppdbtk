<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Tahun Ajaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing tahun ajaran -->
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_tahun_ajaran">Tahun Ajaran</label>
                            <input id="edit_tahun_ajaran" type="text"
                                class="form-control @error('edit_tahun_ajaran') is-invalid @enderror"
                                name="edit_tahun_ajaran" required autofocus>
                            @error('edit_tahun_ajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-select form-select-md @error('edit_status') is-invalid @enderror"
                                id="edit_status" name="edit_status" required>
                                <option value="">Pilih status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>


                            </select>
                            @error('edit_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('edit_mulai') is-invalid @enderror"
                                id="edit_mulai" name="edit_mulai" required>
                            @error('edit_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('edit_selesai') is-invalid @enderror"
                                id="edit_selesai" name="edit_selesai" required>
                            @error('edit_selesai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitEditButton">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button click
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const status = this.getAttribute('data-status');
                const mulai = this.getAttribute('data-mulai');
                const selesai = this.getAttribute('data-selesai');


                // Set form action
                const form = document.getElementById('editForm');
                form.action = `/tahun-ajaran/${id}`;

                // Fill form inputs
                document.getElementById('edit_tahun_ajaran').value = nama;
                document.getElementById('edit_status').value = status;
                document.getElementById('edit_mulai').value = mulai;
                document.getElementById('edit_selesai').value = selesai;

                // Show the modal
                $('#editModal').modal('show');
            });
        });

        // Handle form submission
        document.getElementById('submitEditButton').addEventListener('click', function() {
            document.getElementById('editForm').submit();
        });

    })
</script>
