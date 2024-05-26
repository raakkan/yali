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

        <!-- Modal panel -->
        <div {{ $attributes->except('x-on:click')->merge(['class' => 'overflow-hidden transform transition-all']) }}
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            {{ $slot }}
        </div>
    </div>
</div>
