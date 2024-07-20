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
                <form action="{{ route('list-berkas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_berkas">Persyaratan</label>
                        <input id="nama_berkas" type="text"
                            class="form-control @error('nama_berkas') is-invalid @enderror" name="nama_berkas"
                            value="{{ old('nama_berkas') }}" required autofocus>

                        @error('nama_berkas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="aktif">Status</label>
                        <select class="form-select form-select-md @error('aktif') is-invalid @enderror" id="aktif"
                            name="aktif" value="{{ old('aktif') }}" required>
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>


                        </select>
                        @error('aktif')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Penetapan</label>
                        <select class="form-select form-select-md @error('wajib') is-invalid @enderror" id="wajib"
                            name="wajib" value="{{ old('wajib') }}" required>
                            <option value="">Pilih Penetapan</option>
                            <option value="1">Wajib</option>
                            <option value="0">Opsional</option>
                        </select>
                        @error('wajib')
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
