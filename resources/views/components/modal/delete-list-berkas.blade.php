<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Tahun Ajaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus berkas <span id="nama"></span> ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="submitDelete" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button click
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                // Set form action
                let urlTemplate = "{{ route('list-berkas.destroy', ':id') }}";
                let url = urlTemplate.replace(':id', id);
                const form = document.getElementById('deleteForm');
                form.action = url;

                // Fill form inputs
                document.getElementById('nama').textContent = nama;

                // Show the modal
                $('#deleteModal').modal('show');
            });
        });

        // Handle form submission
        document.getElementById('submitDelete').addEventListener('click', function() {
            document.getElementById('deleteForm').submit();
        });

    })
</script>
