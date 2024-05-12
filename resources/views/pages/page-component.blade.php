<div>
    @php
        $menus = app()
            ->make(Raakkan\Yali\Core\Support\Navigation\NavigationManager::class)
            ->getMenus();
    @endphp

    @foreach ($menus as $menu)
        @foreach ($menu as $item)
            @if ($item['type'] === 'page' && request()->routeIs('yali::pages.' . $item['pageId']))
                @livewire('yali::pages.' . $item['pageId'], ['pageId' => $item['pageId']], key($item['pageId']))
            @break
        @endif
        @if ($item['type'] === 'resource' && request()->routeIs('yali::resources.' . $item['pageId']))
            @livewire('yali::resource-page', ['resourceId' => $item['pageId']], key($item['pageId']))
        @break
    @endif
@endforeach
@endforeach
</div>
