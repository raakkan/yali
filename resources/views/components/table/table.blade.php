<div class="relative overflow-x-auto ">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <x-yali::table.header :columns="$columns" :actions="$actions" />
        <tbody>
            @if (count($columns) > 0)
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
