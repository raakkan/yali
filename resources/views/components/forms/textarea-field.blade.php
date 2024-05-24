<div class="mb-4">
    <label for="{{ $attributes->get('name') }}">{{ $attributes->get('label') }}</label>
    <textarea id="{{ $attributes->get('name') }}" {{ $attributes->whereStartsWith('wire:model')->first() }}
        class="form-textarea"></textarea>
</div>
