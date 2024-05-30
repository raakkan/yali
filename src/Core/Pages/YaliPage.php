<?php

namespace Raakkan\Yali\Core\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use Raakkan\Yali\App\Pages\DashboardPage;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class YaliPage extends Component
{
    use HasNavigation;

    protected static $title = '';
    protected static $view = '';

    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(class_basename(static::class)));
    }

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(class_basename(static::class));
    }

    public static function getType(): string
    {
        return 'page';
    }

    public function render()
    {
        if (view()->exists(static::$view)) {
            return view(static::$view)->layout('yali::layouts.app', ['title' => static::$title]);
        } else {
            if (app()->isLocal()) {
                throw new \Exception("View not found: {$this->view} from " . get_class($this));
            } else {
                return view('yali::errors.view-not-found', ['view' =>  static::$view, 'class' => get_class($this)])->title('View Not Found');
            }
        }
    }

    public static function getRouteName()
    {
        return Str::kebab(Str::plural(static::getType()) . str_replace('\\', '', static::class));
    }
}
