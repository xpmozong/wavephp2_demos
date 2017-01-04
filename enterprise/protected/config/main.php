<?php
$config = array(
    'projectName'           => 'protected',
    'modelName'             => 'protected',

    'defaultController'     => 'site',

    'smarty'                => array(
        'is_on'             => true,    // 是否使用smarty模板
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
    'crash_show_sql'        => true,        // 是否显示错误sql
    
    // 'ini_set'               => array(
    //     'session.cookie_domain'     => '.17kx.com', // session跨域设置
    //     'upload_max_filesize'       => '10M',
    //     'post_max_size'             => '10M',        
    //     'memory_limit'              => '256M',
    //     'session.use_cookies'       => 1,
    //     'session.auto_start'        => 1,
    //     'display_errors'            => 1,
    //     'date.timezone'             => 'Asia/Shanghai',
    //     'max_execution_time'        => 3600
    // ),
    
    'database'              => array(
        'driver'            => 'wmysqli',
        'master'            => array(
            'dbhost'        => '127.0.0.1',
            'dbport'        => 3306,
            'username'      => 'root',
            'password'      => '',
            'dbname'        => 'enterprise',
            'charset'       => 'utf8',
            'table_prefix'  => '',
            'pconnect'      => false
        )
    ),
    'session'               => array(
        'driver'            => 'db',
        'timeout'           => 86400
    ),
    // 'memcache'              => array(
    //     array(
    //         'host'          => 'localhost',
    //         'port'          => 11211
    //     ),
    // ),
    // 'redis'                 => array(
    //     'master'            => array(
    //         'host'          => '127.0.0.1',
    //         'port'          => 6379
    //     ),
    //     'slave'             => array(
    //         array(
    //             'host'      => '127.0.0.1',
    //             'port'      => 63791
    //         ),
    //         array(
    //             'host'      => '127.0.0.1',
    //             'port'      => 63792
    //         )
    //     )
    // )
);
?>