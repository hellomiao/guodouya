<?php

$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/backend/config/main.php';
defined('YII_DEBUG') or define('YII_DEBUG',true);  
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',4);

require_once($yii);
Yii::createWebApplication($config)->run();
?>
