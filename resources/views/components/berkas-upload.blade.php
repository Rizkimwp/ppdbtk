
<div class="container mt-4">
    <h3>Berkas Tidak Valid</h3>
    <ul class="list-group">
        @foreach ($berkasTidakValid as $berkas)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Nama Berkas:</strong> {{ $berkas->listBerkas->nama_berkas }} <br>
                        <strong>Status:</strong>
                        {{ $berkas->status === 'TIDAK_VALID' ? 'TIDAK VALID' : 'VALID' }} <br>
                        <strong>File Path:</strong>
                        <a href="{{ asset($berkas->file_path) }}" class="btn btn-info btn-sm" target="_blank">Lihat
                            Berkas</a>
                    </div>
                    <div class="col-md-6">
                        <!-- Form untuk upload ulang -->
                        <form action="{{ route('berkas.upload_ulang', $berkas->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">

                                <input type="file" class="form-control-file" id="file_berkas" name="file_berkas"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Ulang</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
