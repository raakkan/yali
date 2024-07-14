<x-yali::card title="Yali Settings" class="w-full">
    <x-yali::tabs tabPosition="left" :tabs="[
        'general' => [
            'label' => 'General Settings',
            'icon' => 'dashboard',
        ],
        'icon' => [
            'label' => 'Icon Settings',
            'icon' => '',
        ],
    ]">
        <div x-show="activeTab === 'general'" class="space-y-6" wire:key="general">
            @php
                $generalSettings = $this->getSettingsByGroup('general');
            @endphp

            @foreach ($generalSettings as $item)
                {{ $item->render() }}
            @endforeach
        </div>
        <div x-show="activeTab === 'icon'" class="space-y-6" wire:key="icon">
            @php
                $iconSettings = $this->getSettingsByGroup('icons');
            @endphp

            @foreach ($iconSettings as $item)
                {{ $item->render() }}
            @endforeach
        </div>
    </x-yali::tabs>
</x-yali::card>
