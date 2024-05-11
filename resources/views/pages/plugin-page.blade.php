<div class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg">
    <div class="px-4 py-6 border-b dark:border-gray-600">
        <h2 class="text-2xl font-semibold">Plugins</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-400">Manage and configure installed plugins.</p>
    </div>
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($plugins as $plugin)
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-600 rounded-lg shadow-md overflow-hidden">
                    <div class="flex items-center justify-center h-48 bg-gray-100 dark:bg-gray-700">
                        @if ($plugin->logo)
                            <img src="{{ $plugin->logo }}" alt="{{ $plugin->name }}" class="max-h-32">
                        @else
                            <span class="text-4xl text-gray-400">{{ substr($plugin->name, 0, 1) }}</span>
                        @endif
                    </div>
                    @if (empty($plugin->invalidFields))
                        <div class="p-4">
                            <h3 class="text-xl font-semibold mb-2">{{ $plugin->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $plugin->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Version {{ $plugin->version }}</span>
                                <a href="{{ $plugin->url }}" target="_blank" class="text-blue-500 hover:underline">View
                                    Details</a>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-gray-100 dark:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">By {{ $plugin->author }}</span>
                                <button class="px-2 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                                    {{ $plugin->active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="p-4">
                            <h3 class="text-xl font-semibold mb-2 text-red-500">Invalid Plugin</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">This plugin is missing required
                                information:
                            </p>
                            <ul class="list-disc list-inside text-red-500">
                                @foreach ($plugin->invalidFields as $field)
                                    <li>{{ ucfirst($field) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
