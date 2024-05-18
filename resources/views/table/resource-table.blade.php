<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-white dark:bg-gray-900">
            @if ($this->getTable()->isAnyColumnSearchable())
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
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
                                <x-yali::icon-mark class="text-gray-500 h-5 w-5 -ml-7" />
                            </button>
                        @endif
                    </div>
                </div>
            @endif
            <div class="flex items-center mt-4">
                @foreach ($filters as $filter)
                    {{ $filter->render() }}
                @endforeach
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <x-yali::table.header :columns="$columns" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
            <tbody>
                @foreach ($modelData as $data)
                    <x-yali::table.row :data="$data" :columns="$columns">
                        <x-slot name="actions">
                            <x-yali::ui.button label="Delete"
                                class="bg-transparent text-red-500 p-0 m-0 ml-2 hover:bg-transparent shadow-none"
                                spinner confirm confirmTitle="Delete Record"
                                confirmText="Are you sure you want to delete this record?" spinnerTarget="deleteRecord"
                                wire:click="delete('{{ $data['id'] }}')" />
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </x-slot>
                    </x-yali::table.row>
                @endforeach
            </tbody>
        </table>

    </div>
    {{ $modelData->links('yali::pagination') }}
</div>
