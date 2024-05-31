<div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 space-y-6">
            <div class="flex items-center bg-gray-100 p-4 rounded-lg border">
                <img class="w-12 h-12 rounded-full mr-4"
                    src="https://hatscripts.github.io/circle-flags/flags/language/{{ $language->code }}.svg"
                    alt="{{ $language->name }} flag">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $language->name }}</h2>
                    <p class="text-gray-600">Language Code: {{ $language->code }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-100 dark:bg-gray-900 rounded-md p-4">
                    <x-yali::forms.select label="Select an category"
                        selectClass="btn btn-white btn-bordered w-full mb-3" name="selectedCategory" :options="$translationCategories"
                        placeholder="Select a category" wire:model="selectedCategory"
                        placeholder="Select an category" />
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            @if (count($translations) > 0)
                <div class="flex flex-col">
                    @foreach ($translations as $translation)
                        <div class="flex items-center bg-slate-100 p-4 rounded-lg border">
                            <img class="w-12 h-12 rounded-full mr-4"
                                src="https://hatscripts.github.io/circle-flags/flags/language/{{ $translation->language->code }}.svg"
                                alt="{{ $translation->language->name }} flag">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">{{ $translation->key }}</h2>
                                <p class="text-gray-600">Language: {{ $translation->language->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center bg-slate-100 p-4 rounded-lg border">
                    <img class="w-12 h-12 rounded-full mr-4"
                        src="https://hatscripts.github.io/circle-flags/flags/language/{{ $language->code }}.svg"
                        alt="{{ $language->name }} flag">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">No translations found</h2>
                        <p class="text-gray-600">Language: {{ $language->name }}</p>
                    </div>
                </div>
            @endif
        </div>

        @if ($translations->hasPages())
            <div class="px-3 pb-3">
                {{-- TODO: pagination cache --}}
                {{ $translations->links('yali::pagination') }}
            </div>
        @endif
    </div>
</div>
