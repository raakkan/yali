<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasAdditionalData
{
    protected $additionalData = [];

    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    public function setAdditionalData(array $additionalData)
    {
        $this->validateArrayElements($additionalData);
        $this->additionalData = $additionalData;
        return $this;
    }

    public function mergeAdditionalData(array $additionalData)
    {
        $this->validateArrayElements($additionalData);
        $this->additionalData = array_merge($this->additionalData, $additionalData);
        return $this;
    }

    public function addSingleData(string $key, $value)
    {
        $this->validateValue($value);
        $this->additionalData[$key] = $value;
        return $this;
    }

    public function hasAdditionalData()
    {
        return count($this->additionalData) > 0;
    }

    private function validateArrayElements(array $data)
    {
        foreach ($data as $key => $value) {
            if (!is_int($key) && !is_string($key)) {
                throw new \InvalidArgumentException(sprintf('The key must be a string or integer. Given: %s', gettype($key)));
            }
            $this->validateValue($value);
        }
    }

    private function validateValue($value)
    {
        if (!(is_array($value) || is_string($value) || is_int($value) || is_bool($value) || is_null($value))) {
            throw new \InvalidArgumentException(sprintf('The value must be of type array, string, integer, boolean, or null. Given: %s', gettype($value)));
        }
    }
}
