<div x-data="{ open: $wire.entangle('openModal') }" class="inline-block">
    <x-yali::modals.base-modal>
        @php
            $button = $this->getAction()->getButton();
            $button->setAttributes([
                'x-on:click' => 'open = true',
            ]);

            if ($this->getAction()->hasForm()) {
                $submitButton = $this->getAction()->getForm()->getSubmitButton();
                $submitButton->setLabel($this->getAction()->getForm()->getSubmitButtonLabel());
                // TODO: if user change class on submit button not effect in submit button
                // so we need to change it here
                $submitButton->classes(['btn', 'btn-danger', 'btn-sm', 'btn-full-width']);
                $submitButton->setSpinner(true, 'submit');
            }

            $confirmationTitle = $this->getAction()->getConfirmationTitle();
            $confirmationMessage = $this->getAction()->getConfirmationMessage();
            $loadingLabel = $this->getAction()->getLoadingLabel();

            $extraActionButton = Raakkan\Yali\Core\View\Button::make();
            $extraActionButton->classes(['btn', 'btn-ghost', 'btn-sm', 'btn-full-width']);
            $extraActionButton->setLabel('Cancel');
            $extraActionButton->setAttributes([
                'wire:click' => 'cancelAction',
            ]);

            $closeIconButton = Raakkan\Yali\Core\View\Button::make();
            $closeIconButton->classes(['btn', 'btn-icon', 'btn-transparent', 'p-0']);
            $closeIconButton->setAttributes([
                'wire:click' => 'cancelAction',
            ]);
            $closeIconButton->icon('x');
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
            @if ($this->getAction()->isSimpleConfirmation() && $this->getAction()->hasForm() && !$showWizardOrForm)
                <x-yali::actions.simple-confirmation :confirmationTitle="$confirmationTitle" :confirmationMessage="$confirmationMessage" :loadingLabel="$loadingLabel">
                    <x-slot name="confirmButton">
                        <x-yali::ui.button label="Yes, I'm sure" wire:click="$set('showWizardOrForm', true)"
                            class="btn btn-danger btn-full-width btn-sm" />
                    </x-slot>
                </x-yali::actions.simple-confirmation>
            @endif

            @if ($showWizardOrForm)
                <div class="bg-white rounded-lg m-4 w-full {{ $this->getAction()->getForm()->getMaxWidth() }}">
                    @if ($this->getAction()->getForm()->hasTitle())
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">
                                {{ $this->getAction()->getForm()->getTitle() }}
                            </h3>
                            {!! $closeIconButton->render() !!}
                        </div>
                        {{ $this->getAction()->getForm()->setSubmitButton($submitButton)->render() }}
                    @else
                        {{ $this->getAction()->getForm()->setSubmitButton($submitButton)->extraActionButtons($extraActionButton)->render() }}
                    @endif
                </div>
            @endif
        @endif
    </x-yali::modals.base-modal>
</div>
