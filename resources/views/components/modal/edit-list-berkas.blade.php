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
                            <label for="edit_nama_berkas">Nama Berkas</label>
                            <input id="edit_nama_berkas" type="text"
                                class="form-control @error('edit_nama_berkas') is-invalid @enderror"
                                name="edit_nama_berkas" required autofocus>
                            @error('edit_nama_berkas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit_aktif">Status</label>
                            <select class="form-select form-select-md @error('edit_aktif') is-invalid @enderror"
                                id="edit_aktif" name="edit_aktif" required>
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('edit_aktif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit_wajib">Penetapan</label>
                            <select class="form-select form-select-md @error('edit_wajib') is-invalid @enderror"
                                id="edit_wajib" name="edit_wajib" required>
                                <option value="">Pilih Penetapan</option>
                                <option value="1">Wajib</option>
                                <option value="0">Opsional</option>
                            </select>
                            @error('edit_wajib')
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
                const wajib = this.getAttribute('data-wajib');


                // Set form action
                let urlTemplate = "{{ route('list-berkas.update', ':id') }}";
                let url = urlTemplate.replace(':id', id);
                const form = document.getElementById('editForm');
                form.action = url;

                // Fill form inputs
                document.getElementById('edit_nama_berkas').value = nama;
                document.getElementById('edit_status').value = status;
                document.getElementById('edit_wajib').value = wajib;

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
