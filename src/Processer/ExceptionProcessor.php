<?php

namespace Eason\Monolog\Processer;

use Monolog\Processor\ProcessorInterface;
use Throwable;

class ExceptionProcessor implements ProcessorInterface
{
    /**
     * 把 context 中的 exception 轉換成附加資訊
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        if (isset($record['context']['exception']) && $record['context']['exception'] instanceof Throwable) {
            $exception = $record['context']['exception'];
            $record['extra']['exception'] = [
                'class' => get_class($exception),
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ];
            unset($record['context']['exception']);
        }
        return $record;
    }
}