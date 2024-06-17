@if ($table->getResponsiveConfig()['enabled'])
    <style>
        @media (max-width: {{ $table->getResponsiveConfig()['maxWidth'] }}px) {
            table thead {
                display: none;
            }

            table tbody tr {
                display: block;
            }

            table tbody td {
                display: block;
                text-align: right;
                font-size: 0.875rem;
            }

            table tbody td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>
@endif

<div class="overflow-x-auto w-full">
    <table class="w-full md:table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <x-yali::table.header :columns="$table->getColumns()" :actions="$table->getActions()" />

        <tbody
            class="divide-y divide-gray-200 dark:divide-gray-700 border-y border-gray-200 dark:border-gray-700 rtl:border-l-0">
            @if (count($table->getColumns()) > 0)
                @forelse ($table->getRecords() as $data)
                    <x-yali::table.row :data="$data" :columns="$table->getColumns()">
                        <x-slot name="actions">
                            @foreach ($table->getActions() as $action)
                                {{ $action->setModel($data)->render() }}
                            @endforeach
                        </x-slot>
                    </x-yali::table.row>
                @empty
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"
                            colspan="{{ count($table->getColumns()) }}">
                            <p class="text-gray-500 dark:text-gray-400">No data found.</p>
                        </td>
                    </tr>
                @endforelse
            @else
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        {{-- TODO: add docs link --}}
                        <p class="text-gray-500 dark:text-gray-400">No table columns found. Go to
                            {{-- <strong>{{ get_class($this->getResource()) }}</strong>  --}}
                            file to
                            add columns. <a href="http://raakkan.github.io/yali/" class="underline text-blue-600"
                                target="_blank" rel="noopener noreferrer">Read the docs</a>
                        </p>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
