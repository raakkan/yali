<?php

namespace Raakkan\Yali\Core\Concerns\Database;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Models\ModelTranslation;

/**
 * Trait HasTranslations
 *
 * Provides functionality for handling translatable attributes in Eloquent models.
 */
trait HasTranslations
{
    /**
     * Boot the Translatable trait for a model.
     *
     * @return void
     */
    public static function bootTranslatable()
    {
        static::deleting(function (Model $model) {
            $model->deleteTranslations();
        });
    }

    /**
     * Delete all translations associated with the model.
     *
     * @return void
     */
    public function deleteTranslations()
    {
        $this->translations()->delete();
    }

    /**
     * Get the translations relationship for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(ModelTranslation::class, 'translatable_id')
            ->where('translatable_type', static::class);
    }

    /**
     * Get a translated attribute value.
     *
     * @param string $attributeName
     * @return mixed
     */
    public function getAttribute($attributeName)
    {
        if ($this->isTranslatableAttribute($attributeName)) {
            return $this->getTranslation($attributeName, App::getLocale()) ?? '';
        }

        return parent::getAttribute($attributeName);
    }

    /**
     * Set a translated attribute value.
     *
     * @param string $attributeName
     * @param mixed $value
     * @return $this
     */
    public function setAttribute($attributeName, $value)
    {
        if ($this->isTranslatableAttribute($attributeName)) {
            $this->setTranslation($attributeName, App::getLocale(), $value);
            return $this;
        }

        return parent::setAttribute($attributeName, $value);
    }

    /**
     * Get the translation value for a given attribute and locale.
     *
     * @param string $attributeName
     * @param string $locale
     * @return mixed
     */
    public function getTranslation($attributeName, $locale)
    {
        return $this->translations()
            ->where('key', $attributeName)
            ->where('locale', $locale)
            ->value('value');
    }

    /**
     * Set the translation value for a given attribute and locale.
     *
     * @param string $attributeName
     * @param string $locale
     * @param mixed $value
     * @return void
     */
    public function setTranslation($attributeName, $locale, $value)
    {
        $this->translations()->updateOrCreate([
            'key' => $attributeName,
            'locale' => $locale,
        ], [
            'value' => $value,
        ]);
    }

    /**
     * Fill the model with an array of attributes.
     *
     * @param array $attributes
     * @return $this
     */
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

    /**
     * Check if an attribute is translatable.
     *
     * @param string $attributeName
     * @return bool
     */
    private function isTranslatableAttribute($attributeName)
    {
        return in_array($attributeName, $this->getTranslatableAttributes());
    }

    /**
     * Get the translatable attributes for the model.
     *
     * @return array
     */
    public function getTranslatableAttributes()
    {
        return property_exists($this, 'translatable') ? $this->translatable : [];
    }
}
