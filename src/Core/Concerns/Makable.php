<?php

namespace Raakkan\Yali\Core\Concerns;

trait Makable
{
    public static function make(...$arguments)
    {
        $instance = new static(...$arguments);

        if (method_exists($instance, 'initializeTraits')) {
            $instance->initializeTraits();
        }
        
        if (method_exists($instance, 'generateUniqueKey')) {
            $instance->generateUniqueKey();
        }
        return $instance;
    }
}
