<div class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg">
    <div class="px-4 py-6 border-b dark:border-gray-600">
        <h2 class="text-2xl font-semibold">{{ $this->getResource()->getPluralTitle() }}</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-400">Manage and configure .</p>
    </div>
    <div class="p-4 bg-white dark:bg-gray-900 flex flex-col md:flex-row items-center justify-between">
        <div>
            @foreach ($headerActions as $action)
                {{ $action->setSource($this->getResource())->setModel($this->getModel())->render() }}
            @endforeach
        </div>
        @if ($this->getTable()->isAnyColumnSearchable())
            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <input type="text" id="table-search" wire:model.live="search"
                            class="block pt-2 ps-10 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for items">
                        @if ($search)
                            <button wire:click="clearSearch" class="flex items-center pe-3">
                                <x-yali::icon name="mark" class="text-gray-500 h-5 w-5 -ml-7" />
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    @php
        $visibleFilters = array_filter($filters, function ($filter) {
            return !$filter->isHidden();
        });
    @endphp
    @if (count($visibleFilters) > 0)
        {{-- TODO: implament filter applyed cache --}}
        <div class="p-4 bg-white dark:bg-gray-800 border-b dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Filters</h3>
                <button wire:click="clearAllFilters"
                    class="btn btn-xs {{ $this->hasFilters() ? 'btn-primary' : 'btn-ghost cursor-not-allowed' }}"
                    type="button" {{ $this->hasFilters() ? '' : 'disabled' }}>
                    Clear Filters
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($visibleFilters as $filter)
                    @if (!$filter->isHidden())
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-md p-4">
                            {{ $filter->render() }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <x-yali::table.header :columns="$columns" :actions="$actions" />
            <tbody>
                @forelse ($modelData as $data)
                    <x-yali::table.row :data="$data" :columns="$columns">
                        <x-slot name="actions">
                            @foreach ($actions as $action)
                                {{ $action->setSource($this->getResource())->setModel($data)->render() }}
                            @endforeach
                        </x-slot>
                    </x-yali::table.row>
                @empty
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400" colspan="{{ count($columns) }}">
                            <p class="text-gray-500 dark:text-gray-400">No data found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($modelData->hasPages())
        <div class="px-3 pb-3">
            {{-- TODO: pagination cache --}}
            {{ $modelData->links('yali::pagination') }}
        </div>
    @endif
</div>
