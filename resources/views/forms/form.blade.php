@php
    $fields = $form->getFields();
    $submitButton = $form->getSubmitButton();
    $formSubmitMethod = $form->getFormSubmitMethod();
    $formActionsPosition = $form->getFormActionsPosition();
    $extraActionButtons = $form->getExtraActionButtons();
    $formHeaderButtons = $form->getFormHeaderButtons();
    $maxWidth = $form->getMaxWidth();

    $title = $form->getTitle();
    $subtitle = $form->getSubtitle();
@endphp

<form wire:submit.prevent="{{ $formSubmitMethod }}" class="w-full h-full {{ $form->getClasses() }}"
    style="{{ $form->getStyles() }}">

    <x-yali::card title="{{ $title }}" subtitle="{{ $subtitle }}" maxWidth="{{ $maxWidth }}"
        footerActionsPosition="{{ $formActionsPosition }}" modalPosition="{{ $form->getModalPosition() }}">

        <x-slot name="headerSlot">
            @foreach ($formHeaderButtons as $button)
                {!! $button->render() !!}
            @endforeach
        </x-slot>

        <div class="p-4 overflow-y-auto">

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

        <x-slot name="footerSlot">
            @foreach ($extraActionButtons as $button)
                {!! $button->render() !!}
            @endforeach
            {!! $submitButton->render() !!}
        </x-slot>

    </x-yali::card>
</form>
{{-- <div class="bg-white border rounded-md">
                <div class="-mt-3 ml-4">
                    <span class="inline-block bg-white px-2 text-sm text-gray-600">Label</span>
                </div>
                <div class="p-4">
                    contents
                </div>
            </div> --}}
