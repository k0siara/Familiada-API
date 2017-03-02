<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

date_default_timezone_set("Europe/Warsaw");

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../src/config/settings.php';
$app = new \Slim\Slim($settings);

$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('wawpiwo_api');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

if (file_exists(__DIR__ . '/../src/config/database_config.php')) {
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection(include __DIR__ . '/../src/config/database_config.php');
    $capsule->bootEloquent();
    $capsule->setAsGlobal();
    $app->db = $capsule;
} else {
    die("<pre>Database file fucked up</pre>");
}

foreach(glob(__DIR__ . '/../src/libs/' . '*.php') as $lib) {
    require_once $lib;
}  

foreach(glob(__DIR__ . '/../src/routes/' . '*.php') as $router) {
    require_once $router;
}   

$app->run();