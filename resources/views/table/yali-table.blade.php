<div class="relative overflow-x-auto ">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <x-yali::table.header :columns="$class->getColumns()" />
        <tbody>
            @if (count($class->getColumns()) > 0)
                @forelse ($class->getRecords() as $data)
                    <x-yali::table.row :data="$data" :columns="$class->getColumns()" />
                @empty
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"
                            colspan="{{ count($class->getColumns()) }}">
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
