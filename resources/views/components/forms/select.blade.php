@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'value' => null,
    'options' => [],
    'placeholder' => null,
    'multiple' => false,
    'required' => false,
    'disabled' => false,
    'size' => null,
    'labelClass' => 'input-label',
    'selectClass' => 'btn btn-ghost btn-sm',
])

@php
    $hasError = $errors->has($name);
    $id = $id ?? $name;
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="{{ $labelClass }}">
            {{ $label }} @if ($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $id }}"
        {{ $attributes->class([$selectClass, $hasError ? 'border-red-500' : ''])->merge([
            'wire:model' => $attributes->wire('model'),
            'multiple' => $multiple,
            'required' => $required,
            'disabled' => $disabled,
            'size' => $size,
        ]) }}>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $key => $option)
            @if (is_array($option))
                <optgroup label="{{ $key }}">
                    @foreach ($option as $subKey => $subOption)
                        <option value="{{ $subKey }}" @if ($value == $subKey) selected @endif>
                            {{ $subOption }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}" @if ($value == $key) selected @endif>
                    {{ $option }}</option>
            @endif
        @endforeach
    </select>

    @if ($hasError)
        <p class="{{ $errorClass }}">{{ $errors->first($name) }}</p>
    @endif
</div>
