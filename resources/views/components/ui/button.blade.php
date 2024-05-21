@props([
    'label' => null,
    'spinner' => false,
    'spinnerTarget' => null,
    'confirm' => false,
    'confirmTitle' => null,
    'confirmText' => null,
    'icon' => null,
    'link' => null,
])

@php
    $spinnerTarget = $spinnerTarget !== null ? $spinnerTarget : $attributes->whereStartsWith('wire:click')->first();
@endphp

<div class="inline" x-data="{ open: false }">
    @if ($confirm)
        <button x-on:click="open = true" wire:key="hello-{{ md5(serialize(rand())) }}"
            {{ $attributes->whereDoesntStartWith('wire:click')->merge(['class' => 'button-primary']) }}
            @if ($spinner) wire:target="{{ $spinnerTarget }}"
                wire:loading.attr="disabled" @endif>
            @if ($icon)
                <x-yali::icon name="{{ $icon }}" class="h-6 w-6 text-red-600" />
            @endif
            @if ($label)
                {{ $label }}
            @endif
            <svg wire:loading wire:target="{{ $spinnerTarget }}" aria-hidden="true" role="status"
                class="inline w-4 h-4 ms-3 text-white animate-spin" viewBox="0 0 100 101" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="#E5E7EB" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentColor" />
            </svg>
        </button>
        <div class="fixed inset-0 z-50" style="display: none" x-show="open">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-on:click="open = false" x-cloak
                    x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div>
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <x-yali::icon name="exclamation" class="h-6 w-6 text-red-600" />
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                {{ $confirmTitle ?? 'Are you sure?' }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    {{ $confirmText ?? 'Are you sure you want to proceed?' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
                            <button type="button" dusk="confirm-confirmed"
                                {{ $attributes->whereStartsWith('wire:click') }} x-on:click="open = false"
                                class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm">
                                Yes, I'm sure
                            </button>
                        </span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
                            <button type="button"
                                class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm"
                                x-on:click="open = false">
                                Cancel
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if ($link)
        <a href="{!! $link !!}" @else <button @endif
                wire:key="hello-{{ md5(serialize(rand())) }}"
                {{ $attributes->merge(['class' => 'button-primary inline-flex justify-center']) }}
                @if ($spinner) wire:target="{{ $spinnerTarget }}"
    wire:loading.attr="disabled" @endif>
                <svg wire:loading wire:target="{{ $spinnerTarget }}" aria-hidden="true" role="status"
                    class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor" />
                </svg>
                @if ($icon)
                    <x-yali::icon name="{{ $icon }}" class="h-6 w-6 text-red-600" />
                @endif
                @if ($label)
                    {{ $label }}
                @endif
                @if (!$link)
                    </button>
                @else
            </a>
        @endif
    @endif

</div>
