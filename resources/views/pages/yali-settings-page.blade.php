<x-yali::card title="Yali Settings" class="w-full">
    <div x-data="{ activeTab: 'general' }">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-64 border-r border-gray-200">
                <nav class="flex flex-col p-2 space-y-2">
                    <a href="#" @click.prevent="activeTab = 'general'"
                        :class="{ 'bg-gray-100': activeTab === 'general' }"
                        class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg border border-gray-200 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        General Settings
                    </a>
                    <a href="#" @click.prevent="activeTab = 'mail'"
                        :class="{ 'bg-gray-100': activeTab === 'mail' }"
                        class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg border border-gray-200 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Icon Settings
                    </a>
                </nav>
            </div>
            <div class="flex-1 p-6">
                <div x-show="activeTab === 'general'" class="space-y-6">
                    @php
                        $settings = Raakkan\Yali\Core\Support\Facades\YaliSetting::getSettingsBySource('yali', true);
                    @endphp

                    @foreach ($settings as $item)
                        {{ $item->render() }}
                    @endforeach
                </div>
                <div x-show="activeTab === 'mail'">
                    mail Settings Content
                </div>
            </div>
        </div>
    </div>
</x-yali::card>
