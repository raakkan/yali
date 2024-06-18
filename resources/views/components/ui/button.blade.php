@props([
    'label' => null,
    'loadingLabel' => 'Loading...',
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
        {{ $attributes->merge(['class' => 'btn btn-primary']) }}
        @if ($spinner) wire:target="{{ $spinnerTarget }}"
    wire:loading.attr="disabled" @endif
        @if ($disabled) disabled @endif>

        @if ($spinner)
            <x-yali::icon name="spinner" wire:loading wire:target="{{ $spinnerTarget }}"
                class="inline w-4 h-4 me-3 text-red-600 animate-spin" />
        @endif

        @if ($icon)
            <x-yali::icon name="{{ $icon }}" />
        @endif

        @if ($spinner && $loadingLabel)
            <span wire:loading wire:target="{{ $spinnerTarget }}">
                {{ $loadingLabel }}
            </span>
            <span wire:loading.remove wire:target="{{ $spinnerTarget }}">
                {{ $label }}
            </span>
        @else
            {{ $label }}
        @endif

        @if (!$link)
            </button>
        @else
    </a>
@endif
