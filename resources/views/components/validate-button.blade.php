<button type="{{ $type ?? 'button' }}" id="loadBerkas"
    class="btn btn-validate btn-{{ $color ?? 'primary' }} btn-sm btn-icon-text" data-bs-toggle="{{ $toggle ?? '' }}"
    data-bs-target="{{ $target ?? '' }}" data-berkas={{ $berkas }}>
    <i class="mdi mdi-{{ $icon ?? '' }} btn-icon-prepend"></i> {{ $slot }}
</button>
