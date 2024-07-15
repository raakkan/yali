<?php

namespace Raakkan\Yali\Core\Translation;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class LocaleConfig
{
    protected $default = 'en';

    protected $locales = ['en'];

    public function __construct(array $config)
    {
        $this->default = $config['default'] ?? $this->default;
        $this->locales = $config['locales'] ?? $this->locales;
    }

    public function getDefault(): string
    {
        return $this->default;
    }

    public function getLocales(): array
    {
        return $this->locales;
    }

    public function setDefault(string $locale)
    {
        $this->default = $locale;

        Config::set('yali.locales.default', $locale);

        Artisan::call('cache:clear');

        return $this;
    }
}
