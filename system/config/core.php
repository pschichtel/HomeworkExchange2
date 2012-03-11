<?php
    return array(
        'controllerDir' => 'pages',
        'componentDir' => 'components',
        'filterDir' => 'filters',
        'pluginDir' => 'plugins',
        'themeDir' => 'public' . DIRECTORY_SEPARATOR . 'themes',
        
        'components' => array(
            'FrontController' => array(
                'defaultController' => 'index',
                'errorController' => 'error'
            ),
            'TemplateProvider' => array(
                'theme' => 'default'
            ),
            'Database' => array(
                'dsn' => 'mysql:host=localhost;port=3307;dbname=test',
                'user' => 'root',
                'pass' => '',
                'charset' => 'utf8',
                'options' => array()
            )
        ),
    );
?>
