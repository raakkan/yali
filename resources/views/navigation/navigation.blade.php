<nav>
    <ul class="space-y-1 font-medium">
        @foreach ($items as $item)
            @if ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationItem)
                <li class="yali-sidebar-item">
                    <a href="{{ route($item->getRouteName()) }}"
                        class="yali-sidebar-link {{ $item->isActive() ? 'yali-active' : '' }}">
                        @if ($item->getIcon())
                            <x-yali::navigation-icon :icon="$item->getIcon()" />
                        @endif
                        <span>{{ $item->getLabel() }}</span>
                    </a>
                </li>
            @elseif ($item instanceof \Raakkan\Yali\Core\Support\Navigation\NavigationGroup)
                <li x-data="{ dropdownOpen: {{ $item->hasActiveRoute() ? 'true' : 'false' }} }"
                    class="yali-sidebar-link-dropdown {{ $item->hasActiveRoute() ? 'bg-slate-50' : '' }}">
                    <button type="button" class="yali-sidebar-link-dropdown-button" @click="dropdownOpen = !dropdownOpen">
                        @if ($item->getIcon())
                            <x-yali::navigation-icon :icon="$item->getIcon()" />
                        @endif
                        <span>{{ $item->getName() }}</span>
                        <x-yali::icon x-show="dropdownOpen" name="chevron-up" class="w-5 h-5" x-cloak />
                        <x-yali::icon x-show="!dropdownOpen" name="chevron-down" class="w-5 h-5" x-cloak />
                    </button>
                    <ul class="yali-sidebar-link-dropdown-list" x-show="dropdownOpen">
                        @foreach ($item->getItems() as $groupItem)
                            <li class="yali-sidebar-link-dropdown-item">
                                <a href="{{ route($groupItem->getRouteName()) }}"
                                    class="yali-sidebar-link-dropdown-link {{ $groupItem->isActive() ? 'yali-dropdown-active' : '' }}">
                                    @if ($groupItem->getIcon())
                                        <x-yali::navigation-icon :icon="$groupItem->getIcon()" />
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
