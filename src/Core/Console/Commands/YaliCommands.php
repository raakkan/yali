<?php

namespace Raakkan\Yali\Core\Console\Commands;

use Illuminate\Console\Command;

class YaliCommands extends Command
{
    protected $signature = 'yali';

    protected $description = 'Yali command group';

    public function handle()
    {
        $this->info('Available Yali commands:');
        $this->info('  yali:make-resource');
        $this->info('  yali:load-translations');
    }

    protected function commands()
    {
        return [
            MakeResourceCommand::class,
            LoadTranslationsCommand::class,
        ];
    }
}
