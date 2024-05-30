@php
    $fields = $class->getFields();
    $submitButton = $class->getSubmitButton();
    $formSubmitMethod = $class->getFormSubmitMethod();
    $formActionsPosition = $class->getFormActionsPosition();
    $extraActionButtons = $class->getExtraActionButtons();
@endphp


<form wire:submit.prevent="{{ $formSubmitMethod }}" class="{{ $class->getClasses() }} flex flex-col h-full"
    style="{{ $class->getStyles() }}">
    <div class="p-4 {{ $class->isModal() ? 'flex-1 overflow-y-auto' : '' }}">
        <div class="grid-layout" data-cols="{{ $class->getGridColumns() }}" data-gap="{{ $class->getGap() }}">
            @foreach ($fields as $field)
                {!! $field->render() !!}
            @endforeach

            {{-- <div class="bg-white border rounded-md">
                <div class="-mt-3 ml-4">
                    <span class="inline-block bg-white px-2 text-sm text-gray-600">Label</span>
                </div>
                <div class="p-4">
                    contents
                </div>
            </div> --}}

        </div>
    </div>
    <div
        class="p-4 {{ $class->isModal() ? 'bg-white border-t sticky bottom-0 rounded-b-lg' : '' }} space-x-3 flex {{ $formActionsPosition }}">
        @foreach ($extraActionButtons as $button)
            {!! $button->render() !!}
        @endforeach
        {!! $submitButton->render() !!}
    </div>
</form>
