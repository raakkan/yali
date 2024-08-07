<?php

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Facades\File;
use Raakkan\Yali\Core\Exceptions\PageRegistrationException;

class PageManager
{
    protected $pages = [];

    public function loadPages(): void
    {
        $this->loadPagesFromDirectory('App\\Yali\\Pages\\', base_path('app/Yali/Pages'), 'app');

        $this->loadPagesFromDirectory('App\\Yali\\Resources\\', base_path('app/Yali/Resources'), 'app');
    }

    protected function loadPagesFromDirectory(string $pagesNamespace, string $pagesDirectory, string $source): void
    {
        if (! File::isDirectory($pagesDirectory)) {
            return;
        }

        $files = File::allFiles($pagesDirectory);

        foreach ($files as $file) {
            $class = $pagesNamespace.str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());
            $this->registerPage($class, $source);
        }
    }

    public function loadPluginPages(array $pluginPages): void
    {
        foreach ($pluginPages as $pluginPage) {
            $this->registerPage($pluginPage, 'plugin');
        }
    }

    protected function registerPage(string $class, string $source): void
    {
        // if (!class_exists($class)) {
        //     throw new PageRegistrationException("Page Class {$class} not found");
        // }

        // if (!is_subclass_of($class, YaliPage::class)) {
        //     throw new PageRegistrationException("Page Class {$class} is not a subclass of YaliPage");
        // }

        $this->pages[$class] = [
            'class' => $class,
            'source' => $source,
        ];
    }

    public function getPages(): array
    {
        return $this->pages;
    }
}
