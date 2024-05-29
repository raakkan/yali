<div class="inline-block" x-data="{ open: false }">

    @php
        $button = $this->getAction()->getButton();
        $button->setAttributes([
            'x-on:click' => 'open = true',
        ]);

        $modalPosition = $this->getForm()->getModalPosition();
        $modalMaxWidth = $this->getForm()->getMaxWidth();
        $bgColor = $this->getForm()->getBackgroundColor();
        $margin = $this->getForm()->getMargin();
        $rounded = $this->getForm()->getRounded();
        $title = $this->getAction()->getModalTitle();
    @endphp
    @if ($button)
        {!! $button->render() !!}
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal :position="$modalPosition" :maxWidth="$modalMaxWidth" :bgColor="$bgColor" :margin="$margin" :rounded="$rounded"
            :title="$title">

            {{ $this->getForm()->render() }}

        </x-yali::modals.modal>

    </div>
</div>
