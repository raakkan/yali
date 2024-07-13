<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait Encryptable
{
    protected $encrypted = false;

    public function encrypt($encrypted = true)
    {
        $this->encrypted = $encrypted;

        return $this;
    }

    public function disableEncryption()
    {
        $this->encrypted = false;

        return $this;
    }

    public function enableEncryption()
    {
        $this->encrypted = true;

        return $this;
    }

    public function isEncryptionEnabled()
    {
        return $this->encrypted;
    }

    public function isEncryptionDisabled()
    {
        return !$this->encrypted;
    }
}