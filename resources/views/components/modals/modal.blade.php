@props(['position' => 'center'])

<div class="fixed inset-0 z-50">
    <div class="min-w-full min-h-screen">
        <!-- Background overlay with blur effect -->
        <div class="fixed inset-0 transition-opacity backdrop-filter backdrop-blur-sm" aria-hidden="true" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            {{ $attributes->whereStartsWith('x-on:click') }}>
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div>
            <div x-show="open" x-cloak
                class="fixed w-full {{ $position === 'left' ? 'left-0 top-0 bottom-0' : ($position === 'right' ? 'right-0 top-0 bottom-0' : ($position === 'top' ? 'top-0 left-0 right-0' : ($position === 'bottom' ? 'bottom-0 left-0 right-0' : 'inset-0'))) }}"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 {{ $position === 'left' ? '-translate-x-full' : ($position === 'right' ? 'translate-x-full' : ($position === 'top' ? '-translate-y-full' : ($position === 'bottom' ? 'translate-y-full' : 'scale-90'))) }}"
                x-transition:enter-end="opacity-100 translate-x-0 translate-y-0 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 {{ $position === 'left' ? '-translate-x-full' : ($position === 'right' ? 'translate-x-full' : ($position === 'top' ? '-translate-y-full' : ($position === 'bottom' ? 'translate-y-full' : 'scale-90'))) }}"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
