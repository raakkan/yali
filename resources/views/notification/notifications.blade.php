@php
    use Raakkan\Yali\Core\Support\Notification\Notification;
@endphp

<div class="fixed top-4 right-4 z-50 flex flex-col space-y-4 max-w-md w-full">
    @foreach ($notifications as $notification)
        @php
            $notification = Notification::make()->fromArray($notification);
        @endphp
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, {{ $notification->getTimeout() }})"
            class="relative max-w-full p-3 rounded-lg shadow-lg overflow-hidden bg-gradient-to-r from-[#0f9c0f] to-[#6ad45c] text-white">
            {{ $notification->render() }}
        </div>
    @endforeach
</div>
