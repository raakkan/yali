<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasActionSuccessMessages
{
    protected $successMessage = 'Action completed successfully.';
    protected $createdSuccessMessage = '';
    protected $updatedSuccessMessage = '';
    protected $hardDeletedSuccessMessage = '';
    protected $deletedSuccessMessage = '';
    protected $restoredSuccessMessage = '';

    public function getCreatedSuccessMessage(): string
    {
        if (method_exists($this->getSource(), 'getCreatedSuccessMessage')) {
            return $this->getSource()::getCreatedSuccessMessage();
        }

        return $this->createdSuccessMessage ?: 'Item created successfully.';
    }

    public function getUpdatedSuccessMessage(): string
    {
        if (method_exists($this->getSource(), 'getUpdatedSuccessMessage')) {
            return $this->getSource()::getUpdatedSuccessMessage();
        }
        
        return $this->updatedSuccessMessage ?: 'Item updated successfully.';
    }

    public function getHardDeletedSuccessMessage(): string
    {
        if (method_exists($this->getSource(), 'getHardDeletedSuccessMessage')) {
            return $this->getSource()::getHardDeletedSuccessMessage();
        }
        return $this->hardDeletedSuccessMessage ?: 'Item permanently deleted successfully.';
    }

    public function getDeletedSuccessMessage(): string
    {
        if (method_exists($this->getSource(), 'getDeletedSuccessMessage')) {
            return $this->getSource()::getDeletedSuccessMessage();
        }
        return $this->deletedSuccessMessage ?: 'Item deleted successfully.';
    }

    public function getRestoredSuccessMessage(): string
    {
        if (method_exists($this->getSource(), 'getRestoredSuccessMessage')) {
            return $this->getSource()::getRestoredSuccessMessage();
        }
        return $this->restoredSuccessMessage ?: 'Item restored successfully.';
    }

    public function getSuccessMassage(): string
    {
        return $this->successMassage;
    }
}
