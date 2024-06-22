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
    class="bg-white dark:bg-gray-800 {{ !$cardInModal ? 'border dark:border-gray-600 rounded-lg' : ($modalPosition === 'center' ? 'rounded-lg m-4' : 'h-screen relative') }} w-full {{ $cardInModal ? $maxWidth : 'max-w-full' }}">
    <div class="{{ $cardInModal ? 'p-3' : 'p-4' }} border-b dark:border-gray-600 flex items-center justify-between">
        @if ($title || $subtitle)
            <div>
                <h2 class="text-2xl font-semibold">{{ $title }}</h2>
                @if (isset($subtitle) && $subtitle)
                    <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $subtitle }}</p>
                @endif
            </div>
        @endif
        <div class="flex items-center space-x-2">
            @isset($headerSlot)
                {{ $headerSlot }}
            @endisset
        </div>
    </div>
    <div class="{{ $cardInModal ? 'max-h-[calc(100vh-9rem)] overflow-auto' : '' }}">
        {{ $slot }}
    </div>
    @isset($footerSlot)
        <div
            class="{{ $cardInModal ? 'p-3' : 'p-4' }} {{ $modalPosition !== 'center' && $cardInModal ? 'absolute bottom-0 w-full' : '' }} border-t dark:border-gray-600 flex items-center {{ $footerActionsPosition }}">
            {{ $footerSlot }}
        </div>
    @endisset
</div>
