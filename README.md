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

## Example
```
use Monolog\Logger
use Easonlee\MonologMysql\MySQLHandler
...
$mysqlHandler = new MySQLHandler(DB::connection('your_connection')->table("logs"));
$logger->pushHandler($mysqlHandler);
```
