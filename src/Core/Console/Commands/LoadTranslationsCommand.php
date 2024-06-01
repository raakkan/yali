<?php

namespace Raakkan\Yali\Core\Console\Commands;

use Illuminate\Console\Command;
use Raakkan\Yali\Models\Language;
use Illuminate\Support\Facades\File;
use Raakkan\Yali\Models\Translation;
use Illuminate\Support\Facades\Artisan;
use Raakkan\Yali\Models\TranslationCategory;

class LoadTranslationsCommand extends Command
{
    protected $signature = 'yali:translations:load';

    protected $description = 'Load translations from the app lang path into the database';

    public function handle()
    {
        $langPath = base_path('lang');
    
        if (!File::exists($langPath)) {
            $this->error("The 'lang' directory does not exist.");
            return;
        }
    
        $languageDirs = File::directories($langPath);
    
        foreach ($languageDirs as $languageDir) {
            $languageCode = basename($languageDir);
    
            // Find or create the language
            $language = Language::firstOrCreate([
                'code' => $languageCode,
            ], [
                'name' => ucfirst($languageCode),
                'is_active' => true,
            ]);
    
            $files = File::allFiles($languageDir);
    
            foreach ($files as $file) {
                $group = basename($file, '.php');
                $translations = require $file->getPathname();
            
                $this->processTranslations($language, $group, $translations, $languageCode);
            }
    
            $this->info("Translations loaded successfully for language: {$languageCode}");
        }
    }

    private function processTranslations($language, $group, $translations, $languageCode, $prefix = '')
    {
        foreach ($translations as $key => $value) {
            if (is_array($value) && !empty($prefix)) {
                // Skip processing nested arrays beyond the first level
                continue;
            }
    
            if (is_array($value)) {
                $this->processTranslations($language, $group, $value, $languageCode, $prefix . $key . '.');
            } else {
                $translationKey = $prefix . $key;
                
                // Find or create the translation category
                $category = TranslationCategory::firstOrCreate([
                    'source_name' => 'app',
                ], [
                    'name' => 'App',
                ]);
    
                $language->translations()->updateOrCreate([
                    'group' => $group,
                    'key' => $translationKey,
                    'language_code' => $languageCode,
                ], [
                    'value' => $value,
                    'translation_category_id' => $category->id,
                    'is_enabled' => true,
                    'created_by' => 'system',
                ]);

                \Raakkan\Yali\Models\DefaultTranslation::updateOrCreate([
                    'group' => $group,
                    'key' => $translationKey,
                ], [
                    'value' => $value,
                    'created_by' => 'system',
                ]);
            }
        }
    }
    
}
