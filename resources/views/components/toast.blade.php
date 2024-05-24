<!-- Toast notification container -->
<div dust="toast" class="toast-container" x-data="{ toasts: [], timer: null }" x-init="() => {
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

    <!-- Loop through toasts and display them -->
    <template x-for="toast in toasts" :key="toast.id">
        <div class="toast" x-show="toasts.includes(toast)" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">

            <!-- Icon based on toast type -->
            <template x-if="toast.type === 'success'">
                <x-yali::icon name="check-circle" class="w-8 h-8 text-green-500 rounded-lg dark:text-green-200" />
            </template>
            <template x-if="toast.type === 'warning'">
                <x-yali::icon name="exclamation-circle" class="w-8 h-8 text-green-500 rounded-lg dark:text-green-200" />
            </template>
            <template x-if="toast.type === 'error'">
                <x-yali::icon name="x-circle" class="w-8 h-8 text-green-500 rounded-lg dark:text-green-200" />
            </template>

            <!-- Toast message text and close button -->
            <div class="ms-3 text-sm font-normal" x-text="toast.message"></div>
            <button type="button" class="toast-close-button"
                @click="clearTimeout(timer); timer = setTimeout(() => toasts = toasts.filter(t => t.id !== toast.id), 200)">
                <x-heroicon-o-x-mark class="" />
            </button>
        </div>
    </template>
</div>
