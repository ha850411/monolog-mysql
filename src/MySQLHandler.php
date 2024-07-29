<?php

namespace Easonlee\MonologMysql;

use Illuminate\Database\Connection;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class MySQLHandler extends AbstractProcessingHandler
{
    private $connection;

    /**
     * @param Connection $connection
     * @param int|string $level  設定處理程序的日誌等級，只有等於或高於這個等級的日誌記錄才會被處理
     * @param bool       $bubble 控制日誌記錄是否應該繼續傳遞給其他處理程序
     */
    public function __construct(Connection $connection, $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->connection = $connection;
        parent::__construct($level, $bubble);
    }

    /**
     * 實際處理和存儲日誌記錄
     *
     * @param array $record
     * @return void
     */
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
