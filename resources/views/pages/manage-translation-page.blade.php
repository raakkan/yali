<div class="bg-white rounded-lg shadow-md p-2 md:p-4">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 bg-gray-100 p-4 rounded-lg border">
        <div class="flex items-center">
            <img class="w-12 h-12 rounded-full mr-4"
                src="https://hatscripts.github.io/circle-flags/flags/language/{{ $language->code }}.svg"
                alt="{{ $language->name }} flag">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $language->name }}</h2>
                <p class="text-sm text-gray-600">Language Code: {{ $language->code }}</p>
            </div>
        </div>
        <div class="mt-4 md:mt-0">
            @php
                $actions = $this->getHeaderActions();
            @endphp

            @foreach ($actions as $action)
                {!! $action->setAdditionalData(['language_code' => $language->code])->render() !!}
            @endforeach
        </div>
    </div>

    <div class="mb-6">
        <x-yali::filter.filter-wrapper :filters="$this->getFilters()" :hasFilters="$this->hasFilters()" />
    </div>

    <div class="mb-6">
        <x-yali::forms.search wire:model.live.debounce.300ms="search" wire:click="clearSearch" :placeholder="'Search Translations...'"
            :hasSearch="$search" />
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @if (count($translations) > 0)
            @foreach ($translations as $translation)
                @php
                    $actions = $this->getActions($translation);
                @endphp
                <x-yali::translations.card :translation="$translation" :actions="$actions" />
            @endforeach
        @else
            <div class="col-span-full text-center text-gray-600">
                No translations found.
            </div>
        @endif
    </div>

    @if ($translations->hasPages())
        <div class="mt-6">
            {{ $translations->links('yali::pagination') }}
        </div>
    @endif
</div>
