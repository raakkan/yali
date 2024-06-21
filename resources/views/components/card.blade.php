@props([
    'title',
    'subtitle',
    'headerSlot' => null,
    'footerSlot' => null,
    'footerActionsPosition' => 'justify-between',
    'maxWidth' => 'max-w-full',
    'modalPosition' => null,
])

@php
    $cardInModal = isset($modalPosition) && $modalPosition !== null && $modalPosition !== '';
@endphp

<div
    class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg w-full {{ $cardInModal ? $maxWidth : 'max-w-full' }}">
    <div class="{{ $cardInModal ? 'p-3' : 'p-4' }} border-b dark:border-gray-600 flex items-center justify-between">
        @if ($title || $subtitle)
            <div>
                <h2 class="text-2xl font-semibold">{{ $title }}</h2>
                @if (isset($subtitle) && $subtitle)
                    <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $subtitle }}</p>
                @endif
            </div>
        @endif
        <div>
            @isset($headerSlot)
                {{ $headerSlot }}
            @endisset
        </div>
    </div>
    <div>
        {{ $slot }}
    </div>
    @isset($footerSlot)
        <div
            class="{{ $cardInModal ? 'p-3' : 'p-4' }} border-t dark:border-gray-600 flex items-center {{ $footerActionsPosition }}">
            {{ $footerSlot }}
        </div>
    @endisset
</div>
