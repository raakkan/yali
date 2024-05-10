<?php

namespace Raakkan\Yali\Core\Pages\Traits;

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
