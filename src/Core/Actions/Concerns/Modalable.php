<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait Modalable
{
    protected bool $isModal = false;

    protected $modalData = [
        'slideLeft' => false,
        'slideRight' => false,
        'slideUp' => false,
        'slideDown' => false,
        'closeOnOutsideClick' => false,
        'closeOnEscape' => false,
    ];

    public function isModal()
    {
        return $this->isModal;
    }

    public function modal(
        bool $slideLeft = false,
        bool $slideRight = false,
        bool $slideUp = false,
        bool $slideDown = false,
        bool $closeOnOutsideClick = false,
        bool $closeOnEscape = false
    ) {
        $this->isModal = true;
        $this->buttonIsLink = false;

        if ($slideLeft) {
            $this->modalData['slideLeft'] = true;
        }
        if ($slideRight) {
            $this->modalData['slideRight'] = true;
        }

        // pending
        // if ($slideUp) {
        //     $this->modalData['slideUp'] = true;
        // }
        // if ($slideDown) {
        //     $this->modalData['slideDown'] = true;
        // }

        $this->modalData['closeOnOutsideClick'] = $closeOnOutsideClick;
        $this->modalData['closeOnEscape'] = $closeOnEscape;

        return $this;
    }

    public function getModalPosition()
    {
        if ($this->modalData['slideLeft']) {
            return 'left';
        } elseif ($this->modalData['slideRight']) {
            return 'right';
        } elseif ($this->modalData['slideUp']) {
            return 'bottom';
        } elseif ($this->modalData['slideDown']) {
            return 'top';
        }

        return 'center';
    }

    public function getModalData()
    {
        return $this->modalData;
    }

    public function slideLeft($slideLeft = true)
    {
        $this->modalData['slideLeft'] = $slideLeft;

        return $this;
    }

    public function slideRight($slideRight = true)
    {
        $this->modalData['slideRight'] = $slideRight;

        return $this;
    }

    public function slideUp($slideUp = true)
    {
        $this->modalData['slideUp'] = $slideUp;

        return $this;
    }

    public function slideDown($slideDown = true)
    {
        $this->modalData['slideDown'] = $slideDown;

        return $this;
    }

    public function isCloseOnOutsideClick()
    {
        return $this->modalData['closeOnOutsideClick'];
    }

    public function isCloseOnEscape()
    {
        return $this->modalData['closeOnEscape'];
    }

    public function closeOnOutsideClick($closeOnOutsideClick = true)
    {
        $this->modalData['closeOnOutsideClick'] = $closeOnOutsideClick;

        return $this;
    }

    public function closeOnEscape($closeOnEscape = true)
    {
        $this->modalData['closeOnEscape'] = $closeOnEscape;

        return $this;
    }
}
