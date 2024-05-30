@php
    $fields = $class->getFields();
    $submitButton = $class->getSubmitButton();
    $formSubmitMethod = $class->getFormSubmitMethod();
    $formActionsPosition = $class->getFormActionsPosition();
    $extraActionButtons = $class->getExtraActionButtons();
@endphp


<form wire:submit.prevent="{{ $formSubmitMethod }}" class="{{ $class->getClasses() }} flex flex-col h-full"
    style="{{ $class->getStyles() }}">
    <div class="p-4 flex-1 overflow-y-auto">
        <div class="grid-layout" data-cols="{{ $class->getGridColumns() }}" data-gap="{{ $class->getGap() }}">
            @foreach ($fields as $field)
                {!! $field->render() !!}
            @endforeach
        </div>
    </div>
    <div class="p-4 bg-white border-t sticky bottom-0 rounded-b-lg space-x-3 flex {{ $formActionsPosition }}">
        @foreach ($extraActionButtons as $button)
            {!! $button->render() !!}
        @endforeach
        {!! $submitButton->render() !!}
    </div>
</form>
