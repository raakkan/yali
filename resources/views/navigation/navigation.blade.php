<nav>
    <ul class="space-y-2 font-medium">
        @foreach ($items as $item)
            @if ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationItem)
                <li>
                    <a href="{{ $item->getSlug() }}" class="sidebar-link">
                        {{ $item->getLabel() }}
                    </a>
                </li>
            @elseif ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationGroup)
                <li>
                    <span>{{ $item->getName() }}</span>
                    <ul>
                        @foreach ($item->getItems() as $groupItem)
                            <li>
                                <a href="{{ $groupItem->getUrl() }}" class="sidebar-link">
                                    {{ $groupItem->getLabel() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
