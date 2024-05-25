@props(['alt' => '', 'width' => null, 'height' => null])

@php
    $imageSrc = $attributes->get('src');
    $class = $attributes->get('class', '');
@endphp

<img src="{{ $imageSrc }}" alt="{{ $alt }}" class="{{ $class }}"
    @if ($width) width="{{ $width }}" @endif
    @if ($height) height="{{ $height }}" @endif loading="lazy" decoding="async">
