<x-yali::forms.field-wrapper :name="$class->getName()" :class="$class" :label="$class->getLabel()" :error="$errors->has($class->getName()) ? $errors->first($class->getName()) : null" :info="$class->getInfoMessage()">
    <label
        class="{{ $errors->has($class->getName()) ? 'input-error' : 'input' }} pr-10 inline-flex items-center cursor-pointer w-full">
        <div class="flex items-center">
            <input wire:model="inputs.{{ $class->getName() }}" type="checkbox" value="" class="sr-only peer">
            <div
                class="relative w-11 h-6 {{ $errors->has($class->getName()) ? 'bg-red-200 peer-focus:ring-red-300' : 'bg-gray-200 peer-focus:ring-blue-300' }} dark:peer-focus:ring-blue-800 rounded-full peer {{ $errors->has($class->getName()) ? 'dark:bg-red-700' : 'dark:bg-gray-700' }} peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:{{ $errors->has($class->getName()) ? 'bg-red-600' : 'bg-blue-600' }}">
            </div>
        </div>
        <span
            class="text-sm font-medium {{ $errors->has($class->getName()) ? 'text-red-600' : 'text-gray-500' }} dark:text-gray-300 ml-3">{{ $class->getName() }}</span>
    </label>
</x-yali::forms.field-wrapper>
