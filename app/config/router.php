<?php

$di->set('router', function () {
    $router = new \Phalcon\Mvc\Router(false);
    $router->removeExtraSlashes(true);

    $router->add("/", array(
        "controller" => "Index",
        "action" => "index"
    ));

    $router->setDefaults(array(
        'controller' => 'Index',
        'action' => 'error'
    ));

    return $router;

});
