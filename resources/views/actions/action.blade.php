@if ($class->isLink())
    <a href="{{ $class->getRoute() }}" class="{{ $class->getClasses() == '' ? 'btn-link' : ' ' . $class->getClasses() }}"
        @if ($class->getStyles() !== null) style="{{ $class->getStyles() }}" @endif
        wire:key="action-link-{{ $class->getUniqueKey() }}">
        {{ $class->getLabel() }}
    </a>
@else
    <button class="{{ $class->getClasses() == '' ? 'btn btn-primary' : ' ' . $class->getClasses() }}"
        @if ($class->getStyles() !== null) style="{{ $class->getStyles() }}" @endif
        wire:key="action-button-{{ $class->getUniqueKey() }}"
        wire:yali-confirm="{title: 'Delete {{ $this->getResource()->getTitle() }}', message: 'Are you sure you want to delete this {{ $this->getResource()->getTitle() }}?', payload: '{{ $class->getPayload() }}'}"
        wire:click="delete">
        {{ $class->getLabel() }}
    </button>
@endif
