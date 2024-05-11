<?php

namespace Raakkan\Yali\Core\Support\Navigation;

trait HasNavigation
{
    protected $navigationTitle = '';
    protected $navigationGroup = '';
    protected $navigationIcon = '';
    protected $navigationOrder = 0;

    public function getNavigationTitle(): string
    {
        return $this->navigationTitle ?: $this->title;
    }

    public function setNavigationTitle(string $navigationTitle): void
    {
        $this->navigationTitle = $navigationTitle;
    }

    public function getNavigationGroup(): string
    {
        return $this->navigationGroup;
    }

    public function setNavigationGroup(string $navigationGroup): void
    {
        $this->navigationGroup = $navigationGroup;
    }

    public function getNavigationIcon(): string
    {
        return $this->navigationIcon;
    }

    public function setNavigationIcon(string $navigationIcon): void
    {
        $this->navigationIcon = $navigationIcon;
    }

    public function getNavigationOrder(): int
    {
        return $this->navigationOrder;
    }

    public function setNavigationOrder(int $navigationOrder): void
    {
        $this->navigationOrder = $navigationOrder;
    }
}
