@props([
    'label' => null,
    'spinner' => false,
    'spinnerTarget' => null,
    'icon' => null,
    'link' => null,
    'disabled' => false,
])

@php
    $spinnerTarget = $spinnerTarget !== null ? $spinnerTarget : $attributes->whereStartsWith('wire:click')->first();
@endphp

{{-- DOC: wire:click with input for loop button with spinner --}}

@if ($link)
<a href="{!! $link !!}" @else <button @endif
        wire:key="hello-{{ md5(serialize(rand())) }}"
        {{ $attributes->merge(['class' => 'button-primary inline-flex justify-center']) }}
        @if ($spinner) wire:target="{{ $spinnerTarget }}"
    wire:loading.attr="disabled" @endif
        @if ($disabled) disabled @endif>

        @if ($spinner)
            <x-yali::icon name="spinner" wire:loading wire:target="{{ $spinnerTarget }}"
                class="inline w-4 h-4 me-3 text-red-600 animate-spin" />
        @endif

        @if ($icon)
            <x-yali::icon name="{{ $icon }}" class="h-6 w-6 text-red-600" />
        @endif

        @if ($label)
            {{ $label }}
        @endif

        @if (!$link)
            </button>
        @else
    </a>
@endif
