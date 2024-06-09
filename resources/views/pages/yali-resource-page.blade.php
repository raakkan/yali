<x-yali::card title="{{ $this->getTitle() }}" subtitle="{{ $this->getSubtitle() }}" class="w-full">
    <x-slot name="headerSlot">
        @php
            $actions = $table->getHeaderActions();
        @endphp
        @foreach ($actions as $action)
            {!! $action->render() !!}
        @endforeach
    </x-slot>
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
