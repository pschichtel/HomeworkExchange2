<?php

    error_reporting(-1);

    define('DS', DIRECTORY_SEPARATOR);
    define('APP_PATH', dirname(__FILE__));
    define('SYS_PATH', APP_PATH . DS . 'system');

    require_once SYS_PATH . DS . 'lib' . DS . 'ClassLoader.php';
    ClassLoader::register();

    App::initialize(new PhpConfiguration(SYS_PATH . DS . 'config' . DS . 'core.php'));

    $config = new DbConfiguration('config');
    var_dump($config);
    $config->set(mt_rand(), mt_rand());
    var_dump($config);
    $config->save();
?>
