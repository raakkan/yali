<x-yali::card title="Languages" description="Handle Resource Page" class="w-full">
    <div class="divide-y divide-gray-200">
        @foreach ($languages as $language)
            <div class="py-4 px-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <x-yali::image class="w-12 h-12 rounded-full" alt="{{ $language->name }}"
                        src="https://hatscripts.github.io/circle-flags/flags/language/{{ $language->code }}.svg" />
                    <div>
                        <h3 class="text-lg font-semibold">{{ $language->name }}</h3>
                        <p class="text-gray-500">Language Code: {{ $language->code }}</p>
                    </div>
                </div>
                <div
                    class="flex flex-row items-center justify-between md:justify-normal md:items-start md:flex-col md:space-y-4 mb-6 mt-2 md:mb-0 md:mt-0">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 rounded-full"
                            {{ $language->is_default ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Default</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 rounded-full"
                            {{ $language->is_active ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                </div>
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                    <a href="#" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                    <a href="#" class="btn btn-primary btn-sm">
                        Manage Translations
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-yali::card>
