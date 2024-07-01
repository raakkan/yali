{{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/js/filemanager/fileupload.ts']) }}
<div x-data x-on:file-manager.window="console.log($event.detail)" id="file-manager-upload">
    <file-manager-upload
        :data-props="{{ json_encode(['root' => ['path' => '/', 'name' => 'Home']]) }}"></file-manager-upload>
</div>
