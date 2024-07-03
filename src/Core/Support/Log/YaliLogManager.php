<?php

namespace Raakkan\Yali\Core\Support\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class YaliLogManager
{
    protected $logger;

    public function __construct()
    {
        $handler = new StreamHandler(
            storage_path('logs/yali.log'),
            Logger::DEBUG
        );

        $this->logger = new Logger('yali', [$handler]);
    }
    
    public function log($level, $message, array $context = [])
    {
        return $this->logger->log($level, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        return $this->logger->debug($message, $context);
    }

    public function info($message, array $context = [])
    {
        return $this->logger->info($message, $context);
    }

    public function error($message, array $context = [])
    {
        return $this->logger->error($message, $context);
    }

    public function warning($message, array $context = [])
    {
        return $this->logger->warning($message, $context);
    }

    public function notice($message, array $context = [])
    {
        return $this->logger->notice($message, $context);
    }

    public function critical($message, array $context = [])
    {
        return $this->logger->critical($message, $context);
    }

    public function alert($message, array $context = [])
    {
        return $this->logger->alert($message, $context);
    }

    public function emergency($message, array $context = [])
    {
        return $this->logger->emergency($message, $context);
    }
}
