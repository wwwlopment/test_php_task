<?php

namespace components;

class FileLogger implements LoggerInterface
{
    private $file;

    public function __construct($filename, $timeZoneId = 'Europe/Kiev')
    {
        date_default_timezone_set($timeZoneId);
        $this->file = fopen($filename, 'a');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function log(string $message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        fwrite($this->file, "[$timestamp] $message\n");
    }
}
