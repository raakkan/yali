@props(['title', 'description'])

<div class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg">
    <div class="px-4 py-6 border-b dark:border-gray-600">
        <h2 class="text-2xl font-semibold">{{ $title }}</h2>
        {{-- <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $description }}</p> --}}
    </div>
    <div class="p-4">
        {{ $slot }}
    </div>
</div>
