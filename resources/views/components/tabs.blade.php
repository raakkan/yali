@props(['tabs' => [], 'tabPosition' => 'top'])

<div x-data="{ activeTab: '{{ array_key_first($tabs) }}' }"
    class="flex {{ $tabPosition === 'left' || $tabPosition === 'right' ? 'flex-col md:flex-row' : 'flex-col' }}">
    @if ($tabPosition === 'top' || $tabPosition === 'bottom' || ($tabPosition === 'left' || $tabPosition === 'right'))
        <div
            class="w-full {{ $tabPosition === 'bottom' ? 'order-last' : '' }} {{ $tabPosition === 'left' || $tabPosition === 'right' ? 'md:hidden' : '' }}">
            <nav class="flex overflow-x-auto whitespace-nowrap border-b border-gray-200">
                @foreach ($tabs as $key => $tab)
                    <a href="#" @click.prevent="activeTab = '{{ $key }}'"
                        :class="{ 'border-blue-500': activeTab === '{{ $key }}' }"
                        class="px-4 py-4 text-sm font-medium border-b-2 text-gray-700 hover:text-gray-900 transition-colors duration-200 flex items-center">
                        @if (array_key_exists('icon', $tab) && $tab['icon'])
                            <x-yali::icon :name="$tab['icon']" class="w-5 h-5 mr-2" />
                        @endif
                        <span>{{ $tab['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
    @endif

    @if ($tabPosition === 'left' || $tabPosition === 'right')
        <div
            class="hidden md:flex md:w-64 {{ $tabPosition === 'right' ? 'order-last border-l' : 'border-r' }} border-gray-200">
            <nav class="flex flex-col p-2 space-y-2 w-full">
                @foreach ($tabs as $key => $tab)
                    <a href="#" @click.prevent="activeTab = '{{ $key }}'"
                        :class="{ 'bg-gray-100': activeTab === '{{ $key }}' }"
                        class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg border border-gray-200 transition-colors duration-200 flex items-center">
                        @if (array_key_exists('icon', $tab) && $tab['icon'])
                            <x-yali::icon :name="$tab['icon']" class="w-5 h-5 mr-2" />
                        @endif
                        <span :class="{ 'text-gray-800': activeTab === '{{ $key }}' }"
                            class="font-medium">{{ $tab['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
    @endif

    <div class="flex-1 p-2 md:p-6">
        {{ $slot }}
    </div>
</div>
