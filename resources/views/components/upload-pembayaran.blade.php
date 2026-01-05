<form action="{{ route('uploadUlangPembayaran') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Keterangan Gagal --}}
    <div class="alert alert-danger">
        Bukti transfer tidak valid. Silakan upload ulang bukti pembayaran.
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Jumlah Pembayaran</label>
        <input type="text" class="form-control" value="Rp.{{ number_format($gelombang->registration_fee,0,',','.') }}" readonly>
        <input type="hidden" name="amount" value="{{ $gelombang->registration_fee }}">
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Upload Bukti Pembayaran</label>
        <input type="file" name="file_path" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Upload Ulang Bukti</button>
</form>
