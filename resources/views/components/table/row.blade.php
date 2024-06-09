@props(['data', 'columns'])

<tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    @foreach ($columns as $column)
        <td data-label="{{ $column->getLabel() }}" class="px-6 py-4">
            {!! $column->renderCell($data) !!}
        </td>
    @endforeach
    @if (isset($actions))
        <td data-label="Actions" class="px-6 py-4 space-x-1">
            {{ $actions }}
        </td>
    @endif
</tr>
