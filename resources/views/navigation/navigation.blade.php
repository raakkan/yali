<nav>
    <ul class="space-y-1 font-medium">
        @foreach ($items as $item)
            @if ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationItem)
                <li>
                    <a href="{{ route($item->getRouteName()) }}"
                        class="sidebar-link {{ $item->isActive() ? 'active' : '' }}">
                        @if ($item->getIcon())
                            <x-yali::icon name="{{ $item->getIcon() }}" class="w-6 h-6 mr-3" />
                        @endif
                        <span>{{ $item->getLabel() }}</span>
                    </a>
                </li>
            @elseif ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationGroup)
                <li x-data="{ dropdownOpen: {{ $item->hasActiveRoute() ? 'true' : 'false' }} }">
                    <button type="button" class="sidebar-link-dropdown-button" @click="dropdownOpen = !dropdownOpen">
                        @if ($item->getIcon())
                            <x-yali::icon name="{{ $item->getIcon() }}" class="w-6 h-6" />
                        @endif
                        <span>{{ $item->getName() }}</span>
                        <x-yali::icon x-show="dropdownOpen" name="chevron-up" class="w-5 h-5" x-cloak />
                        <x-yali::icon x-show="!dropdownOpen" name="chevron-down" class="w-5 h-5" x-cloak />
                    </button>
                    <ul class="sidebar-link-dropdown-list" x-show="dropdownOpen" x-cloak>
                        @foreach ($item->getItems() as $groupItem)
                            <li>
                                <a href="{{ route($groupItem->getRouteName()) }}"
                                    class="sidebar-link {{ $groupItem->isActive() ? 'active' : '' }}">
                                    @if ($groupItem->getIcon())
                                        <x-yali::icon name="{{ $groupItem->getIcon() }}" class="w-6 h-6 mr-3" />
                                    @endif
                                    <span>{{ $groupItem->getLabel() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
