<div>
    {{-- @foreach ($fields as $item)
        @if ($item->type == 'text')
            <input type="text" name="{{ $item->name }}" id="{{ $item->name }}"
                placeholder="{{ $item->getPlaceholder() }}">
        @endif
        @if ($item->type == 'textarea')
            <textarea name="{{ $item->name }}" id="{{ $item->name }}" placeholder="{{ $item->getPlaceholder() }}"></textarea>
        @endif
    @endforeach --}}

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="inline-flex items-center space-x-4 rounded-lg bg-white px-4 py-2 text-sm font-medium border">
            <li class="inline-flex items-center">
                <a href="#" class="text-gray-500 hover:text-gray-600">Home</a>
            </li>
            <li class="inline-flex items-center space-x-4">
                <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <a href="#" class="text-gray-500 hover:text-gray-600">Components</a>
            </li>
            <li class="inline-flex items-center space-x-4" aria-current="page">
                <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <a class="text-gray-700 hover:text-gray-700">Breadcrumb</a>
            </li>
        </ol>
    </nav>

    @livewire('yali::resource-table', ['resource' => $resource], key('resource-table-' . $resource))
</div>
