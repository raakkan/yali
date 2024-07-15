<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingNote
{
    protected $note;

    public function note($note)
    {
        return $this->setNote($note);
    }

    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function hasNote()
    {
        return $this->getNote() !== null;
    }
}
