<div class="grid-col-span-{{ $field->getColSpan() }}">
    <label for="{{ $field->getName() }}"
        class="{{ $errors->has($field->getName()) ? 'input-label-error' : 'input-label' }}">
        {{ $field->getLabel() }}
    </label>

    <div class="inline w-full" x-data="richEditor(@js($field->getLivewireData()), @js($field->getFormId()), @js($field->getName()))" x-init="initEditor($refs['wrapper_{{ $field->getId() }}'], $refs['editor_{{ $field->getId() }}'])" x-ref="wrapper_{{ $field->getId() }}"
        wire:ignore>

        <x-yali::forms.rich-editor-toolbar :fieldId="$field->getId()" />

        <div x-ref="editor_{{ $field->getId() }}"
            class="w-full min-h-[200px] p-4 bg-white border-x border-b border-gray-200 rounded-b-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
    </div>

    @if ($errors->has($field->getName()))
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $errors->first($field->getName()) }}</p>
    @endif

    @if ($field->getInfoMessage())
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $field->getInfoMessage() }}</p>
    @endif
</div>
