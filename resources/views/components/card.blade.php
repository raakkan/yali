@props(['title', 'subtitle', 'headerSlot' => null])

<div class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg">
    <div class="px-4 py-6 border-b dark:border-gray-600 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold">{{ $title }}</h2>
            @if (isset($subtitle) && $subtitle)
                <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $subtitle }}</p>
            @endif
        </div>
        <div>
            @isset($headerSlot)
                {{ $headerSlot }}
            @endisset
        </div>
    </div>
    <div class="">
        {{ $slot }}
    </div>
</div>
