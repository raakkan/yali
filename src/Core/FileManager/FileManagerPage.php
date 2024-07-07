<?php 

namespace Raakkan\Yali\Core\FileManager;

use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Pages\YaliPage;

class FileManagerPage extends YaliPage
{
    protected static $title = 'File Manager';
    protected static $slug = 'file-manager';
    protected static $navigationLabel = 'File Manager';

    protected static $navigationOrder = 98;

    protected static $view = 'yali::pages.file-manager-page';

    public $testData = 'vxc';

    public function test($n)
    {
        $this->testData = 'test'. ++$n;
    }
}