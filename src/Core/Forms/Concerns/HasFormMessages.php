<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasFormMessages
{
    public $headerMessage = '';

    public $footerMessage = '';

    public function headerMessage($messageOrCallback, $callback = null)
    {
        if (is_callable($messageOrCallback)) {
            $this->headerMessage = $messageOrCallback($this);
        } elseif (is_string($messageOrCallback)) {
            $this->headerMessage = $callback ? $callback($messageOrCallback, $this) : $messageOrCallback;
        }

        return $this;
    }

    public function footerMessage($messageOrCallback, $callback = null)
    {
        if (is_callable($messageOrCallback)) {
            $this->footerMessage = $messageOrCallback($this);
        } elseif (is_string($messageOrCallback)) {
            $this->footerMessage = $callback ? $callback($messageOrCallback, $this) : $messageOrCallback;
        }

        return $this;
    }

    public function getHeaderMessage()
    {
        return $this->headerMessage;
    }

    public function getFooterMessage()
    {
        return $this->footerMessage;
    }

    public function hasHeaderMessage()
    {
        return !empty($this->headerMessage);
    }

    public function hasFooterMessage()
    {
        return !empty($this->footerMessage);
    }
}
