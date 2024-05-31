<?php

namespace Raakkan\Yali\Providers;

use Raakkan\Yali\Core\Translation\Loaders\TranslationLoader;
use Illuminate\Translation\TranslationServiceProvider as BaseTranslationServiceProvider;

class TranslationServiceProvider extends BaseTranslationServiceProvider
{
    public function register(): void
    {
        parent::register();
    }
    
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new TranslationLoader($app['files'], $app['path.lang']);
        });
    }
}
