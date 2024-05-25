<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'yali_translations';

    protected $fillable = [
        'group',
        'key',
        'value',
        'note',
        'language_code',
        'language_id',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function translationCategory()
    {
        return $this->belongsTo(TranslationCategory::class);
    }
}
