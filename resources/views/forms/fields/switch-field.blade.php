<div class="">
    @php
        $hasError = $errors->has($class->getName());
    @endphp

    <label class="inline-flex items-center cursor-pointer">
        <input wire:model="inputs.{{ $class->getName() }}" type="checkbox" value="" class="sr-only peer">
        <div
            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
        </div>
        <span
            class="ms-3 text-sm font-medium {{ $hasError ? 'text-red-600 dark:text-red-500' : 'text-gray-900 dark:text-gray-300' }}">{{ $class->getLabel() }}</span>
    </label>

    @error($class->getName())
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror
</div>
