{{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/css/admin.css', 'resources/js/admin.js']) }}

<div>
    Hello Yalis b{{ base_path() }}
</div>
