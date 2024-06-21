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

    $modalPosition = $form->getModalPosition();
@endphp

@php
    $formInModal = isset($modalPosition) && $modalPosition !== null && $modalPosition !== '';
@endphp

<form wire:submit.prevent="{{ $formSubmitMethod }}"
    class="h-full w-full {{ $modalPosition === 'center'
        ? 'flex justify-center items-center h-screen'
        : ($modalPosition === 'top' || $modalPosition === 'bottom'
            ? 'flex justify-center'
            : ($modalPosition === 'left'
                ? 'flex justify-start'
                : ($modalPosition === 'right'
                    ? 'flex justify-end'
                    : 'flex justify-end'))) }} {{ $form->getClasses() }}"
    style="{{ $form->getStyles() }}">

    <x-yali::card title="{{ $title }}" subtitle="{{ $subtitle }}" maxWidth="{{ $maxWidth }}"
        footerActionsPosition="{{ $formActionsPosition }}" modalPosition="{{ $modalPosition }}">

        <x-slot name="headerSlot">
            @foreach ($formHeaderButtons as $button)
                {!! $button->render() !!}
            @endforeach
        </x-slot>

        <div class="{{ $formInModal ? 'p-2 md:p-3' : 'px-4 py-6' }} overflow-y-auto">

            @if ($form->hasHeaderMessages())
                <div class="">
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
