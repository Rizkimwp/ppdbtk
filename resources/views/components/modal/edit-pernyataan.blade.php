<!-- Modal Edit Pernyataan -->
<div class="modal fade" id="editPernyataanModal" tabindex="-1" role="dialog" aria-labelledby="editPernyataanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPernyataanModalLabel">Edit Pernyataan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editPernyataanForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="edit_judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('edit_judul') is-invalid @enderror" id="edit_judul" name="edit_judul" required>
                        @error('edit_judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_isi" class="form-label">Isi</label>
                        <textarea class="form-control @error('edit_isi') is-invalid @enderror" id="edit_isi" name="edit_isi" rows="4" required></textarea>
                        @error('edit_isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="edit_wajib" name="edit_wajib" value="1">
                        <label class="form-check-label" for="edit_wajib">Wajib</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="edit_aktif" name="edit_aktif" value="1">
                        <label class="form-check-label" for="edit_aktif">Aktif</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // Handle edit button click
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const judul = this.getAttribute('data-judul');
            const isi = this.getAttribute('data-isi');
            const wajib = this.getAttribute('data-wajib') == 1;
            const aktif = this.getAttribute('data-aktif') == 1;

            // Set form action
            let urlTemplate = "{{ route('pernyataan.update', ':id') }}";
                let url = urlTemplate.replace(':id', id);
            const form = document.getElementById('editPernyataanForm');
            form.action = url;

            // Fill form inputs
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_isi').value = isi;
            document.getElementById('edit_wajib').checked = wajib;
            document.getElementById('edit_aktif').checked = aktif;

            // Show the modal
            $('#editPernyataanModal').modal('show');
        });
    });

});
</script>
