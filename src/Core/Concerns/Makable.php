<?php

namespace Raakkan\Yali\Core\Concerns;

trait Makable
{
    protected $callerMetadata;

    public static function make(...$arguments)
    {
        $trace = debug_backtrace();
        $callerMetadata = $trace[1];
        
        $instance = new static(...$arguments);

        if (method_exists($instance, 'initializeTraits')) {
            $instance->initializeTraits();
        }
        
        if (method_exists($instance, 'generateUniqueKey')) {
            $instance->generateUniqueKey();
        }

        $instance->setCallerMetadata($callerMetadata);

        return $instance;
    }

    public function setCallerMetadata($callerMetadata)
    {
        $this->callerMetadata = $callerMetadata;
    }

    public function getCallerMetadata()
    {
        return $this->callerMetadata;
    }
}
