@if ($class->isLink())
    <a href="{{ $class->getRoute() }}" class="{{ $class->getClasses() == '' ? 'btn-link' : ' ' . $class->getClasses() }}"
        @if ($class->getStyles() !== null) style="{{ $class->getStyles() }}" @endif
        wire:key="action-link-{{ $class->getUniqueKey() }}">
        {{ $class->getLabel() }}
    </a>
@else
    <button class="{{ $class->getClasses() == '' ? 'btn btn-primary' : ' ' . $class->getClasses() }}"
        @if ($class->getStyles() !== null) style="{{ $class->getStyles() }}" @endif
        wire:key="action-button-{{ $class->getUniqueKey() }}">
        {{ $class->getLabel() }}
    </button>
@endif
