<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Kelas</h5>
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
                            <label for="edit_nama">Nama Kelas</label>
                            <input id="edit_nama" type="text"
                                class="form-control @error('edit_nama') is-invalid @enderror" name="edit_nama" required
                                autofocus>
                            @error('edit_nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit_limit">Limit Kelas</label>
                            <input id="edit_limit" type="text"
                                class="form-control @error('edit_limit') is-invalid @enderror" name="edit_limit"
                                required autofocus>
                            @error('edit_limit')
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
                const limit = this.getAttribute('data-limit');



                // Set form action
                const form = document.getElementById('editForm');
                form.action = `/kelas/${id}`;

                // Fill form inputs
                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_limit').value = limit;


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
