<?php
$config = array(
    'projectName'                   => 'protected',
    'modelName'                     => 'protected',
    'projectTitle'                  => '沿途画室',
    'defaultController'             => 'site',

    'smarty'                        => array(
        'is_on'                     => true,    // 是否使用smarty模板
        'left_delimiter'            => '{%',
        'right_delimiter'           => '%}',
        'debugging'                 => false,
        'caching'                   => false,
        'cache_lifetime'            => 120,
        'compile_check'             => true,
        'template_dir'              => 'templates',
        'config_dir'                => 'templates/config',
        'cache_dir'                 => 'data/templates/cache/index',
        'compile_dir'               => 'data/templates/compile/index'
    ),

    'debuger'                       => false,       // 显示debug信息
    'crash_show_sql'                => true,        // 是否显示错误sql

    'ini_set'                       => array(
        'session.cookie_domain'     => '.myenterprise.com', // session跨域设置
        'display_errors'            => 1,
    ),

    'database'                      => array(
        'driver'                    => 'wmysqli',
        'master'                    => array(
            'dbhost'                => '127.0.0.1',
            'dbport'                => 3306,
            'username'              => 'root',
            'password'              => '',
            'dbname'                => 'enterprise',
            'charset'               => 'utf8',
            'table_prefix'          => 'w_',
            'pconnect'              => false
        )
    ),
    'session'                       => array(
        'driver'                    => 'db',
        'timeout'                   => 86400
    ),

    // 'session_memcache'              => array(
    //     array(
    //         'host'                  => '127.0.0.1',
    //         'port'                  => 11211
    //     )
    // ),

    // 'session_redis'                 => array(
    //     'master'                    => array(
    //         'host'                  => '127.0.0.1',
    //         'port'                  => 6379
    //     )
    // ),

    'cookie'                        => array(
        'domain'                    => '.myenterprise.com',
        'timeout'                   => 86400*30
    ),

    // 'memcache'                      => array(
    //     array(
    //         'host'                  => 'localhost',
    //         'port'                  => 11211
    //     ),
    // ),

    // 'redis'                 => array(
    //     'master'            => array(
    //         'host'          => '127.0.0.1',
    //         'port'          => 6379,
    //         'prefix'        => 'en_'
    //     )
    // ),
);
?>
