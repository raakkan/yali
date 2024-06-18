<?php

namespace Raakkan\Yali\Core\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class BasePage extends Component
{
    use HasNavigation;
    
    protected static $view = '';

    protected static $title = '';

    public static function getTitle(): string
    {
        return static::$title;
    }

    public static function getType(): string
    {
        return '';
    }

    public static function getClass()
    {
        return static::class;
    }

    public static function getClassName(): string
    {
        return class_basename(static::class);
    }

    public static function getRouteName()
    {
        return Str::kebab(Str::plural(static::getType()) . str_replace('\\', '', static::class));
    }

    public function getViewData()
    {
        return [];
    }

    public function render()
    {
        if (view()->exists(static::$view)) {
            return view(static::$view, $this->getViewData())->layout('yali::layouts.app')->title(static::getTitle());
        } else {
            if (app()->isLocal()) {
                throw new \Exception("View not found: {$this->view} from " . get_class($this));
            } else {
                return view('yali::errors.view-not-found', ['view' =>  static::$view, 'class' => get_class($this)])->title('View Not Found');
            }
        }
    }
}