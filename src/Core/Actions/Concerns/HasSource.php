<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasSource
{
    protected $source;

    public function getSource()
    {
        $callerMeta = $this->getCallerMetadata();
        $callerSource = array_key_exists('class', $callerMeta) ? $callerMeta['class'] : null;
        
        if ($this->source) {
            return $this->source;
        } elseif ($callerSource) {
            return $callerSource;
        }else {
            return throw new \Exception('Source not set');
        }
    }

    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }
}
