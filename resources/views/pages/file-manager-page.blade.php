{{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/js/filemanager/filemanager.ts']) }}
<div id="filemanager">
    <file-manager-component
        :data-props="{{ json_encode(['root' => ['path' => '/', 'name' => 'Home']]) }}"></file-manager-component>
</div>
