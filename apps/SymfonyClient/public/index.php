<?php

use SymfonyClient\Kernel;

$_SERVER['APP_RUNTIME'] = 'Runtime\Swoole\Runtime';

$_SERVER['APP_RUNTIME_OPTIONS'] = [
    'host' => '0.0.0.0',
    'port' => 9501,
    'mode' => SWOOLE_PROCESS,
    'settings' => [
        \Swoole\Constant::OPTION_WORKER_NUM => 10,
        \Swoole\Constant::OPTION_ENABLE_STATIC_HANDLER => true,
        \Swoole\Constant::OPTION_DOCUMENT_ROOT => dirname(__DIR__).'/public'
    ],
];

require_once dirname(__DIR__).'/../../vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
