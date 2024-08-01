<div class="btn-group">
    <button type="button" class="btn btn-gradient-primary btn-rounded dropdown-toggle btn-sm"
        data-bs-toggle="dropdown">Aksi</button>
    <div class="dropdown-menu">
        <a href="#" class="dropdown-item btn-edit" data-bs-toggle="modal" data-bs-target="{{ $editModal }}"
            data-id="{{ $id }}" data-nama="{{ $nama }}" data-hak="{{ $hak }}"
            data-username="{{ $username }}" data-email="{{ $email }}">Edit</a>
        <a href="#" class="dropdown-item btn-change" data-bs-toggle="modal" data-bs-target="{{ $changeModal }}"
            data-id="{{ $id }}" data-nama="{{ $nama }}">Ganti Password</a>
    </div>
</div>
