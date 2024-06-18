<div x-data="{ open: $wire.entangle('openModal') }" class="inline-block">
    <x-yali::modals.base-modal>
        @php
            $button = $this->getAction()->getButton();
            $button->setAttributes([
                'x-on:click' => 'open = true',
            ]);

            $confirmationTitle = $this->getAction()->getConfirmationTitle();
            $confirmationMessage = $this->getAction()->getConfirmationMessage();
            $loadingLabel = $this->getAction()->getLoadingLabel();
        @endphp

        <x-slot name="button">
            {!! $button->render() !!}
        </x-slot>

        @if ($this->getAction()->isSimpleConfirmation())
            <x-yali::actions.simple-confirmation :confirmationTitle="$confirmationTitle" :confirmationMessage="$confirmationMessage" :loadingLabel="$loadingLabel" />
        @else
            <div>
                fdfd
            </div>
        @endif
    </x-yali::modals.base-modal>
</div>
