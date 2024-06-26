@if ($action->isConfirmation())
    @livewire(
        'yali::action-confirmation-modal',
        [
            'actionClass' => get_class($action),
            'sourceClass' => $action->getSource(),
            'recordId' => $action->getModel()->getKey(),
            'actionAdditionalData' => $action->getAdditionalData(),
        ],
        key($action->getUniqueKey())
    )
@elseif ($action->isModal())
    @livewire(
        'yali::action-modal',
        [
            'actionClass' => get_class($action),
            'sourceClass' => $action->getSource(),
            'recordId' => $action->getModel()->getKey(),
            'actionAdditionalData' => $action->getAdditionalData(),
        ],
        key($action->getUniqueKey())
    )
@else
    {!! $action->getButton() !!}
@endif
