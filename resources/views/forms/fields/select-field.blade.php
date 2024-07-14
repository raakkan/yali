<x-yali::forms.field-wrapper :field="$field">
    <select id="{{ $field->getId() }}" name="{{ $field->getName() }}"
        class="{{ $errors->has($field->getName()) ? 'input-error' : 'input' }} {{ $field->isDisabled() ? 'input-disabled' : '' }}"
        {{ $field->isDisabled() ? 'disabled' : '' }}
        {{ $field->hasWireModel() ? $field->getWireModelAttribute() : '' }}>
        @if ($field->getPlaceholder())
            <option value="" hidden>{{ $field->getPlaceholder() }}</option>
        @endif

        @foreach ($field->getOptions() as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</x-yali::forms.field-wrapper>
