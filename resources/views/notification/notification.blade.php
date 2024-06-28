<div class="flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <div class="bg-white rounded-full p-0.5">
            <svg class="w-8 h-8 text-[#6ad45c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12 0C5.62 0 0 5.62 0 12s5.62 12 12 12 12-5.62 12-12S18.38 0 12 0zm5.3 9L11 15.3l-4.3-4.3 1.41-1.42L11 12.47l5.3-5.3 1.41 1.41z" />
            </svg>
        </div>
        <div>
            <p class="font-bold">{{ $notification->getTitle() }}</p>
            @if ($notification->hasMessage())
                <p class="text-sm">{{ $notification->getMessage() }}</p>
            @endif
        </div>
    </div>
    <button type="button" @click="show = false" class="text-white hover:text-gray-100">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd"
                d="M18.364 5.636a1 1 0 010 1.414L13.414 12l5.95 5.95a1 1 0 01-1.414 1.414L12 13.414l-5.95 5.95a1 1 0 01-1.414-1.414L10.586 12 4.636 6.05a1 1 0 111.414-1.414L12 10.586l5.95-5.95a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
    </button>
</div>
