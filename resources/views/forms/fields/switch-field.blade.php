<div>
    @php
        $hasError = $errors->has($class->getName());
    @endphp

    @include('yali::forms.fields.utils.input-label', [
        'for' => $class->getName(),
        'hasError' => $hasError,
        'label' => $class->getLabel(),
    ])

    <label
        class="inline-flex items-center cursor-pointer w-full bg-gray-50 p-2.5 rounded-lg border border-gray-300 text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <div class="flex items-center">
            <input wire:model="inputs.{{ $class->getName() }}" type="checkbox" value="" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
            </div>
        </div>
        <span class="text-sm font-medium text-gray-500 dark:text-gray-300 ml-3">{{ $class->getName() }}</span>
    </label>

    @error($class->getName())
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror
</div>
