<div class="btn-group">
    <button type="button"
        class="btn btn-gradient-primary btn-rounded btn-sm dropdown-toggle"
        data-bs-toggle="dropdown">
        Aksi
    </button>

    <div class="dropdown-menu">

        {{-- EDIT --}}
        <button type="button"
            class="dropdown-item btn-edit"
            data-bs-toggle="modal"
            data-bs-target="{{ $editModal }}"

            data-id="{{ $id }}"
            data-tahun-ajaran-id="{{ $tahun_ajaran_id }}"
            data-name="{{ $name }}"
            data-start-date="{{ \Carbon\Carbon::parse($start_date)->format('Y-m-d') }}"
            data-end-date="{{ \Carbon\Carbon::parse($end_date)->format('Y-m-d')}}"
            data-quota="{{ $quota }}"
            data-registration-fee="{{ $registration_fee }}"
            data-status="{{ $status }}">
            Edit
        </button>

        {{-- DELETE --}}
        <button type="button"
            class="dropdown-item btn-delete"
            data-bs-toggle="modal"
            data-bs-target="{{ $deleteModal }}"
            data-id="{{ $id }}"
            data-name="{{ $name }}">
            Hapus
        </button>

    </div>
</div>
