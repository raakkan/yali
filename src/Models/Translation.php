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
        'created_by',
        'is_enabled',
        'translation_category_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'created_by' => 'enum:system,user',
        ];
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function translationCategory()
    {
        return $this->belongsTo(TranslationCategory::class);
    }
}
