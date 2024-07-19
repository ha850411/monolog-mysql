<?php

namespace Easonlee\MonologMysql;

use Monolog\Handler\AbstractProcessingHandler;

class MySQLHandler extends AbstractProcessingHandler
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    protected function write(array $record): void
    {
        $this->connection->insert([
            'channel' => $record['channel'],
            'level' => $record['level'],
            'message' => $record['message'],
            'time' => $record['datetime']->format('Y-m-d H:i:s')
        ]);
    }
}
