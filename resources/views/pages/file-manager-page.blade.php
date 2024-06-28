{{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/js/filemanager/filemanager.ts']) }}
<div id="filemanager">
    <file-manager-component :data-prop="{{ json_encode(['files' => 'files 1']) }}"></file-manager-component>
</div>
