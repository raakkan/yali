<x-yali::forms.field-wrapper :name="$field->getName()" :field="$field" :label="$field->getLabel()" :error="$errors->has($field->getName()) ? $errors->first($field->getName()) : null" :info="$field->getInfoMessage()">
    <div class="inline">
        <select id="{{ $field->getId() }}" name="{{ $field->getName() }}"
            class="{{ $errors->has($field->getName()) ? 'input-error' : 'input' }} {{ $field->isDisabled() ? 'input-disabled' : '' }}"
            {{ $field->isDisabled() ? 'disabled' : '' }}
            wire:model="form.{{ $field->getFormId() }}.inputs.{{ $field->getName() }}">
            @if ($field->getPlaceholder())
                <option value="" hidden>{{ $field->getPlaceholder() }}</option>
            @endif

            @foreach ($field->getOptions() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
</x-yali::forms.field-wrapper>
