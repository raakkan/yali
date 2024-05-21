@props(['data'])

<x-yali::ui.button wire:key="edit-{{ $data['id'] }}" label="Delete" spinner
    class="bg-transparent text-red-500 p-0 m-0 ml-2 hover:bg-transparent shadow-none"
    wire:yali-confirm="{title: 'Delete {{ $this->getResource()->getTitle() }}', message: 'Are you sure you want to delete this {{ $this->getResource()->getTitle() }}?', payload: '{{ $data['id'] }}'}"
    wire:click="delete('{{ $data['id'] }}')" />
