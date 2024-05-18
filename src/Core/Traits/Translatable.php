<?php

namespace Raakkan\Yali\Core\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Models\ModelTranslation;

trait Translatable
{
    public static function bootTranslatable()
    {
        static::deleting(function (Model $model) {
            $model->deleteTranslations();
        });
    }

    public function deleteTranslations()
    {
        $this->translations()->delete();
    }
    
    public function translations()
    {
        return $this->hasMany(ModelTranslation::class, 'translatable_id')
            ->where('translatable_type', static::class);
    }

    public function getAttribute($key)
    {
        if ($this->isTranslatableAttribute($key)) {
            return $this->getTranslation($key, App::getLocale());
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if ($this->isTranslatableAttribute($key)) {
            $this->setTranslation($key, App::getLocale(), $value);
            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    public function getTranslation($key, $locale)
    {
        return $this->translations()
            ->where('key', $key)
            ->where('locale', $locale)
            ->value('value');
    }

    public function setTranslation($key, $locale, $value)
    {
        $translation = $this->translations()
            ->where('key', $key)
            ->where('locale', $locale)
            ->first();

        if ($translation) {
            $translation->value = $value;
            $translation->save();
        } else {
            $this->translations()->create([
                'key' => $key,
                'locale' => $locale,
                'value' => $value,
            ]);
        }
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if ($this->isTranslatableAttribute($key)) {
                $this->setTranslation($key, App::getLocale(), $value);
                unset($attributes[$key]);
            }
        }

        return parent::fill($attributes);
    }

    protected function isTranslatableAttribute($key)
    {
        return in_array($key, $this->getTranslatableAttributes());
    }

    public function getTranslatableAttributes()
    {
        return property_exists($this, 'translatable') ? $this->translatable : [];
    }
}
