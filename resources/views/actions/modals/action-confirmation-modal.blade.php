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

        @if ($this->getAction()->isSimpleConfirmation() && !$this->getAction()->hasForm())
            <x-yali::actions.simple-confirmation :confirmationTitle="$confirmationTitle" :confirmationMessage="$confirmationMessage" :loadingLabel="$loadingLabel">
                <x-slot name="confirmButton">
                    <x-yali::ui.button label="Yes, I'm sure" wire:click="confirmAction"
                        class="btn btn-danger btn-full-width btn-sm" spinner spinnerTarget="confirmAction"
                        loadingLabel="{{ $loadingLabel }}" />
                </x-slot>
            </x-yali::actions.simple-confirmation>
        @else
            @if ($this->getAction()->isSimpleConfirmation() && $this->getAction()->hasForm())
                <x-yali::actions.simple-confirmation :confirmationTitle="$confirmationTitle" :confirmationMessage="$confirmationMessage" :loadingLabel="$loadingLabel">
                    <x-slot name="confirmButton">
                        <x-yali::ui.button label="Yes, I'm sure" wire:click="$wire.showWizardOrForm = true"
                            class="btn btn-danger btn-full-width btn-sm" />
                    </x-slot>
                </x-yali::actions.simple-confirmation>
            @endif

            @if ($showWizardOrForm)
                <div class="w-full bg-white {{ $this->getAction()->getForm()->getMaxWidth() }}">
                    {{ $this->getAction()->getForm()->render() }}
                </div>
            @endif
        @endif
    </x-yali::modals.base-modal>
</div>
