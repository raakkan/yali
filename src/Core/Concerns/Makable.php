<?php

namespace Raakkan\Yali\Core\Concerns;

trait Makable
{
    protected $callerMetadata;
    protected static $componentInstanceCounts = [];

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

        if (method_exists($instance, 'generateComponentId')) {
            $instance->incrementInstanceCount();
            $instance->generateComponentId();
        }

        $instance->setCallerMetadata($callerMetadata);

        return $instance;
    }

    protected function incrementInstanceCount()
    {
        $componentName = get_class($this);
        if (!isset(self::$componentInstanceCounts[$componentName])) {
            self::$componentInstanceCounts[$componentName] = 0;
        }
        self::$componentInstanceCounts[$componentName]++;
    }

    protected function getInstanceId()
    {
        $componentName = get_class($this);
        return self::$componentInstanceCounts[$componentName];
    }

    public function setCallerMetadata($callerMetadata)
    {
        $this->callerMetadata = $callerMetadata;
    }

    public function getCallerMetadata()
    {
        return $this->callerMetadata;
    }

    public function getCallerClass()
    {
        if ($this->hasCallerClass()) {
            return $this->callerMetadata['class'];
        }else {
            return null;
        }
    }

    public function hasCallerClass()
    {
        return isset($this->callerMetadata) && array_key_exists('class', $this->callerMetadata) && isset($this->callerMetadata['class']);
    }
}
