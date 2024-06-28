<div x-data="{ open: $wire.entangle('openActionModal') }" class="inline-block">
    @php
        $modalPosition = $this->getAction()->getModalPosition();
    @endphp

    <x-yali::modals.base-modal :position="$modalPosition">
        @php
            $submitButton = $this->getForm()->getSubmitButton();
            $submitButton->label($this->getSubmitButtonLabel());
            $submitButton->setSpinner(true, 'confirmAction');

            $form = $this->getForm()->setFormSubmitMethod('confirmAction')->setSubmitButton($submitButton);

            $button = $this->getAction()->getButton();
            $button->setAttributes([
                'wire:click' => 'openModal',
            ]);

            $closeButton = Raakkan\Yali\Core\View\Button::make();
            $closeButton->classes(['btn', 'btn-ghost', 'btn-sm', 'btn-full-width']);
            $closeButton->setLabel('Cancel');
            $closeButton->setAttributes([
                'wire:click' => 'cancelAction',
            ]);

            $closeIconButton = Raakkan\Yali\Core\View\Button::make();
            $closeIconButton->classes(['btn', 'btn-icon', 'btn-transparent', 'btn-sm']);
            $closeIconButton->setAttributes([
                'wire:click' => 'cancelAction',
            ]);
            $closeIconButton->icon('x');
        @endphp

        <x-slot name="button">
            {!! $button->render() !!}
        </x-slot>

        {{-- <div class="bg-white rounded-lg m-4 w-full {{ $this->getForm()->getMaxWidth() }}">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">
                    {{ $this->getTitle() }}
                </h3>
                {!! $closeIconButton->render() !!}
            </div>
            {{ $form->render() }}
        </div> --}}

        {{ $form->setTitle($this->getTitle())->setModalPosition($modalPosition)->formHeaderButtons($closeIconButton)->render() }}

    </x-yali::modals.base-modal>
</div>
