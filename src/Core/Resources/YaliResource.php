<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Resources\Table\YaliTable;
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

    protected $form;

    protected $table;

    public function __construct()
    {
        $this->form = new YaliForm();
        $this->table = new YaliTable($this);
    }

    abstract public function table(): YaliTable;
    abstract public function form(): YaliForm;

    public function getModel()
    {
        if (!class_exists($this->model)) {
            throw new \InvalidArgumentException("Model class '{$this->model}' does not exist.");
        }

        return $this->model;
    }

    public function getModelInstance(): Model
    {
        $modelClass = $this->getModel();
        return new $modelClass();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug ? Str::slug($this->slug) : Str::plural(Str::kebab(class_basename($this->getModel())));
    }

    public function getName(): string
    {
        return class_basename($this);
    }
}
