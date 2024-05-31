<?php

namespace Raakkan\Yali\Core\Translation\Loaders;

use Raakkan\Yali\Models\Translation;
use Illuminate\Translation\FileLoader;

class TranslationLoader extends FileLoader
{
    public function load($locale, $group, $namespace = null): array
    {
        $fileTranslations = parent::load($locale, $group, $namespace);

        if (! is_null($namespace) && $namespace !== '*') {
            return $fileTranslations;
        }
        
        if ($group !== '*') {
            $dbTranslations = Translation::where('language_code', $locale)
                ->where('group', $group)
                ->pluck('value', 'key')
                ->toArray();

            return array_replace_recursive($fileTranslations, $dbTranslations);
        }

        return $fileTranslations;
    }
}
