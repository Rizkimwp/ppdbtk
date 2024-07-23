<div class="btn-group">
    <button type="button" class="btn btn-gradient-primary btn-rounded dropdown-toggle btn-sm"
        data-bs-toggle="dropdown">Aksi</button>
    <div class="dropdown-menu">
        <a href="#" class="dropdown-item btn-edit" data-bs-toggle="modal" data-bs-target="{{ $editModal }}"
            data-id="{{ $id }}" data-nama="{{ $nama }}" data-limit="{{ $limit }}">Edit</a>
        <a href="#" class="dropdown-item btn-delete" data-bs-toggle="modal" data-bs-target="{{ $deleteModal }}"
            data-id="{{ $id }}" data-nama="{{ $nama }}">Delete</a>
    </div>
</div>
