@php
    use Raakkan\Yali\Core\Support\Notification\NotificationManager;
@endphp

@if (session('notifications', []))
    @dd('fx')
@endif

{{-- <div x-data="{ show: true }" class="fixed top-4 right-4 z-50 flex flex-col space-y-4 max-w-md w-full">
    @foreach ($notifications as $id => $notification)
        @php
            $notification = app(NotificationManager::class)->getNotification($id);
        @endphp

        {{ $notification->render() }}
    @endforeach
</div> --}}
