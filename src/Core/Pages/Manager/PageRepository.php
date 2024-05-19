<?php 

namespace Raakkan\Yali\Core\Pages\Manager;

class PageRepository
{
    protected $pages = [];

    public function add(Page $page)
    {
        $pageClass = get_class($page);

        if ($this->existsByClass($pageClass)) {
            throw new \Exception("Page with class '{$pageClass}' already exists.");
        }

        $this->pages[$pageClass] = $page;
    }

    public function all()
    {
        return $this->pages;
    }

    public function findBySlug($slug)
    {
        return collect($this->pages)->firstWhere(function ($page) use ($slug) {
            return $page->getSlug() === $slug;
        });
    }

    public function findByClass($class)
    {
        return $this->pages[$class] ?? null;
    }

    public function existsByClass($class)
    {
        return isset($this->pages[$class]);
    }
}
