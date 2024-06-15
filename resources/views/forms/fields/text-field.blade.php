<x-yali::forms.field-wrapper :name="$class->getName()" :class="$class" :label="$class->getLabel()" :error="$errors->has($class->getName()) ? $errors->first($class->getName()) : null" :info="$class->getInfoMessage()">
    <input x-ref="{{ $class->getName() }}" type="{{ $class->getType() === 'password' ? 'password' : $class->getType() }}"
        id="{{ $class->getName() }}" class="{{ $errors->has($class->getName()) ? 'input-error' : 'input' }} pr-10"
        placeholder="{{ $class->getPlaceholder() }}" wire:model="inputs.{{ $class->getName() }}">
    @if ($class->getType() === 'password')
        @include('yali::forms.fields.utils.password-toggle-button', ['refId' => $class->getName()])
    @endif
</x-yali::forms.field-wrapper>
