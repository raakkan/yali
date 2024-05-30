@if ($class->isLink())
    <a href="{{ $class->getRoute() }}" class="{{ $class->getClasses() == '' ? 'btn-link' : ' ' . $class->getClasses() }}"
        @if ($class->getStyles() !== null) style="{{ $class->getStyles() }}" @endif
        wire:key="action-link-{{ $class->getUniqueKey() }}">
        {{ $class->getLabel() }}
    </a>
@else
    @if ($class->isModal())
        @php
            $type = $class->getActionType();

            $data = [];
            if ($type === 'resource_form_action') {
                $data = [
                    'resource' => $class->getResource()->getClass(),
                    'model' => $class->getModel(),
                    'action' => get_class($class),
                    'type' => 'resource_form_action',
                    'mode' => $class->getModel()->{$class->getResource()->getPrimaryKey()} ? 'update' : 'create',
                ];
            } elseif ($type === 'form_action') {
                $data = [
                    'model' => $class->getModel(),
                    'action' => get_class($class),
                    'type' => 'form_action',
                    'mode' => $class->getModel()->{$class->getResource()->getPrimaryKey()} ? 'update' : 'create',
                ];
            }
        @endphp
        @livewire(
            'yali::modal-component',
            [
                'data' => $data,
            ],
            key('action-modal-' . $class->getUniqueKey())
        )
    @else
        <button class="{{ $class->getClasses() == '' ? 'btn btn-primary' : ' ' . $class->getClasses() }}"
            @if ($class->getStyles() !== null) style="{{ $class->getStyles() }}" @endif
            wire:key="action-button-{{ $class->getUniqueKey() }}"
            wire:yali-confirm="{title: 'Delete {{ $this->getResource()->getTitle() }}', message: 'Are you sure you want to delete this {{ $this->getResource()->getTitle() }}?', payload: '{{ $class->getPayload() }}'}"
            wire:click="delete">
            {{ $class->getLabel() }}
        </button>
    @endif
@endif
