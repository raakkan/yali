<div x-data="{ open: $wire.entangle('openActionModal') }" class="inline-block">
    <x-yali::modals.base-modal>
        @php
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
            $closeIconButton->classes(['btn', 'btn-icon', 'btn-transparent', 'p-0']);
            $closeIconButton->setAttributes([
                'wire:click' => 'cancelAction',
            ]);
            $closeIconButton->icon('x');
        @endphp

        <x-slot name="button">
            {!! $button->render() !!}
        </x-slot>
        dd
    </x-yali::modals.base-modal>
</div>
