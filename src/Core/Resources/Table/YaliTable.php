<?php

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Resources\YaliResource;

class YaliTable
{
    public $resource;
    public $columns = [];

    protected $pagination = 10;

    public function __construct(YaliResource $resource)
    {
        $this->resource = $resource;
    }

    public function columns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getResourceModel(): Model
    {
        return $this->resource->getModelInstance();
    }

    public function getResourceModelData()
    {
        return $this->getResourceModel()->all();
    }

    public function getResourceModelQuery()
    {
        return $this->getResourceModel()->query();
    }

    public function getResourceName(): string
    {
        return $this->resource->getName();
    }

    public function getResourceTitle(): string
    {
        return $this->resource->getTitle();
    }

    public function pagination($pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }

    public function getPagination()
    {
        return $this->pagination;
    }
}
