<div>
    @foreach ($fields as $item)
        @if ($item->type == 'text')
            <input type="text" name="{{ $item->name }}" id="{{ $item->name }}"
                placeholder="{{ $item->getPlaceholder() }}">
        @endif
        @if ($item->type == 'textarea')
            <textarea name="{{ $item->name }}" id="{{ $item->name }}" placeholder="{{ $item->getPlaceholder() }}"></textarea>
        @endif
    @endforeach
</div>
