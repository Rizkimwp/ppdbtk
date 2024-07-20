<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Gelombang</h5>
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
                            <label for="edit_mulai">Tanggal Mulai</label>
                            <input id="edit_mulai" type="date"
                                class="form-control @error('edit_mulai') is-invalid @enderror" name="edit_mulai"
                                required>
                            @error('edit_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit_selesai">Tanggal Selesai</label>
                            <input id="edit_selesai" type="date"
                                class="form-control @error('edit_selesai') is-invalid @enderror" name="edit_selesai"
                                required>
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
                const mulai = this.getAttribute('data-mulai');
                const selesai = this.getAttribute('data-selesai');


                // Set form action
                const form = document.getElementById('editForm');
                form.action = `/gelombang/${id}`;

                // Fill form inputs

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
