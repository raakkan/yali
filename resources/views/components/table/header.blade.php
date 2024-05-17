@props(['columns', 'sortColumn', 'sortDirection'])

<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        @foreach ($columns as $column)
            <th scope="col" class="px-6 py-3 @if ($column->isSortable()) cursor-pointer @endif"
                @if ($column->isSortable()) wire:click="sortBy('{{ $column->getName() }}')" @endif>
                <div class="flex items-center">
                    {{ $column->getLabel() }}
                    @if ($column->isSortable())
                        @if ($sortColumn === $column->getName())
                            @if ($sortDirection === 'asc')
                                <x-yali::icon-sort-ascending class="w-4 h-4 ms-1" />
                            @else
                                <x-yali::icon-sort-descending class="w-4 h-4 ms-1" />
                            @endif
                        @else
                            <x-yali::icon-sort class="w-4 h-4 ms-1 text-gray-400" />
                        @endif
                    @endif
                </div>
            </th>
        @endforeach
        @if (isset($actions))
            <th scope="col" class="px-6 py-3">Actions</th>
        @endif
    </tr>
</thead>
