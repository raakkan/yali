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

    @livewire('yali::resource-table', ['resourceId' => $resourceId], key('resource-table-' . $resourceId))
</div>
