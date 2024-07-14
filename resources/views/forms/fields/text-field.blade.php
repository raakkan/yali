<x-yali::forms.field-wrapper :field="$field">
    <input x-ref="{{ $field->getName() }}" type="{{ $field->getType() === 'password' ? 'password' : $field->getType() }}"
        id="{{ $field->getName() }}"
        class="{{ $errors->has($field->getName()) ? 'input-error' : 'input' }} {{ $field->isDisabled() ? 'input-disabled' : '' }}"
        placeholder="{{ $field->getPlaceholder() }}" {{ $field->hasWireModel() ? $field->getWireModelAttribute() : '' }}
        {{ $field->isDisabled() ? 'disabled' : '' }}>
</x-yali::forms.field-wrapper>
