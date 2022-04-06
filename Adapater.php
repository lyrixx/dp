<?php

class Application
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function run(): void
    {
        $this->logger->log("coucou\n");
    }
}

interface LoggerInterface
{
    public function log(string $message): void;
}

class OldLogger
{
    public function debug($message)
    {
        echo $message;
    }
}

// ---------------

class LogAdapter implements LoggerInterface
{
    public function __construct(
        private readonly OldLogger $logger,
    ) {
    }

    public function log(string $message): void
    {
        $this->logger->debug($message);
    }
}

$oldLogger = new OldLogger();
$adapter = new LogAdapter($oldLogger);
$application = new Application($adapter);

$application->run();
