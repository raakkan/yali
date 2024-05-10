<?php

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Str;
use Livewire\Component;

abstract class BasePage extends Component
{
    protected $title = '';
    protected $navigationTitle = '';
    protected $navigationGroup = '';
    protected $navigationIcon = '';
    protected $navigationOrder = 0;
    protected $routeName = '';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

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

    public function getRouteName(): string
    {
        return $this->routeName ? Str::slug($this->routeName) : Str::kebab(class_basename($this));
    }

    public function setRouteName($routeName): void
    {
        $this->routeName = $routeName;
    }
}
