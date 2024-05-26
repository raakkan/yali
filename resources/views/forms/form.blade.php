@php
    $fields = $class->getFields();
@endphp

<form wire:submit.prevent="submit" class="grid grid-flow-row md:grid-cols-2 gap-4 {{ $class->getClasses() }}"
    style="{{ $class->getStyles() }}">
    @foreach ($fields as $field)
        @if ($field instanceof \Raakkan\Yali\Core\Forms\TextField)
            <div class="col-span-1">
                <x-yali::forms.text-field :field="$field" wire:model="data.{{ $field->getName() }}" />
            </div>
        @elseif ($field instanceof \Raakkan\Yali\Core\Forms\TextAreaField)
            <x-yali::forms.textarea-field :field="$field" wire:model="data.{{ $field->getName() }}" />
        @elseif ($field instanceof \Raakkan\Yali\Core\Forms\SwitchField)
            <x-yali::forms.switch-field :field="$field" wire:model="data.{{ $field->getName() }}" />
        @endif
    @endforeach

    <div class="col-span-full">
        <button class="btn" type="submit">Create</button>
    </div>
</form>
