<x-yali::forms.field-wrapper :name="$field->getName()" :field="$field" :label="$field->getLabel()" :error="$errors->has($field->getName()) ? $errors->first($field->getName()) : null" :info="$field->getInfoMessage()">
    <label
        class="{{ $errors->has($field->getName()) ? 'input-error' : 'input' }} pr-10 inline-flex items-center cursor-pointer w-full">
        <div class="flex items-center">
            <input wire:model="form.{{ $field->getFormId() }}.inputs.{{ $field->getName() }}" type="checkbox"
                value="" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:bg-blue-600 peer-checked:dark:bg-blue-600{{ $errors->has($field->getName()) ? ' bg-red-200 peer-focus:ring-red-300 dark:bg-red-700 peer-checked:bg-red-600 dark:peer-checked:bg-red-600' : ' bg-gray-200 peer-focus:ring-blue-300 dark:bg-gray-700' }} peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600">
            </div>
        </div>
        <span
            class="text-sm font-medium {{ $errors->has($field->getName()) ? 'text-red-600' : 'text-gray-500' }} dark:text-gray-300 ml-3">{{ $field->getLabel() }}</span>
    </label>
</x-yali::forms.field-wrapper>
