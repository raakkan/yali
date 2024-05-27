@props(['label', 'for', 'hasError' => false])

<label for="{{ $for }}" class="{{ $hasError ? 'input-label-error' : 'input-label' }}">
    {{ $label }}
</label>
