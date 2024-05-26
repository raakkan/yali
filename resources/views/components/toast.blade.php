<!-- Toast notification container -->
<div dust="toast" class="fixed top-4 right-4 z-50 space-y-4" x-data="{ toasts: [], timer: null }" x-init="() => {
    // Watch toasts array and clear timeout on removal
    $watch('toasts', value => value.forEach(t => {
        if (t.id === timer) clearTimeout(timer);
        timer = setTimeout(() => toasts = toasts.filter(tt => tt.id !== t.id), 5000)
    }))
}"
    x-on:toast.window="toasts.push({
        type: $event.detail.type,
        id: Math.random().toString(36).substr(2, 9),
        message: $event.detail.message
    })">

    {{-- TODO: ui not finished and close button not working --}}
    <!-- Loop through toasts and display them -->
    <template x-for="toast in toasts" :key="toast.id">
        <div class="relative max-w-sm p-3 rounded-lg shadow-lg overflow-hidden" x-show="toasts.includes(toast)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-full"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-full"
            :class="{
                'bg-green-600 text-white': toast.type === 'success',
                'bg-yellow-600 text-white': toast.type === 'warning',
                'bg-red-600 text-white': toast.type === 'error'
            }">

            <!-- Toast message text and close button -->
            <div class="flex items-center">
                <!-- Type icon -->
                <div class="flex items-center justify-center w-10 h-10 rounded-full me-2"
                    :class="{
                        'bg-green-500': toast.type === 'success',
                        'bg-yellow-500': toast.type === 'warning',
                        'bg-red-500': toast.type === 'error'
                    }">
                    <template x-if="toast.type === 'success'">
                        <x-yali::icon name="exclamation" class="w-6 h-6 text-white" />
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <x-yali::icon name="exclamation" class="w-6 h-6 text-white" />
                    </template>
                    <template x-if="toast.type === 'error'">
                        <x-yali::icon name="x" class="w-6 h-6 text-white" />
                    </template>
                </div>
                <div class="flex-1">
                    <div class="text-base" x-text="toast.message"></div>
                </div>
                <button type="button" class="ms-4 text-white hover:text-gray-200 focus:outline-none"
                    x-on:click="clearTimeout(timer); timer = setTimeout(() => toasts = toasts.filter(t => t.id !== toast.id), 200)">
                    <x-yali::icon name="x" class="w-5 h-5" />
                </button>
            </div>

            <!-- Progress bar -->
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white opacity-50" x-init="$el.style.animation = 'progress 5s linear forwards'"></div>

            <!-- Background icon based on toast type -->
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center opacity-10"
                :class="{
                    'text-green-800': toast.type === 'success',
                    'text-yellow-800': toast.type === 'warning',
                    'text-red-800': toast.type === 'error'
                }">
                <template x-if="toast.type === 'success'">
                    <x-yali::icon name="check-circle" class="w-16 h-16" />
                </template>
                <template x-if="toast.type === 'warning'">
                    <x-yali::icon name="exclamation-circle" class="w-16 h-16" />
                </template>
                <template x-if="toast.type === 'error'">
                    <x-yali::icon name="x-circle" class="w-16 h-16" />
                </template>
            </div>
        </div>
    </template>
</div>

<style>
    @keyframes progress {
        0% {
            width: 100%;
        }

        100% {
            width: 0%;
        }
    }
</style>
