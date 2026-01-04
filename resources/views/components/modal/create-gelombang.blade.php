<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Gelombang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('gelombang.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    {{-- Tahun Ajaran --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id"
                            class="form-select @error('tahun_ajaran_id') is-invalid @enderror" required>
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('tahun_ajaran_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Gelombang --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Gelombang</label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Contoh: Gelombang 1 / Early Bird"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kuota --}}
                    <div class="mb-3">
                        <label class="form-label">Kuota Pendaftaran</label>
                        <input type="number" name="quota"
                            class="form-control @error('quota') is-invalid @enderror"
                            min="1" value="{{ old('quota') }}" required>
                        @error('quota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Biaya Pendaftaran --}}
                    <div class="mb-3">
                        <label class="form-label">Biaya Pendaftaran</label>
                        <input type="number" name="registration_fee"
                            class="form-control @error('registration_fee') is-invalid @enderror"
                            min="0" step="1000"
                            value="{{ old('registration_fee') }}" required>
                        @error('registration_fee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status Gelombang</label>
                        <select name="status"
                            class="form-select @error('status') is-invalid @enderror" required>
                            <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="full" {{ old('status') == 'full' ? 'selected' : '' }}>Full</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
