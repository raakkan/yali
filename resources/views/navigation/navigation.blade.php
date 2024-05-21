<nav>
    <ul class="space-y-1 font-medium">
        @foreach ($items as $item)
            @if ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationItem)
                <li>
                    <a href="{{ route($item->getRouteName()) }}"
                        class="sidebar-link text-gray-500 {{ $item->isActive() ? 'active' : '' }}">
                        <x-yali::icon name="{{ $item->getIcon() }}" class="w-6 h-6 mr-3" />
                        <span>{{ $item->getLabel() }}</span>
                    </a>
                </li>
            @elseif ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationGroup)
                <li>
                    <span>{{ $item->getName() }}</span>
                    <ul>
                        @foreach ($item->getItems() as $groupItem)
                            <li>
                                <a href="{{ $groupItem->getRouteName() }}" class="sidebar-link">
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
