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
                    <input type="text" id="table-search" wire:model.live="search"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for items">
                </div>
            @endif
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-6 py-3 cursor-pointer"
                            wire:click="sortBy('{{ $column->getName() }}')">
                            <div class="flex items-center">
                                {{ $column->getLabel() }}
                                @if ($column->isSortable())
                                    @if ($sortColumn === $column->getName())
                                        @if ($sortDirection === 'asc')
                                            <x-yali::icons.sort-ascending class="w-4 h-4 ms-1" />
                                        @else
                                            <x-yali::icons.sort-descending class="w-4 h-4 ms-1" />
                                        @endif
                                    @else
                                        <x-yali::icons.sort class="w-4 h-4 ms-1 text-gray-400" />
                                    @endif
                                @endif
                            </div>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($modelData as $data)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        @foreach ($columns as $column)
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data[$column->getName()] }}
                            </th>
                        @endforeach

                        <td class="px-6 py-4">
                            <x-yali::ui.button label="Delete"
                                class="bg-transparent text-red-500 p-0 m-0 ml-2 hover:bg-transparent shadow-none"
                                spinner confirm confirmTitle="Delete Record"
                                confirmText="Are you sure you want to delete this record?" spinnerTarget="deleteRecord"
                                wire:click="delete('{{ $data['id'] }}')" />
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $modelData->links('yali::pagination') }}
</div>
