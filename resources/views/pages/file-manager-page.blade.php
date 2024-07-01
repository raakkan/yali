<div x-data x-on:file-manager.window="console.log($event.detail)">
    <file-manager-component
        :data-props="{{ json_encode(['root' => ['path' => '/', 'name' => 'Home']]) }}"></file-manager-component>
</div>
