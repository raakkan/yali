<?php

namespace Raakkan\Yali\App;

use Raakkan\Yali\Core\Pages\YaliPage;

class DashboardPage extends YaliPage
{
    protected static $title = 'Dashboard';

    protected static $navigationLabel = 'Dashboard';

    protected static $navigationOrder = 0;

    protected static $navigationIcon = 'dashboard';

    protected static $view = 'yali::pages.dashboard-page';

    protected static $slug = '/';

    public function getWidgets()
    {
        return [
            \Raakkan\Yali\Core\Widget\CardWidget::class,
            \Raakkan\Yali\Core\Widget\CardWidget::class,
        ];
    }
}
