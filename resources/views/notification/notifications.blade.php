@php
    use Raakkan\Yali\Core\Support\Notification\Notification;
@endphp

<div class="fixed top-4 right-4 z-50 flex flex-col space-y-4 max-w-md w-full">
    @foreach ($notifications as $id => $notification)
        @php
            $notification = Notification::make()->fromArray($notification);
        @endphp
        {{ $notification->render() }}
    @endforeach
</div>
