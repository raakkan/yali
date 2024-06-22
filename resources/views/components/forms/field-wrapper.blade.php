@props(['name', 'field', 'label', 'error', 'info'])

<div class="{{ $field->getColSpan() }}">
    @if ($label !== '' && !is_null($label))
        @include('yali::forms.fields.utils.input-label', [
            'for' => $name,
            'hasError' => $error,
            'label' => $label,
        ])
    @endif

    <div class="relative">
        {{ $slot }}
    </div>

    @if ($error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
    @endif

    @if ($info)
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $info }}</p>
    @endif
</div>
