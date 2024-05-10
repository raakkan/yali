<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseResource
{
    /**
     * The array of fields for the resource.
     *
     * @var array
     */
    public $fields = [];

    /**
     * The array of table columns for the resource.
     *
     * @var array
     */
    public $tableColumns = [];

    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Indicates if the model is being edited.
     *
     * @var bool
     */
    protected $isEditing = false;

    /**
     * Get the fields for the resource.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Get the table columns for the resource.
     *
     * @return array
     */
    public function getTableColumns()
    {
        return $this->tableColumns;
    }

    /**
     * Generate a unique ID for the resource.
     *
     * @return string
     */
    public function getUniqueId()
    {
        return Str::slug(static::class);
    }

    /**
     * Set the model instance for the resource.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
        $this->isEditing = $model->exists;

        return $this;
    }

    /**
     * Get the model instance for the resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Determine if the model is being edited.
     *
     * @return bool
     */
    public function isEditing()
    {
        return $this->isEditing;
    }
}
