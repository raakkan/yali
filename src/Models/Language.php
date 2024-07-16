<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

    protected $table = 'yali_languages';

    protected $fillable = [
        'name',
        'code',
        'rtl',
        'is_active',
        'is_default',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rtl' => 'boolean',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
        ];
    }

    /**
     * Returns a collection of Translation models that belong to this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(Translation::class, 'language_code', 'code');
    }

    public static function getActiveLanguages()
    {
        return self::where('is_active', true)->get();
    }

    public static function getDefaultLanguage()
    {
        return self::where('is_default', true)->first();
    }

    public static function setDefaultLanguage($code)
    {
        self::where('is_default', true)->update(['is_default' => false]);

        $language = self::where('code', $code)->first();
        $language->is_default = true;
        $language->is_active = true;
        $language->save();
    }
}
