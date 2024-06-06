<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Table\Concerns\HasTable;
use Raakkan\Yali\Core\Concerns\Database\HasModel;

abstract class BaseResource extends BasePage
{
    use HasTable;
    use HasForm;
    use HasModel;

    protected static $subtitle = '';

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(Str::plural(static::getModelName()));
    }

    public static function getSubtitle(): string
    {
        return static::$subtitle;
    }
    
    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(static::getModelName()));
    }

    public static function getType(): string
    {
        return 'resource';
    }
}
