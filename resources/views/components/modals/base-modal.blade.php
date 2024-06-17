@props(['button', 'header' => false, 'position' => 'center'])
<div x-data="{ open: false }" class="inline-block">

    @if (isset($button))
        {{ $button }}
    @else
        <button x-on:click="open = true">Open</button>
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal x-show="open" :header="$header" :position="$position">
            {{ $slot }}
        </x-yali::modals.modal>
    </div>
</div>
