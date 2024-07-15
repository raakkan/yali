<?php

namespace Raakkan\Yali\Core\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class YaliSettingsModel extends Model
{
    protected $table = 'yali_settings';

    protected $fillable = [
        'name',
        'value',
        'source',
        'type',
        'group',
        'lock',
        'encrypt',
        'cache',
        'note',
    ];

    protected $casts = [
        'value' => 'json',
        'lock' => 'boolean',
        'encrypt' => 'boolean',
        'cache' => 'boolean',
    ];
}
