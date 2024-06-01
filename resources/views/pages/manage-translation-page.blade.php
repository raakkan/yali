<div class="">
    <div class="bg-white rounded-lg shadow-md p-4 md:p-6">
        <div class="space-y-6">
            <div class="flex items-center bg-gray-100 p-4 rounded-lg border">
                <img class="w-12 h-12 rounded-full mr-4"
                    src="https://hatscripts.github.io/circle-flags/flags/language/{{ $language->code }}.svg"
                    alt="{{ $language->name }} flag">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $language->name }}</h2>
                    <p class="text-gray-600">Language Code: {{ $language->code }}</p>
                </div>
            </div>
            {{-- <div class="flex items-center justify-between">
                <button class="btn btn-primary btn-sm">Create Translation</button>
                <button class="btn btn-primary btn-sm">Create Translation Category</button>
            </div> --}}

            <x-yali::filter.filter-wrapper :filters="$this->getFilters()" :hasFilters="$this->hasFilters()" />
        </div>

        <div class="pt-4">
            <x-yali::forms.search wire:model.live.debounce.300ms="search" wire:click="clearSearch" :wrapperClass="'mb-4'"
                :label="'Search Translations'" :placeholder="'Search Translations...'" :hasSearch="$search" />
        </div>
        <div class="space-y-6 pt-4">
            @if (count($translations) > 0)
                @foreach ($translations as $translation)
                    <div class="bg-gray-100 border rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ $translation->translationCategory->name ?? '' }}</h2>
                            <span class="text-gray-500">{{ $translation->group }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            {{ $translation->key }}
                            {{ $translation->value }}
                            {{ $translation->defaultTranslation?->value }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


        @if ($translations->hasPages())
            {{-- TODO: pagination cache --}}
            {{ $translations->links('yali::pagination') }}
        @endif
    </div>
</div>
