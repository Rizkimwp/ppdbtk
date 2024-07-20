<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Gelombang</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('gelombang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select class="form-select form-select-md @error('tahun_ajaran_id') is-invalid @enderror"
                            id="tahun_ajaran_id" name="tahun_ajaran_id" required>
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gelombang">Gelombang</label>
                        <select class="form-select form-select-md @error('gelombang') is-invalid @enderror"
                            id="gelombang" name="gelombang" required>
                            <option value="">Pilih Gelombang</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>

                        </select>
                        @error('gelombang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('mulai') is-invalid @enderror" id="mulai"
                            name="mulai" required>
                        @error('mulai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('selesai') is-invalid @enderror" id="selesai"
                            name="selesai" required>
                        @error('selesai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
