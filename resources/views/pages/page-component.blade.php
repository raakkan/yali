<div>
    @php
        $data = [
            'model' => App\Models\User::class,
            'fields' => [
                'name' => [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => 'Name',
                    'rules' => 'required|max:255',
                ],
                'email' => [
                    'name' => 'email',
                    'type' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|email|unique:users,email',
                ],
                'password' => [
                    'name' => 'password',
                    'type' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min:8',
                ],
                // Add more fields as needed
            ],
            // Define more models and their fields as needed
        ];

    @endphp
    @php
        $menus = app()
            ->make(Raakkan\Yali\Core\Support\Navigation\NavigationManager::class)
            ->getMenus();
    @endphp

    @foreach ($menus as $menu)
        @foreach ($menu as $item)
            @if ($item['type'] === 'page' && request()->routeIs('yali::pages.' . $item['pageId']))
                @livewire('yali::pages.' . $item['pageId'], ['pageId' => $item['pageId']], key($item['pageId']))
            @break
        @endif
        @if ($item['type'] === 'resource' && request()->routeIs('yali::resources.' . $item['resourceId']))
            {{-- @livewire(
                'yali::resource-page',
                [
                    'model' => $data['model'],
                    'fields' => $data['fields'],
                ],
                key($item['pageId'])
            ) --}}
            @livewire('yali::resource-page', ['resourceId' => $item['resourceId']], key($item['resourceId']))
        @break
    @endif
@endforeach
@endforeach

</div>
