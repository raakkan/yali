<div class="">
    <div class="bg-white rounded-lg shadow-md p-3 md:p-4">
        <div class="space-y-6">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 rounded-lg shadow-lg overflow-hidden">
                <div class="px-4 md:px-6 py-2 md:py-4">
                    <div class="flex items-center">
                        <img class="w-10 md:w-16 h-10 md:h-16 rounded-full mr-6"
                            src="https://hatscripts.github.io/circle-flags/flags/language/{{ $language->code }}.svg"
                            alt="{{ $language->name }} flag">
                        <div>
                            <h3 class="text-xl md:text-2xl font-semibold text-white">{{ $language->name }}</h3>
                            <p class="text-sm md:text-lg text-purple-200">Language Code: {{ $language->code }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <x-yali::filter.filter-wrapper :filters="$this->getFilters()" :hasFilters="$this->hasFilters()" />
        </div>

        <div class="mt-8">
            <x-yali::forms.search wire:model.live.debounce.300ms="search" wire:click="clearSearch" :wrapperClass="'mb-4'"
                :label="'Search Translations'" :placeholder="'Search Translations...'" :hasSearch="$search" />
        </div>

        <div class="grid grid-cols-1 gap-6 pt-4 sm:grid-cols-2 lg:grid-cols-3" x-data="{ truncateLines: window.innerWidth < 640 ? 2 : 3 }">
            @if (count($translations) > 0)
                @foreach ($translations as $translation)
                    <x-yali::translations.card :translation="$translation" />
                @endforeach
            @endif
        </div>

        @if ($translations->hasPages())
            {{-- TODO: pagination cache --}}
            {{ $translations->links('yali::pagination') }}
        @endif
    </div>
</div>
