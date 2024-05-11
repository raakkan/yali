<div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($modelData->first()->toArray() as $key => $value)
                        <th scope="col" class="px-6 py-3">{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($modelData as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @foreach ($item->toArray() as $key => $value)
                            <td class="px-6 py-4">{{ is_array($value) ? $value['en'] ?? '' : $value }}</td>
                        @endforeach

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
