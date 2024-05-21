@props(['data'])

<x-yali::ui.button wire:key="edit-{{ $data['id'] }}" label="Edit" link="/edit"
    class="bg-transparent text-gray-500 p-0 m-0 ml-2 hover:bg-transparent shadow-none" />
