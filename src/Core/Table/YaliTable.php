<?php

namespace Raakkan\Yali\Core\Table;

use Raakkan\Yali\Core\Table\Concerns\HasActions;
use Raakkan\Yali\Core\Table\Concerns\HasColumns;
use Raakkan\Yali\Core\Table\Concerns\HasFilters;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;

class YaliTable
{
    use HasFilters;
    use HasActions;
    use HasColumns;

    protected $perPage = 10;

    public $includeDeleted = false;

    public function __construct()
    {
        $this->headerActions[] = CreateAction::make();

        $this->actions = [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    public function perPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    // public function enableSoftDeletes()
    // {
    //     $model = $this->resource->getModelInstance();

    //     if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($model))) {
    //         $this->includeDeleted = true;
    //     } else {
    //         throw new \Exception("The model {$this->resource->getModelName()} does not use the SoftDeletes trait.");
    //     }

    //     return $this;
    // }

    public function isSoftDeletesEnabled(): bool
    {
        return $this->includeDeleted;
    }

}
