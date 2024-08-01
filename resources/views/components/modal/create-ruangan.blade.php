<div class="modal fade" id="createRuangan" tabindex="-1" role="dialog" aria-labelledby="createRuanganLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRuanganLabel">Generate Ruangan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ruangan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <div class="form-select">
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select form-select-lg">
                                @foreach ($tahunAjaranList as $tahunAjaran)
                                    <option value="{{ $tahunAjaran->id }}"
                                        {{ $tahunAjaranId == $tahunAjaran->id ? 'selected' : '' }}>
                                        {{ $tahunAjaran->tahun_ajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @error('tahun_ajaran_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Per Kelas</label>
                        <input id="jumlah" type="text" inputmode="numeric"
                            class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                            value="{{ old('jumlah') }}" required autofocus placeholder="jumlah">
                        @error('jumlah')
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
