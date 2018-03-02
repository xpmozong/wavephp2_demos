<?php
header('Content-Type:text/html;charset=utf-8');
// error_reporting(0);
define('ROOT_PATH', dirname(__FILE__));
require ROOT_PATH.'/vendor/autoload.php';

require ROOT_PATH.'/environment.php';

$envConfig = 'product';
if ($environment === 2) {
    $envConfig = 'local_dev';
}elseif ($environment === 3) {
    $envConfig = 'testing';
}
$configfile = ROOT_PATH.'/protected/config/enterprise/'.$envConfig.'/main.php';

$wave = new Wave($configfile);
$wave->run();

?>