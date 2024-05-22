@props(['data'])

<x-yali::ui.button wire:key="edit-" label="Delete" spinner
    class="bg-transparent text-red-500 p-0 m-0 ml-2 hover:bg-transparent shadow-none"
    wire:yali-confirm="{title: 'Delete {{ $this->getResource()->getTitle() }}', message: 'Are you sure you want to delete this {{ $this->getResource()->getTitle() }}?'}"
    wire:click="delete" />
