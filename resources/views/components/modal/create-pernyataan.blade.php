<!-- Modal Create Pernyataan -->
<div class="modal fade" id="createPernyataanModal" tabindex="-1" role="dialog" aria-labelledby="createPernyataanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPernyataanModalLabel">Tambah Pernyataan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('pernyataan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea id="isi" name="isi">{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="wajib" name="wajib" value="1" checked>
                        <label class="form-check-label" for="wajib">Wajib</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="aktif" name="aktif" value="1" checked>
                        <label class="form-check-label" for="aktif">Aktif</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reset form saat modal ditutup
        $('#createPernyataanModal').on('hidden.bs.modal', function () {
            this.querySelector('form').reset();
        });
    });


</script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#isi',
    height: 300,
    menubar: false,
    plugins: 'lists link',
    toolbar: 'undo redo | bold italic | bullist numlist | link',
    branding: false
  });
</script>