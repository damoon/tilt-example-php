<?php

require __DIR__ . '/vendor/autoload.php';

$log = new Monolog\Logger('example-php');
$log->pushHandler(new Monolog\Handler\StreamHandler("php://stdout"));
$log->addWarning('Example: ' . getenv('PHP_ENV'));

function get_update_time_secs() {
    $start_ns_since_epoch = file_get_contents("start-time.txt");
    $start_ns_since_epoch = $start_ns_since_epoch / 1000000000;
    $now_secs_since_epoch = microtime(true);
    return round($now_secs_since_epoch - $start_ns_since_epoch, 2);
}

$liveReloadScript = '';
if (getenv('PHP_ENV') == "development") {
    $liveReloadScript = '<script src="/static/reload.js"></script>';
}

$index = file_get_contents("templates/index.html");
$lastUpdate = get_update_time_secs();
$index = str_replace("{{time}}", $lastUpdate, $index);

$index = str_replace("{{live_reload}}", $liveReloadScript, $index);

echo $index;
