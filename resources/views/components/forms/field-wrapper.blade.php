@props(['name', 'class', 'label', 'error', 'info'])

<div>
    @include('yali::forms.fields.utils.input-label', [
        'for' => $name,
        'hasError' => $error,
        'label' => $label,
    ])

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
