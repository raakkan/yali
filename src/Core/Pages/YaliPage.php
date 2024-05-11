<?php

namespace Raakkan\Yali\Core\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Raakkan\Yali\App\Pages\DashboardPage;

#[Layout('yali::layouts.app')]
abstract class YaliPage extends Component
{
    protected $title = '';
    protected $navigationTitle = '';
    protected $navigationGroup = '';
    protected $navigationIcon = '';
    protected $navigationOrder = 0;
    protected $slug = '';
    protected $view = '';

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

    public function getSlug(): string
    {
        if ($this instanceof DashboardPage) {
            return '/';
        }
        
        return $this->slug ? Str::slug($this->slug) : Str::kebab(class_basename($this));
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        if (view()->exists($this->view)) {
            return view($this->view)->title($this->getTitle());
        } else {
            if (app()->isLocal()) {
                throw new \Exception("View not found: {$this->view} from " . get_class($this));
            } else {
                return view('yali::errors.view-not-found', ['view' => $this->view, 'class' => get_class($this)])->title('View Not Found');
            }
        }
    }

}
