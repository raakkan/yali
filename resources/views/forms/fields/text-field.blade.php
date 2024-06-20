<x-yali::forms.field-wrapper :name="$field->getName()" :class="$field" :label="$field->getLabel()" :error="$errors->has($field->getName()) ? $errors->first($field->getName()) : null" :info="$field->getInfoMessage()">

    <div class="inline" x-data="{ showPassword: false }">
        <input x-ref="{{ $field->getName() }}"
            type="{{ $field->getType() === 'password' ? 'password' : $field->getType() }}" id="{{ $field->getName() }}"
            class="{{ $errors->has($field->getName()) ? 'input-error' : 'input' }} pr-10"
            placeholder="{{ $field->getPlaceholder() }}"
            wire:model="inputs.{{ $field->getFormId() }}.{{ $field->getName() }}">
        @if ($field->getType() === 'password')
            @include('yali::forms.fields.utils.password-toggle-button', ['refId' => $field->getName()])
        @endif
    </div>
</x-yali::forms.field-wrapper>
