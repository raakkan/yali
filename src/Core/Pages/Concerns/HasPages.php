<?php

namespace Raakkan\Yali\Core\Pages\Concerns;

trait HasPages
{
    protected $pages = [];

    public function addPage($page)
    {
        $this->pages[] = $page;
    }

    public function getPages()
    {
        return $this->pages;
    }
}
