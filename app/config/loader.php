<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering namespaces
 */
$loader
    ->registerNamespaces(array(
        'App\Controllers' => $config->application->controllersDir,
        'App\Models' => $config->application->modelsDir,
        'App\Modules' => $config->application->modulesDir,
    ))
    ->register();

require_once APP_PATH . '/app/library/composer/autoload.php';
