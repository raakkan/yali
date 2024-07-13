<?php

namespace Raakkan\Yali\Core\Widget;
use Raakkan\Yali\Core\Support\Concerns\UI\Iconable;

class CardWidget extends YaliWidget
{
    use Iconable;
    
    public static function getMdGridColumnSpan(): int
    {
        return 2;
    }

    public function render()
    {
        return view('yali::widgets.card-widget');
    }
}
