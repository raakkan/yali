<div>
    @php
        $pages = app()
            ->make(Raakkan\Yali\Core\Pages\PageManager::class)
            ->getPages();
    @endphp

    @foreach ($pages as $pageId => $page)
        @livewire($pageId, key($pageId))
    @endforeach
</div>
