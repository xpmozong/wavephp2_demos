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

require $configfile;

$config['defaultController'] = 'admin';
$config['projectName'] = 'admin';
$config['smarty']['cache_dir'] = 'data/templates/cache/admin';
$config['smarty']['compile_dir'] = 'data/templates/compile/admin';

$wave = new Wave();
$wave->run();

?>