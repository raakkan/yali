@php
    $fields = $class->getFields();
@endphp

<form wire:submit.prevent="submit" class="{{ $class->getClasses() }}" style="{{ $class->getStyles() }}">
    <div class="grid-layout" data-cols="{{ $class->getGridColumns() }}" data-gap="{{ $class->getGap() }}">
        @foreach ($fields as $field)
            {!! $field->render() !!}
        @endforeach

        <div class="col-span-full">
            <button class="btn" type="submit">Create</button>
        </div>
    </div>
</form>
