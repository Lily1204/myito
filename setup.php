<?php

require_once './vendor/autoload.php';
// setup Propel
require_once './config/generated-conf/config.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);
