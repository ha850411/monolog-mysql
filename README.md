# monolog-mysql
安裝該套件後 [monolog](https://github.com/Seldaek/monolog) 即可支援將 log 寫進 mysql

Support mysql handler for [monolog](https://github.com/Seldaek/monolog)

## Require
- language: php
- framework: Laravel

## Usage
```
composer require easonlee/monolog-mysql
```

## 使用 MySQLHandler
```php
<?php
use Monolog\Logger;
use Easonlee\MonologMysql\MySQLHandler;

$mysqlHandler = new MySQLHandler(DB::connection('your_connection')->table("logs"));
$logger->pushHandler($mysqlHandler);
```

---
## 使用 ExceptionProcessor

要使用 `ExceptionProcessor`，首先需要將其添加到 Monolog 記錄器中。這將允許你在記錄異常時，自動格式化異常信息。

```php
<?php

use Eason\Monolog\Processer\ExceptionProcessor;
use Monolog\Logger;

// 創建一個 Logger 實例
$logger = new Logger('name');

// 將 ExceptionProcessor 添加到 Logger 中
$logger->pushProcessor(new ExceptionProcessor());
```

## 使用 ExceptionProcessor 記錄異常
在你的代碼中捕獲異常並記錄它們。使用 ExceptionProcessor，你可以將異常對象傳遞給日誌記錄器，並自動格式化異常信息。
```php
<?php

try {
    // 模擬一個異常
    throw new Exception('test');
} catch (Throwable $exception) {
    // 記錄異常，並將異常對象作為上下文數據的一部分
    $logger->alert('An exception occurred', ['exception' => $exception]);
}
```