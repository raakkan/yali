<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationCategory extends Model
{
    protected $table = 'yali_translation_categories';

    protected $fillable = ['name', 'source_name'];

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
