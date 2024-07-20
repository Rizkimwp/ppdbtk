<div class="modal fade" id="createTahunAjaranModal" tabindex="-1" role="dialog"
    aria-labelledby="createTahunAjaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTahunAjaranModalLabel">Buat Tahun Ajaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tahun-ajaran.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input id="tahun_ajaran" type="text"
                            class="form-control @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran"
                            value="{{ old('tahun_ajaran') }}" required autofocus>

                        @error('tahun_ajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select form-select-md @error('status') is-invalid @enderror" id="status"
                            name="status" value="{{ old('status') }}" required>
                            <option value="">Pilih status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>


                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
