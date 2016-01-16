<?php
header('Content-Type:text/html;charset=utf-8');
// error_reporting(0);

define('ROOT_PATH', dirname(__FILE__));

require ROOT_PATH.'/vendor/autoload.php';

$configfile = ROOT_PATH.'/protected/config/main.php';
require $configfile;

$config['defaultController'] = 'adminsite';
$config['projectName'] = 'admin';
$config['smarty']['cache_dir'] = 'data/templates/cache/admin';
$config['smarty']['compile_dir'] = 'data/templates/compile/admin';

$wave = new Wave();
$wave->run();

?>