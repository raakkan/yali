<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Database\Enums\CreatedBy;

class Translation extends Model
{
    protected $table = 'yali_translations';

    protected $fillable = [
        'group',
        'key',
        'value',
        'note',
        'created_by',
        'is_enabled',
        'translation_category_id',
        'language_code',
    ];

    protected static function booted()
    {
        static::saved(function ($translation) {
            app('translator')->flushTranslationCache($translation->group.'.'.$translation->key, $translation->language_code);
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'created_by' => CreatedBy::class,
        ];
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_code', 'code');
    }

    public function translationCategory()
    {
        return $this->belongsTo(TranslationCategory::class);
    }

    public static function getGroups()
    {
        return self::query()
            ->distinct()
            ->pluck('group')
            ->sort()
            ->values()
            ->mapWithKeys(function ($item) {
                return [$item => $item];
            });
    }
}
