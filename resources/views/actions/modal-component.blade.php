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
        $subTitle = $this->getResource()->getSubTitle() ?? '';

        $isCloseOnOutsideClick = $this->getForm()->isCloseOnOutsideClick();
        $isCloseOnEsc = $this->getForm()->isCloseOnEscape();
    @endphp
    @if ($button)
        {!! $button->render() !!}
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal x-show="open" x-on:click="open = false"
            @click.outside="{{ $isCloseOnOutsideClick ? 'open = false' : '' }}"
            @keyup.escape.window="{{ $isCloseOnEsc ? 'open = false' : '' }}" :position="$modalPosition" :maxWidth="$modalMaxWidth"
            :bgColor="$bgColor" :margin="$margin" :rounded="$rounded" :title="$title" :subtitle="$subTitle">

            {{ $this->getForm()->render() }}

        </x-yali::modals.modal>

    </div>
</div>
