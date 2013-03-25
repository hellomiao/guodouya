<?php

$backend = dirname(dirname(__FILE__));
$frontend = dirname($backend);
Yii::setPathOfAlias('backend', $backend);

return array(
    'basePath' => $frontend,
    'controllerPath' => $backend . '/controllers',
    'viewPath' => $backend . '/views',
    'runtimePath' => $backend . '/runtime',
    'defaultController' => 'index',
    'import' => array(
        'backend.models.*',
        'backend.components.*',
        'application.models.*',
        'application.components.*',
    ),
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('backend.php/index/login'),
        ),
        'db' => require($frontend . '/config/db.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'login' => 'index/login',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
    ),
       
);