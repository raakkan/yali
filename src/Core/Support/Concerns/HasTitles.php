<?php

namespace Raakkan\Yali\Core\Support\Concerns;

trait HasTitles
{
    public $title = '';
    public $subtitle = '';

    public function title($titleOrCallback, $callback = null)
    {
        if (is_callable($titleOrCallback)) {
            $this->title = $titleOrCallback($this);
        } elseif (is_string($titleOrCallback)) {
            $this->title = $callback ? $callback($titleOrCallback, $this) : $titleOrCallback;
        }

        return $this;
    }

    public function subtitle($subtitleOrCallback, $callback = null)
    {
        if (is_callable($subtitleOrCallback)) {
            $this->subtitle = $subtitleOrCallback($this);
        } elseif (is_string($subtitleOrCallback)) {
            $this->subtitle = $callback ? $callback($subtitleOrCallback, $this) : $subtitleOrCallback;
        }

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function hasTitle()
    {
        return !empty($this->title);
    }

    public function hasSubtitle()
    {
        return !empty($this->subtitle);
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }
}
