<div x-data="{ showPassword: false }">
    @php
        $hasError = $errors->has($class->getName());
    @endphp

    <label class="{{ $hasError ? 'input-label-error' : 'input-label' }}"
        for="{{ $class->getName() }}">{{ $class->getLabel() }}</label>
    <div class="relative">
        <input x-ref="{{ $class->getName() }}"
            type="{{ $class->getType() === 'password' ? 'password' : $class->getType() }}" id="{{ $class->getName() }}"
            class="{{ $hasError ? 'input-error' : 'input' }} pr-10" placeholder="{{ $class->getPlaceholder() }}">
        @if ($class->getType() === 'password')
            @include('yali::forms.fields.utils.password-toggle-button', ['refId' => $class->getName()])
        @endif
    </div>

    @error($class->getName())
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror
</div>
