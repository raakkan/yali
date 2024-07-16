<?php

if (! function_exists('yali_trans')) {
    function yali_trans($key, $default = null)
    {
        if (app()->bound('translator')) {
            $translator = app('translator');
            $translation = $translator->get($key);

            if ($translation === $key) {
                return $default !== null ? $default : $key;
            }

            return $translation;
        }

        return $default !== null ? $default : $key;
    }
}

if (! function_exists('yali_setting')) {
    function yali_setting($key, $group = 'default')
    {
        return app('setting-loader')->group($group)->get($key);
    }
}
