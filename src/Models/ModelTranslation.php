<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTranslation extends Model
{
    protected $table = 'model_translations';
    
    protected $fillable = ['translatable_id', 'translatable_type', 'key', 'locale', 'value'];

    public function translatable()
    {
        return $this->morphTo();
    }
}
