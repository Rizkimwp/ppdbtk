<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Gelombang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- Tahun Ajaran --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <select id="edit_tahun_ajaran_id" name="tahun_ajaran_id"
                            class="form-select" required>
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nama Gelombang --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Gelombang</label>
                        <input type="text" id="edit_name" name="name"
                            class="form-control" required>
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" id="edit_start_date" name="start_date"
                            class="form-control" required>
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" id="edit_end_date" name="end_date"
                            class="form-control" required>
                    </div>

                    {{-- Kuota --}}
                    <div class="mb-3">
                        <label class="form-label">Kuota Pendaftaran</label>
                        <input type="number" id="edit_quota" name="quota"
                            class="form-control" min="1" required>
                    </div>

                    {{-- Biaya Pendaftaran --}}
                    <div class="mb-3">
                        <label class="form-label">Biaya Pendaftaran</label>
                        <input type="text" id="edit_registration_fee" name="registration_fee"
                            class="form-control" min="0" required>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status Gelombang</label>
                        <select id="edit_status" name="status"
                            class="form-select" required>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="full">Full</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const form = document.getElementById('editForm');


    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {

            const data = this.dataset;
            const url = "{{ route('gelombang.update', ':id') }}".replace(':id', data.id);
            form.action = url;


            // isi field
            document.getElementById('edit_tahun_ajaran_id').value = data.tahunAjaranId;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_start_date').value = data.startDate;
            document.getElementById('edit_end_date').value = data.endDate;
            document.getElementById('edit_quota').value = data.quota;
            document.getElementById('edit_registration_fee').value = data.registrationFee;

            editModal.show();
        });
    });

});
</script>
@endsection
