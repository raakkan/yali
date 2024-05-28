@php
    $fields = $class->getFields();
    $modalPosition = $class->getModalPosition();
@endphp

@if ($class->isModal())
    <div class="{{ $modalPosition === 'center' ? 'flex justify-center items-center' : '' }}">
        <div class="bg-white rounded-lg w-full m-4 max-h-[calc(100vh-2rem)] flex flex-col max-w-md">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $title ?? 'Modal Title' }}
                </h3>
            </div>

            <div class="flex-1 overflow-y-auto">
                <form wire:submit.prevent="submit" class="{{ $class->getClasses() }} flex flex-col h-full"
                    style="{{ $class->getStyles() }}">
                    <div class="p-4 flex-1 overflow-y-auto">
                        <div class="grid-layout" data-cols="{{ $class->getGridColumns() }}"
                            data-gap="{{ $class->getGap() }}">
                            @foreach ($fields as $field)
                                {!! $field->render() !!}
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 border-t sticky bottom-0 bg-white rounded-b-lg">
                        <button class="btn btn-sm" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
