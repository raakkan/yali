@props(['icon'])

{{-- @DOC: documentation this with svg no new line fully qualified string --}}

@if (view()->exists($icon))
    {!! view($icon)->render() !!}
@elseif (is_string($icon) && preg_match('/^<svg.*<\/svg>$/s', $icon))
    {!! str_replace('<svg', '<svg class="w-6 h-6 mr-3"', $icon) !!}
@elseif (filter_var($icon, FILTER_VALIDATE_URL))
    <img src="{{ $icon }}" alt="Navigation Icon" class="w-6 h-6 mr-3">
@else
    <x-yali::icon name="{{ $icon }}" class="w-6 h-6 mr-3" />
@endif
