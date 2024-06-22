<x-yali::forms.field-wrapper :name="$field->getName()" :field="$field" :label="$field->getLabel()" :error="$errors->has($field->getName()) ? $errors->first($field->getName()) : null" :info="$field->getInfoMessage()">
    <div class="inline" x-data="{ open: false }">
        <select id="{{ $field->getName() }}"
            class="{{ $errors->has($field->getName()) ? 'textarea-error' : 'textarea' }} {{ $field->isDisabled() ? 'textarea-disabled' : '' }} w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            @change="updateField('{{ $field->getLivewireId() }}', '{{ $field->getFormId() }}', '{{ $field->getName() }}', $event.target.value)"
            {{ $field->isDisabled() ? 'disabled' : '' }}>
            @if ($field->getPlaceholder())
                <option value="" hidden selected>{{ $field->getPlaceholder() }}</option>
            @endif
            @foreach ($field->getOptions() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
</x-yali::forms.field-wrapper>

<script>
    function updateField(livewireId, formId, fieldName, value) {
        var component = Livewire.find(livewireId);
        component.set(`inputs.${formId}.${fieldName}`, value);
    }
</script>
