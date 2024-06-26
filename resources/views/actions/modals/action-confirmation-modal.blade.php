<div x-data="{ open: $wire.entangle('openActionModal') }" class="inline-block">
    <x-yali::modals.base-modal>
        @php
            $confirmationTitle = $this->getAction()->getConfirmationTitle();
            $confirmationMessage = $this->getAction()->getConfirmationMessage();
            $loadingLabel = $this->getAction()->getConfirmationButtonLoadingLabel();

            $button = $this->getAction()->getButton();
            $button->setAttributes([
                'wire:click' => 'openModal',
            ]);

            $confirmButton = $this->getAction()->getConfirmationButton();

            if (!$this->getAction()->getConfirmationButtonLabel() && !$confirmButton->hasLabel()) {
                $confirmButton->label('Yes, I\'m sure');
            }

            if ($this->getAction()->hasForm()) {
                $submitButton = $this->getAction()->getForm()->getSubmitButton();
                $submitButton->setLabel($this->getAction()->getForm()->getSubmitButtonLabel());
                $submitButton->classes(['btn', 'btn-sm', 'btn-full-width']);
                $submitButton->setSpinner(true, 'confirmAction');
                $submitButton->setLoadingLabel($loadingLabel);

                $form = $this->getAction()
                    ->getForm()
                    ->setFormSubmitMethod('confirmAction')
                    ->setSubmitButton($submitButton);
            }

            $closeButton = Raakkan\Yali\Core\View\Button::make();
            $closeButton->classes(['btn', 'btn-ghost', 'btn-sm', 'btn-full-width']);
            $closeButton->setLabel('Cancel');
            $closeButton->setAttributes([
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
                    {!! $confirmButton->setAttributes(['wire:click' => 'confirmAction'])->setSpinner(true, 'confirmAction')->render() !!}
                </x-slot>
            </x-yali::actions.simple-confirmation>
        @else
            @if ($this->getAction()->isSimpleConfirmation() && $this->getAction()->hasForm() && !$showWizardOrForm)
                <x-yali::actions.simple-confirmation :confirmationTitle="$confirmationTitle" :confirmationMessage="$confirmationMessage" :loadingLabel="$loadingLabel">
                    <x-slot name="confirmButton">
                        {!! $confirmButton->setAttributes(['wire:click' => "\$set('showWizardOrForm', true)"])->render() !!}
                    </x-slot>
                </x-yali::actions.simple-confirmation>
            @endif

            @if ($showWizardOrForm)
                @if ($this->getAction()->getForm()->hasTitle())
                    {{ $form->setTitle($this->getAction()->getForm()->getTitle())->setModalPosition('center')->formHeaderButtons($closeIconButton)->render() }}
                @else
                    {{ $form->setModalPosition('center')->extraActionButtons($closeButton)->render() }}
                @endif
            @endif
        @endif
    </x-yali::modals.base-modal>
</div>
