<div class="inline-block" x-data="{ open: false }">

    @php
        $button = $this->getButton();
        $button->setAttributes([
            'x-on:click' => 'open = true',
        ]);
    @endphp
    @if ($button)
        {!! $button->render() !!}
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal :position="$this->getModalPosition()">

            {{ $this->getForm()->render() }}

        </x-yali::modals.modal>

    </div>
</div>
