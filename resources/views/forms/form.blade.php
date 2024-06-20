@php
    $fields = $form->getFields();
    $submitButton = $form->getSubmitButton();
    $formSubmitMethod = $form->getFormSubmitMethod();
    $formActionsPosition = $form->getFormActionsPosition();
    $extraActionButtons = $form->getExtraActionButtons();
@endphp

<form wire:submit.prevent="{{ $formSubmitMethod }}" class="{{ $form->getClasses() }} flex flex-col h-full"
    style="{{ $form->getStyles() }}">

    <div class="p-4 flex-1 overflow-y-auto">

        @if ($form->hasHeaderMessages())
            <div class="mb-4">
                @foreach ($form->getHeaderMessages() as $headerMessage)
                    @if ($headerMessage instanceof Raakkan\Yali\Core\View\BaseComponent)
                        {!! $headerMessage->render() !!}
                    @else
                        {!! $headerMessage !!}
                    @endif
                @endforeach

            </div>
        @endif

        <div class="grid-layout" data-cols="{{ $form->getGridColumns() }}" data-gap="{{ $form->getGap() }}">
            @foreach ($fields as $field)
                {!! $field->setFormId($form->getId())->render() !!}
            @endforeach
        </div>
    </div>
    <div class="p-4 sticky bottom-0 space-x-3 flex {{ $formActionsPosition }}">
        @foreach ($extraActionButtons as $button)
            {!! $button->render() !!}
        @endforeach
        {!! $submitButton->render() !!}
    </div>
</form>

{{-- <div class="bg-white border rounded-md">
                <div class="-mt-3 ml-4">
                    <span class="inline-block bg-white px-2 text-sm text-gray-600">Label</span>
                </div>
                <div class="p-4">
                    contents
                </div>
            </div> --}}
