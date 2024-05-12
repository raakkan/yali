<?php

namespace Raakkan\Yali\Core\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use Raakkan\Yali\App\Pages\DashboardPage;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class YaliPage extends Component
{
    use HasNavigation;

    protected $title = '';
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
            return view($this->view)->layout('yali::layouts.app', ['title' => $this->title]);
        } else {
            if (app()->isLocal()) {
                throw new \Exception("View not found: {$this->view} from " . get_class($this));
            } else {
                return view('yali::errors.view-not-found', ['view' => $this->view, 'class' => get_class($this)])->title('View Not Found');
            }
        }
    }
}
