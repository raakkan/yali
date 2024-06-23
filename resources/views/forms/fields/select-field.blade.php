<x-yali::forms.field-wrapper :name="$field->getName()" :field="$field" :label="$field->getLabel()" :error="$errors->has($field->getName()) ? $errors->first($field->getName()) : null" :info="$field->getInfoMessage()">
    <div class="inline" x-data="selectFieldData(
        {{ $field->getJsOptions() }},
        '{{ $field->isCreateNewOption() }}',
        '{{ $field->getLivewireId() }}',
        '{{ $field->getFormId() }}',
        '{{ $field->getName() }}'
    )" x-init="init()">
        <select id="{{ $field->getId() }}" name="{{ $field->getName() }}"
            class="{{ $errors->has($field->getName()) ? 'input-error' : 'input' }} {{ $field->isDisabled() ? 'input-disabled' : '' }}"
            {{ $field->isDisabled() ? 'disabled' : '' }}
            @change="handleChange('{{ $field->getId() }}', $event.target.value)"
            wire:model="inputs.{{ $field->getFormId() }}.{{ $field->getName() }}">
            @if ($field->getPlaceholder())
                <option value="" hidden>{{ $field->getPlaceholder() }}</option>
            @endif
            <template x-for="option in options" :key="option.value">
                <option :value="option.value" x-text="option.label">
                </option>
            </template>

            <option x-show="createNewOption" value="create-new">Create New</option>
        </select>

        <div x-show="newInputShow" class="mt-2">
            <input class="input" type="text" id="new-{{ $field->getId() }}" name="{{ $field->getName() }}"
                placeholder="Create New {{ $field->getLabel() }}" @change="updateField($event.target.value)">
        </div>
    </div>
</x-yali::forms.field-wrapper>

<script>
    function selectFieldData(initialOptions, createNewOption, livewireId, formId, fieldName) {
        return {
            options: initialOptions,
            createNewOption: createNewOption,
            livewireId: livewireId,
            formId: formId,
            fieldName: fieldName,
            newInputShow: false,
            selectedValue: '',
            init() {
                this.selectedValue = Livewire.find(this.livewireId).get(`inputs.${this.formId}.${this.fieldName}`);
                this.updateField(this.selectedValue);
                console.log(this.selectedValue);
            },
            handleChange(fieldId, value) {
                this.selectedValue = value;

                console.log(this.selectedValue);
                if (this.selectedValue === 'create-new') {
                    this.newInputShow = true;
                } else if (value) {
                    let newInput = document.getElementById('new-' + fieldId);
                    newInput.value = '';
                    this.newInputShow = false;
                    this.updateField(this.selectedValue);
                }
            },
            updateField(value) {
                var component = Livewire.find(this.livewireId);
                if (component) {
                    component.set(`inputs.${this.formId}.${this.fieldName}`, value);
                }
            }
        };
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('selectFieldData', selectFieldData);
    });
</script>
