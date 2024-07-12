<div>
    @php
        $settings = $this->getSettingFields();
    @endphp

    @foreach ($settings as $item)
        {!! $item->render() !!}<br>
    @endforeach
</div>
