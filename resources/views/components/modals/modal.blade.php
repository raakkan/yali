@props([
    'position' => 'center',
    'maxWidth' => 'max-w-md',
    'bgColor' => 'bg-white',
    'rounded' => 'rounded-lg',
    'margin' => 'm-4',
    'title' => 'Modal Title',
    'subtitle' => null,
    'alertMessage' => null,
    'alertType' => null,
    'header' => true,
    'hideCloseButton' => false,
])

<div class="fixed inset-0 z-50">
    <div class="min-w-full min-h-screen">
        <!-- Background overlay with blur effect -->
        <div class="fixed inset-0 transition-opacity backdrop-filter backdrop-blur-sm" aria-hidden="true" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div>
            <div {{ $attributes->whereStartsWith('x-show') }} x-cloak
                class="fixed w-full {{ $position === 'left' ? 'left-0 top-0 bottom-0' : ($position === 'right' ? 'right-0 top-0 bottom-0' : ($position === 'top' ? 'top-0 left-0 right-0' : ($position === 'bottom' ? 'bottom-0 left-0 right-0' : 'inset-0'))) }}"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 {{ $position === 'left' ? '-translate-x-full' : ($position === 'right' ? 'translate-x-full' : ($position === 'top' ? '-translate-y-full' : ($position === 'bottom' ? 'translate-y-full' : 'scale-90'))) }}"
                x-transition:enter-end="opacity-100 translate-x-0 translate-y-0 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 {{ $position === 'left' ? '-translate-x-full' : ($position === 'right' ? 'translate-x-full' : ($position === 'top' ? '-translate-y-full' : ($position === 'bottom' ? 'translate-y-full' : 'scale-90'))) }}"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                @if ($header)
                    <div
                        class="{{ $position === 'center'
                            ? 'flex justify-center items-center'
                            : ($position === 'top' || $position === 'bottom'
                                ? 'flex justify-center'
                                : ($position === 'left'
                                    ? 'flex justify-start'
                                    : ($position === 'right'
                                        ? 'flex justify-end'
                                        : 'flex justify-end'))) }}">

                        <div class="w-full max-h-[calc(100vh-2rem)] flex flex-col {{ $bgColor }} {{ $rounded }} {{ $margin }} {{ $maxWidth }}"
                            {{ $attributes->whereStartsWith('@click.outside') }}
                            {{ $attributes->whereStartsWith('@keyup.escape.window') }}>
                            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ $title }}
                                    </h3>
                                    @if (isset($subtitle))
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $subtitle }}
                                        </p>
                                    @endif
                                </div>
                                @if (!$hideCloseButton)
                                    <button type="button" class="btn btn-transparent btn-sm btn-icon "
                                        {{ $attributes->whereStartsWith('x-on:click') }}>
                                        <x-yali::icon name="x" class="h-5 w-5" />
                                    </button>
                                @endif
                            </div>

                            @if (isset($alertMessage) && isset($alertType) && $alertMessage && $alertType)
                                <div class="p-4">
                                    <x-yali::ui.alert type="{{ $alertType }}" message="{{ $alertMessage }}" />
                                </div>
                            @endif

                            <div class="flex-1 overflow-y-auto">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                @else
                    {{ $slot }}
                @endif

            </div>
        </div>
    </div>
</div>
