<?php
header('Content-Type:text/html;charset=utf-8');
// error_reporting(0);

define('ROOT_PATH', dirname(__FILE__));

require ROOT_PATH.'/vendor/autoload.php';

require ROOT_PATH.'/define.php';
$configfile = ROOT_PATH.'/protected/config/main.php';
$wave = new Wave($configfile);
$wave->run();

?>