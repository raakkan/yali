<div>
    {{-- @php
        $pages = app()
            ->make(Raakkan\Yali\Core\Pages\PageManager::class)
            ->getPages();
    @endphp

    @foreach ($pages as $pageId => $page)
        @livewire('yali::pages.' . $pageId, key($pageId))
    @endforeach --}}
    @csrf
    <input type="text" wire:model="name">
    <button wire:click="save">Save</button>
</div>
