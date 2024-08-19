<?php

namespace Eason\Monolog\Processer;

use Monolog\Processor\ProcessorInterface;

/**
 * @see https://www.php.net/manual/en/function.debug-backtrace
 * 利用 debug_backtrace 把相關訊息抓近來紀錄
 */
class TraceMessageProcessor implements ProcessorInterface
{
    private int $option;
    private int $deep;

    /**
     * @param int $option This parameter is a bitmask for the following options
     * @param int $deep This parameter can be used to limit the number of stack frames returned.
     * @return void
     */
    public function __construct(int $option = DEBUG_BACKTRACE_IGNORE_ARGS, int $deep = 5)
    {
        $this->option = $option;
        $this->deep = $deep;
    }

    public function __invoke(array $record)
    {
        $traceMessageList = debug_backtrace($this->option, $this->deep);
        if (!empty($traceMessageList)) {
            $record['extra']['traceMessage'] = json_encode($traceMessageList, JSON_UNESCAPED_UNICODE);
        }

        return $record;
    }
}