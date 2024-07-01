{{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/js/filemanager/filemanager.ts']) }}
<div x-data x-on:file-manager.window="console.log($event.detail)" id="file-manager">
    <file-manager-component
        :data-props="{{ json_encode(['root' => ['path' => '/', 'name' => 'Home']]) }}"></file-manager-component>
</div>
