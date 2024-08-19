<?php

namespace Eason\Monolog\Processer;

use Monolog\Processor\ProcessorInterface;

/**
 * 抓取 API 相關資訊
 * 需要看一下 invoke 實作，要自定義一些參數，在初始化的時候丟入近來
 */
class ApiProcessor implements ProcessorInterface
{
    /** @var array */
    private array $info;

    public function __construct(array $apiInfo)
    {
        $this->info = $apiInfo;
    }

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        if (!empty($this->info) && is_array($this->info)) {
            $record['extra']['api']['traceId'] = !empty($this->info['traceId']) ? $this->info['traceId'] : '';
            $record['extra']['api']['method'] = !empty($this->info['method']) ? strtolower($this->info['method']) : '';
            $record['extra']['api']['endpoint'] = !empty($this->info['endpoint']) ? $this->info['endpoint'] : '';
            $record['extra']['api']['statusCode'] = !empty($this->info['statusCode']) ? (int) $this->info['statusCode'] : 0;
            $record['extra']['api']['responseData'] = '';
            if (!empty($this->info['responseData'])) {
                $record['extra']['api']['responseData'] = $this->info['responseData'];
            }

            $requestParams = '';
            if (!empty($this->info['requestData']) && $this->info['requestData'] !== '[]') {
                $requestParams = $this->info['requestData'];
            }
            $record['extra']['api']['requestData'] = $requestParams;
        }
        return $record;
    }
}