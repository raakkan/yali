<div class="bg-white rounded-lg overflow-hidden flex flex-col border border-gray-200 dark:border-gray-600">
    <div class="px-4 py-3 bg-gray-100 border-b border-gray-200">
        <h3 class="text-xl font-semibold text-gray-800">{{ $translation->key }}</h3>
    </div>
    <div class="px-4 py-4 flex-1 overflow-hidden">
        <div class="h-full overflow-y-auto">
            <p class="text-gray-700 text-base line-clamp-3">{{ $translation->value }}</p>
        </div>
    </div>
    <div class="px-4 py-3 bg-gray-100">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                @if ($translation->translationCategory)
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        {{ $translation->translationCategory->name ?? '' }}
                    </span>
                @endif
                <span
                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                    {{ $translation->group }}
                </span>
            </div>
            <div class="flex items-center space-x-2">
                <button class="text-indigo-600 hover:text-indigo-700 focus:outline-none">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </button>
                <button class="text-red-600 hover:text-red-700 focus:outline-none">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
