@props(['wrapperClass' => '', 'label' => null, 'placeholder' => 'Search...', 'hasSearch' => false])

<div class="bg-white rounded-lg border p-4 {{ $wrapperClass }}">
    @if ($label)
        <label for="table-search" class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    @endif
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <input type="text" id="table-search" {{ $attributes->whereStartsWith('wire:model') }}
            class="block pt-2 ps-10 pe-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-full"
            placeholder="{{ $placeholder }}">
        @if ($hasSearch)
            <button {{ $attributes->whereStartsWith('wire:click') }}
                class="absolute inset-y-0 right-0 flex items-center pe-3">
                <x-yali::icon name="mark" class="text-gray-500 h-5 w-5" />
            </button>
        @endif
    </div>
</div>
