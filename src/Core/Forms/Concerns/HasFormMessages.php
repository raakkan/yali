<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasFormMessages
{
    public $headerMessages = [];

    public $footerMessages = [];

    public function addHeaderMessage($messageOrCallback, $callback = null)
    {
        if (is_callable($messageOrCallback)) {
            $this->headerMessages[] = $messageOrCallback($this);
        } elseif (is_string($messageOrCallback)) {
            $this->headerMessages[] = $callback ? $callback($messageOrCallback, $this) : $messageOrCallback;
        }

        return $this;
    }

    public function addFooterMessage($messageOrCallback, $callback = null)
    {
        if (is_callable($messageOrCallback)) {
            $this->footerMessages[] = $messageOrCallback($this);
        } elseif (is_string($messageOrCallback)) {
            $this->footerMessages[] = $callback ? $callback($messageOrCallback, $this) : $messageOrCallback;
        }

        return $this;
    }

    public function getHeaderMessages()
    {
        return $this->headerMessages;
    }

    public function getFooterMessages()
    {
        return $this->footerMessages;
    }

    public function hasHeaderMessages()
    {
        return !empty($this->headerMessages);
    }

    public function hasFooterMessages()
    {
        return !empty($this->footerMessages);
    }

    public function getFirstHeaderMessage()
    {
        return !empty($this->headerMessages) ? $this->headerMessages[0] : null;
    }

    public function getFirstFooterMessage()
    {
        return !empty($this->footerMessages) ? $this->footerMessages[0] : null;
    }
}
