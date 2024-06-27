{{-- <div class="fixed top-4 right-4 z-50 flex flex-col space-y-4 max-w-md w-full">
    @foreach ($notifications as $id => $notification)
        @php
            $notification = app(NotificationManager::class)->getNotification($id);
        @endphp

        {{ $notification->render() }}
        {{ $id }}
    @endforeach
    <button @click="$dispatch('notifications-sent')">click</button>
</div> --}}
