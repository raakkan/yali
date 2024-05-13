<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class YaliResource
{
    use HasNavigation;

    protected $title = '';
    protected $slug = '';

    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get the fields for the resource.
     *
     * @return array
     */
    public function getFields()
    {
        return [];
    }

    public function getTableColumns()
    {
        return [];
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug ? Str::slug($this->slug) : Str::plural(Str::kebab(class_basename($this->getModel())));
    }
}
