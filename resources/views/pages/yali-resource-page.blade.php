<x-yali::card title="{{ $this->getTitle() }}" subtitle="Handle Resource Page" class="w-full">
    <div class="m-2 md:m-4 space-y-5">
        <x-yali::forms.search wire:model.live.debounce.300ms="search" wire:click="clearSearch" :placeholder="'Search Translations...'"
            :hasSearch="$search" />
        <x-yali::filter.filter-wrapper :filters="$this->getFilters()" :hasFilters="$this->hasFilters()" />
    </div>

    {{ $table->render() }}

    @if ($records->hasPages() && count($columns) > 0)
        <div class="px-3 pb-3">
            {{ $records->links('yali::pagination') }}
        </div>
    @endif
</x-yali::card>
