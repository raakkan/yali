@php
    $label = $field->getLabelComponent();

    if ($errors->has($field->getName())) {
        $label->addClass('input-label-error');
    } else {
        $label->addClass('input-label');
    }
@endphp

<div class="grid-col-span-{{ $field->getColSpan() }}">
    @if (
        $field->getLabelPosition() === 'top-left' ||
            $field->getLabelPosition() === 'top-center' ||
            $field->getLabelPosition() === 'top-right')
        <div
            class="flex mb-2 {{ $field->getLabelPosition() === 'top-right'
                ? 'justify-end'
                : ($field->getLabelPosition() === 'top-left'
                    ? 'justify-start'
                    : ($field->getLabelPosition() === 'top-center'
                        ? 'justify-center'
                        : '')) }}">
            {!! $label->render() !!}
        </div>
    @endif

    @if ($field->getLabelPosition() === 'left' || $field->getLabelPosition() === 'right')
        <div
            class="flex items-center w-full {{ $field->getLabelPosition() === 'right' ? 'flex-row-reverse' : 'flex-row' }}">
            <div class="w-1/2 {{ $field->getLabelPosition() === 'right' ? 'ml-2' : 'mr-2' }}">
                {!! $label->render() !!}
            </div>
            <div class="relative w-1/2">
                {{ $slot }}
            </div>
        </div>
    @else
        <div class="relative">
            {{ $slot }}
        </div>
    @endif

    @if (
        $field->getLabelPosition() === 'bottom-left' ||
            $field->getLabelPosition() === 'bottom-center' ||
            $field->getLabelPosition() === 'bottom-right')
        <div
            class="flex mt-2 {{ $field->getLabelPosition() === 'bottom-right'
                ? 'justify-end'
                : ($field->getLabelPosition() === 'bottom-left'
                    ? 'justify-start'
                    : ($field->getLabelPosition() === 'bottom-center'
                        ? 'justify-center'
                        : '')) }}">
            {!! $label->render() !!}
        </div>
    @endif

    @if ($errors->has($field->getName()))
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $errors->first($field->getName()) }}</p>
    @endif
</div>
