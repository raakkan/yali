<div>
    @php
        $id = 'yali-vue-' . md5(serialize(rand()));
    @endphp
    <div id="{{ $id }}" data-vue="file-manager" wire:ignore>
        <file-manager-component
            :data-props="{{ json_encode(['root' => ['path' => '/', 'name' => 'Home']]) }}"></file-manager-component>
    </div>
</div>
