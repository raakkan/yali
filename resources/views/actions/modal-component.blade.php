<div class="inline-block" x-data="{ open: false }">

    @php
        $button = $this->getAction()->getButton();
        $button->setAttributes([
            'x-on:click' => 'open = true',
        ]);

        $submitButton = $this->getForm()->getSubmitButton();
        $submitButton->setLabel($this->getAction()->getSubmitButtonLabel());

        $modalPosition = $this->getForm()->getModalPosition();
        $modalMaxWidth = $this->getForm()->getMaxWidth();
        $bgColor = $this->getForm()->getBackgroundColor();
        $margin = $this->getForm()->getMargin();
        $rounded = $this->getForm()->getRounded();

        $title = $this->getResource()->getTitle();
        $subTitle = $this->getResource()->getSubTitle();

        $alertMessage = $this->getAction()->getAlertMessage();
        $alertType = $this->getAction()->getAlertType();

        $isCloseOnOutsideClick = $this->getForm()->isCloseOnOutsideClick();
        $isCloseOnEsc = $this->getForm()->isCloseOnEscape();

        $extraActionButton = Raakkan\Yali\Core\View\Button::make();
        $extraActionButton->classes(['btn', 'btn-ghost', 'btn-sm']);
        $extraActionButton->setLabel('Cancel');
        $extraActionButton->setAttributes([
            'x-on:click' => 'open = false',
            'wire:click' => 'cancel',
        ]);
    @endphp

    @if ($button)
        {!! $button->render() !!}
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal x-show="open" x-on:click="open = false"
            @click.outside="{{ $isCloseOnOutsideClick ? 'open = false' : '' }}"
            @keyup.escape.window="{{ $isCloseOnEsc ? 'open = false' : '' }}" :position="$modalPosition" :maxWidth="$modalMaxWidth"
            :bgColor="$bgColor" :margin="$margin" :rounded="$rounded" :title="$title" :subtitle="$subTitle" :alertMessage="$alertMessage"
            :alertType="$alertType">

            {{ $this->getForm()->setSubmitButton($submitButton)->extraActionButtons($extraActionButton)->render() }}

        </x-yali::modals.modal>

    </div>
</div>
