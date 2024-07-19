<?php

namespace Easonlee\MonologMysql;

use Monolog\Handler\AbstractProcessingHandler;

class MySQLHandler extends AbstractProcessingHandler
{
    protected function write($connection, array $record): void
    {
        $connection->insert([
            'channel' => $record['channel'],
            'level' => $record['level'],
            'message' => $record['message'],
            'time' => $record['datetime']->format('Y-m-d H:i:s')
        ]);
    }
}
