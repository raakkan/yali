<div class="grid-col-span-{{ $field->getColSpan() }}">
    <label for="{{ $field->getName() }}"
        class="{{ $errors->has($field->getName()) ? 'input-label-error' : 'input-label' }}">
        {{ $field->getLabel() }}
    </label>

    <div wire:ignore>
        @php
            $id = 'yali-vue-' . md5(serialize(rand()));
        @endphp

        <div class="inline w-full" id="{{ $id }}" data-vue="rich-editor">
            <rich-editor :content="@js($field->getLivewireData())" :form-id="@js($field->getFormId())" :field-name="@js($field->getName())" />
        </div>
    </div>

    @if ($errors->has($field->getName()))
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $errors->first($field->getName()) }}</p>
    @endif

    @if ($field->getInfoMessage())
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $field->getInfoMessage() }}</p>
    @endif
</div>
