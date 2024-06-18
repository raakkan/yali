@props(['button', 'header' => false, 'position' => 'center'])
<div class="inline-block">

    @if (isset($button))
        {{ $button }}
    @else
        <button class="btn btn-primary" x-on:click="open = true">Open</button>
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal x-show="open" :header="$header" :position="$position">
            {{ $slot }}
        </x-yali::modals.modal>
    </div>
</div>
