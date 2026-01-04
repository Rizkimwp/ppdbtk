<!-- Modal Delete Pernyataan -->
<div class="modal fade" id="deletePernyataanModal" tabindex="-1" role="dialog" aria-labelledby="deletePernyataanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePernyataanModalLabel">Hapus Pernyataan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pernyataan <strong><span id="namaPernyataan"></span></strong> ?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deletePernyataanForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete button click
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const judul = this.getAttribute('data-judul');

            // Set form action
            let urlTemplate = "{{ route('pernyataan.destroy', ':id') }}";
            let url = urlTemplate.replace(':id', id);
            const form = document.getElementById('deletePernyataanForm');
            form.action = url

            // Set the name inside modal
            document.getElementById('namaPernyataan').textContent = judul;

            // Show the modal
            $('#deletePernyataanModal').modal('show');
        });
    });
});
</script>
