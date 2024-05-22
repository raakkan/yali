<div class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg">
    <div class="px-4 py-6 border-b dark:border-gray-600">
        <h2 class="text-2xl font-semibold">{{ $this->getResource()->getTitle() }}</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-400">Manage and configure .</p>
    </div>
    <div class="p-4 bg-white dark:bg-gray-900 flex items-center justify-between">
        <div>
            @foreach ($headerActions as $action)
                {{ $action->setLivewire($this)->setResource($this->getResource())->setModel($this->getModel())->render() }}
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

    <div class="p-4 bg-white dark:bg-gray-900">
        <div class="flex items-center">
            @foreach ($filters as $filter)
                {{ $filter->render() }}
            @endforeach
        </div>
    </div>

    {{-- TODO: no data found message --}}
    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <x-yali::table.header :columns="$columns" :sortColumn="$sortColumn" :sortDirection="$sortDirection" :actions="$actions" />
            <tbody>
                @foreach ($modelData as $data)
                    <x-yali::table.row :data="$data" :columns="$columns">
                        <x-slot name="actions">
                            @foreach ($actions as $action)
                                {{ $action->setResource($this->getResource())->setModel($data)->render() }}
                            @endforeach
                        </x-slot>
                    </x-yali::table.row>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($modelData->hasPages())
        <div class="px-3 pb-3">
            {{ $modelData->links('yali::pagination') }}
        </div>
    @endif
</div>
