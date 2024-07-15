<?php

namespace Raakkan\Yali\Providers;

use Illuminate\Translation\FileLoader;
use Illuminate\Translation\TranslationServiceProvider as BaseTranslationServiceProvider;
use Raakkan\Yali\Core\Translation\YaliTranslator;

class TranslationServiceProvider extends BaseTranslationServiceProvider
{
    public function register(): void
    {
        $this->app->bind('translation.loader', function ($app) {
            return new FileLoader($app['files'], $app['path.lang']);
        });

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];
            $locale = $app['config']['app.locale'];
            $translator = new YaliTranslator($loader, $locale);
            $translator->setFallback($app['config']['app.fallback_locale']);

            return $translator;
        });
    }
}
