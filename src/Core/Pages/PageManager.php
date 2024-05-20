<?php

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Raakkan\Yali\Core\Exceptions\PageRegistrationException;

class PageManager
{
    protected $pages = [];

    public function loadPages(): void
    {
        try {
            $this->loadPagesFromDirectory('Raakkan\\Yali\\App\\Pages\\', __DIR__ . '/../../App/Pages', 'yali');
            $this->loadPagesFromDirectory('App\\Yali\\Pages\\', base_path('app/Yali/Pages'), 'app');
        } catch (\Exception $e) {
            throw new PageRegistrationException('Failed to load pages: ' . $e->getMessage(), 0, $e);
        }
    }

    protected function loadPagesFromDirectory(string $pagesNamespace, string $pagesDirectory, string $source): void
    {
        if (!File::isDirectory($pagesDirectory)) {
            return;
        }

        foreach (File::allFiles($pagesDirectory) as $file) {
            $class = $pagesNamespace . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());

            if (class_exists($class) && is_subclass_of($class, YaliPage::class)) {
                $this->registerPage($class, $source);
            }
        }
    }

    public function loadPluginPages(array $pluginPages): void
    {
        foreach ($pluginPages as $pluginPage) {
            if (is_string($pluginPage) && class_exists($pluginPage) && is_subclass_of($pluginPage, YaliPage::class)) {
                $this->registerPage($pluginPage, 'plugin');
            }
        }
    }

    protected function registerPage(string $class, string $source): void
    {
        if (!in_array($class, $this->pages)) {
            $this->pages[] = [
                'class' => $class,
                'source' => $source,
            ];
        }
    }

    public function registerPages(): void
    {
        foreach ($this->getPages() as $page) {
            $this->registerRoute($page['class']);
        }
    }

    protected function registerRoute(string $page): void
    {
        $slug = $page::getSlug();

        Route::prefix('admin')->group(function () use ($slug, $page) {
            Route::get($slug, $page)->name('yali::pages.' . $page);
        });
    }

    public function getPages(): array
    {
        return $this->pages;
    }
}
