<x-yali::forms.field-wrapper :name="$field->getName()" :field="$field" :label="$field->getLabel()" :error="$errors->has($field->getName()) ? $errors->first($field->getName()) : null" :info="$field->getInfoMessage()">
    <div class="inline">
        <textarea id="{{ $field->getName() }}"
            class="{{ $errors->has($field->getName()) ? 'textarea-error' : 'textarea' }} {{ $field->isDisabled() ? 'textarea-disabled' : '' }} w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            placeholder="{{ $field->getPlaceholder() }}"
            wire:model="form.{{ $field->getFormId() }}.inputs.{{ $field->getName() }}"
            {{ $field->isDisabled() ? 'disabled' : '' }} rows="{{ $field->rows }}" cols="{{ $field->cols }}"
            {{ $field->autoresize ? 'oninput=resizeTextarea(this)' : '' }}></textarea>
    </div>
</x-yali::forms.field-wrapper>

{{-- @if ($field->autoresize)
    <script>
        function resizeTextarea(el) {
            el.style.height = 'auto';
            el.style.height = (el.scrollHeight) + 'px';
        }
    </script>
@endif --}}
