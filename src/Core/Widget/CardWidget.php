<?php

namespace Raakkan\Yali\Core\Widget;

class CardWidget extends YaliWidget
{
    public static function getMdGridColumnSpan(): int
    {
        return 2;
    }

    public function render()
    {
        return view('yali::widgets.card-widget');
    }
}
