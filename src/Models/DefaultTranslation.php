<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Database\Enums\CreatedBy;

class DefaultTranslation extends Model
{
    protected $table = 'yali_default_translations';

    protected $fillable = ['group', 'key', 'value', 'created_by'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_by' => CreatedBy::class,
        ];
    }
}