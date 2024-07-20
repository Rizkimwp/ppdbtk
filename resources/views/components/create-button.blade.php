<button type="{{ $type ?? 'button' }}" class="btn btn-{{ $color ?? 'primary' }} btn-sm btn-icon-text"
    data-bs-toggle="{{ $toggle ?? '' }}" data-bs-target="{{ $target ?? '' }}">
    <i class="mdi mdi-{{ $icon ?? '' }} btn-icon-prepend"></i> {{ $slot }}
</button>