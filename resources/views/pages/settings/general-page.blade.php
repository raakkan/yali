<div>
    <h1>General Settings</h1>

    @php
        $settings = $this->getSettingFields();
    @endphp

    @foreach ($settings as $item)
        {!! $item->render() !!}<br>
    @endforeach
</div>
