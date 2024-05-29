@php
    $fields = $class->getFields();
@endphp

@if ($class->isModal())
    <form wire:submit.prevent="submit" class="{{ $class->getClasses() }} flex flex-col h-full"
        style="{{ $class->getStyles() }}">
        <div class="p-4 flex-1 overflow-y-auto">
            <div class="grid-layout" data-cols="{{ $class->getGridColumns() }}" data-gap="{{ $class->getGap() }}">
                @foreach ($fields as $field)
                    {!! $field->render() !!}
                @endforeach
            </div>
        </div>
        <div class="p-4 border-t sticky bottom-0 bg-white rounded-b-lg">
            <button class="btn btn-sm" type="submit">Create</button>
        </div>
    </form>
@endif
