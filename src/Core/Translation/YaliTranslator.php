<?php

namespace Raakkan\Yali\Core\Translation;

use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\Translator;
use Raakkan\Yali\Models\Translation;

class YaliTranslator extends Translator
{
    public function get($key, array $replace = [], $locale = null, $fallback = true)
    {
        $locale = $locale ?: $this->locale;
        // dd($locale, $key);

        $translation = $this->getTranslationFromDatabase($key, $locale);

        if ($translation) {
            return $this->makeReplacements($translation->value, $replace);
        }

        return parent::get($key, $replace, $locale, $fallback);
    }

    public function getFromJson($key, array $replace = [], $locale = null)
    {
        $locale = $locale ?: $this->locale;

        $translation = $this->getTranslationFromDatabase($key, $locale);

        if ($translation) {
            return $this->makeReplacements($translation->value, $replace);
        }

        return parent::getFromJson($key, $replace, $locale);
    }

    public function choice($key, $number, array $replace = [], $locale = null)
    {
        $locale = $locale ?: $this->locale;

        $translation = $this->getTranslationFromDatabase($key, $locale);

        if ($translation) {
            $line = $this->makeReplacements($translation->value, $replace);

            return $this->makeReplacements($this->getSelector()->choose($line, $number, $locale), $replace);
        }

        return parent::choice($key, $number, $replace, $locale);
    }

    protected function getTranslationFromDatabase($key, $locale)
    {
        [$namespace, $group, $item] = $this->parseKey($key);
        
        return Cache::rememberForever("translation_{$locale}_{$group}_{$item}", function () use ($item, $group, $locale) {
            return Translation::where('key', $item)
                ->where('group', $group)
                ->where('language_code', $locale)
                ->first();
        });
    }

    public function flushTranslationCache($key, $locale)
    {
        [$namespace, $group, $item] = $this->parseKey($key);

        Cache::forget("translation_{$locale}_{$group}_{$item}");
    }
}
