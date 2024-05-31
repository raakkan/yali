@props(['columns', 'sortColumn', 'sortDirection', 'actions'])

<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    @if (count($columns) > 0)
        <tr>
            @foreach ($columns as $column)
                <th scope="col" class="px-6 py-3 @if ($column->isSortable()) cursor-pointer @endif"
                    @if ($column->isSortable()) wire:click="sortBy('{{ $column->getName() }}')" @endif>
                    <div class="flex items-center">
                        {{ $column->getLabel() }}
                        @if ($column->isSortable())
                            @php
                                $sort = $this->getSort();
                            @endphp
                            @foreach ($sort as $key => $data)
                                @if ($key === $column->getName())
                                    @if ($data === 'asc')
                                        <x-yali::icon name="sort-ascending" class="w-4 h-4 ms-1" />
                                    @elseif ($data === 'desc')
                                        <x-yali::icon name="sort-descending" class="w-4 h-4 ms-1" />
                                    @else
                                        <x-yali::icon name="sort" class="w-4 h-4 ms-1 text-gray-400" />
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </th>
            @endforeach
            @if (isset($actions))
                <th scope="col" class="px-6 py-3">Actions</th>
            @endif
        </tr>
    @endif
</thead>
