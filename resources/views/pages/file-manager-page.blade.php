{{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/js/filemanager/filemanager.ts']) }}
<div id="filemanager">
    <file-manager-component></file-manager-component>
</div>
