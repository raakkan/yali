<div class="inline-block" x-data="{ open: false }">
    @php
        $button = $this->getModalData()['button'];
        $button->setAttributes([
            'x-on:click' => 'open = true',
        ]);
    @endphp
    @if ($button)
        {!! $button->render() !!}
    @endif

    <div x-show="open" x-cloak>
        <x-yali::modals.modal class="flex items-center justify-center">
            <div class="bg-white rounded-lg w-full m-4 relative">
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $title ?? 'Modal Title' }}
                    </h3>
                    <button type="button" class="btn btn-ghost btn-circle btn-icon p-1" x-on:click="open = false">
                        <x-yali::icon name="mark" />
                    </button>
                </div>
                <div class="p-4">
                    {{ $this->getForm()->render() }}
                </div>
            </div>
        </x-yali::modals.modal>

    </div>
</div>
