<?php
$config = array(
    'projectName'           => 'protected',
    'modelName'             => 'protected',

    'defaultController'     => 'site',

    'smarty'                => array(
        'is_on'             => false,    // 是否使用smarty模板
        'left_delimiter'    => '{%',
        'right_delimiter'   => '%}',
        'debugging'         => false,
        'caching'           => false,
        'cache_lifetime'    => 120,
        'compile_check'     => true,
        'template_dir'      => 'templates',
        'config_dir'        => 'templates/config',
        'cache_dir'         => 'data/templates/cache/index',
        'compile_dir'       => 'data/templates/compile/index'
    ),
    
    'debuger'               => false,       // 显示debug信息
    'crash_show_sql'        => true,
    
    'database'              => array(
        'driver'            => 'mysql',
        'master'            => array(
            'dbhost'        => '127.0.0.1',
            'username'      => 'root',
            'password'      => '',
            'dbname'        => 'enterprise',
            'charset'       => 'utf8',
            'table_prefix'  => '',
            'pconnect'      => false
        ),
        'slave'             => array(
            'dbhost'        => '127.0.0.1',
            'username'      => 'root',
            'password'      => '',
            'dbname'        => 'enterprise',
            'charset'       => 'utf8',
            'table_prefix'  => '',
            'pconnect'      => false
        )
    ),
    
    'session'=>array(
        'driver'            => 'file',
        'timeout'           => 86400
    )
);
?>