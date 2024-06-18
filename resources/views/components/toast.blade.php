<!-- Toast notification container -->
<div x-data="{ toasts: [], timer: null }" x-init="() => {
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
    })"
    class="fixed top-4 right-4 z-50 flex flex-col space-y-4 max-w-md w-full">

    <!-- Loop through toasts and display them -->
    <template x-for="toast in toasts" :key="toast.id">
        <div class="relative max-w-full p-4 rounded-lg shadow-lg overflow-hidden" x-show="toasts.includes(toast)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            :class="{
                'bg-green-500 text-white': toast.type === 'success',
                'bg-yellow-500 text-white': toast.type === 'warning',
                'bg-red-500 text-white': toast.type === 'error'
            }">

            <!-- Toast message text and close button -->
            <div class="flex items-center">
                <!-- Type icon -->
                <div class="flex items-center justify-center w-8 h-8 rounded-full me-4"
                    :class="{
                        'bg-green-600': toast.type === 'success',
                        'bg-yellow-600': toast.type === 'warning',
                        'bg-red-600': toast.type === 'error'
                    }">
                    <template x-if="toast.type === 'success'">
                        <x-yali::icon name="check-circle" class="w-5 h-5 text-white" />
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <x-yali::icon name="exclamation-circle" class="w-5 h-5 text-white" />
                    </template>
                    <template x-if="toast.type === 'error'">
                        <x-yali::icon name="x-circle" class="w-5 h-5 text-white" />
                    </template>
                </div>
                <div class="flex-1">
                    <div class="text-base font-semibold" x-text="toast.message"></div>
                </div>
                <button type="button" class="ms-4 text-white hover:text-gray-200 focus:outline-none"
                    x-on:click="clearTimeout(timer); timer = setTimeout(() => toasts = toasts.filter(t => t.id !== toast.id), 200)">
                    <x-yali::icon name="x-circle" class="w-5 h-5" />
                </button>
            </div>

            <!-- Progress bar -->
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white opacity-25" x-init="$el.style.animation = 'progress 5s linear forwards'"></div>
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
