<?php

    error_reporting(-1);

    define('DS', DIRECTORY_SEPARATOR);
    define('APP_PATH', dirname(__FILE__));
    define('SYS_PATH', APP_PATH . DS . 'system');

    require_once SYS_PATH . DS . 'lib' . DS . 'ClassLoader.php';
    ClassLoader::register();

    App::initialize(new PhpConfiguration(SYS_PATH . DS . 'config' . DS . 'core.php'))
        ->getComponent('FrontController')
        ->run();
?>
