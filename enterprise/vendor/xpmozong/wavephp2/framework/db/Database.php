<?php
/**
 * PHP 5.0 以上
 * 
 * @package         Wavephp
 * @author          许萍
 * @copyright       Copyright (c) 2016
 * @link            https://github.com/xpmozong/wavephp2
 * @since           Version 2.0
 *
 */

/**
 * Wavephp Application Database Class
 *
 * 数据库工厂类
 *
 * @package         Wavephp
 * @subpackage      db
 * @author          许萍
 *
 */
class Database {
    public static $db;
    /**
     * 工厂方法
     *
     * @param string $dbname 数据库名称
     *
     * @return object $db
     *
     */
    public static function factory($dbname = '') {
        $option = Wave::app()->config[$dbname];
        
        $driver = isset($option['driver']) ? $option['driver'] : 'mysql';
        if (isset(self::$db[$dbname]) && is_object(self::$db[$dbname])) {
            return self::$db[$dbname];
        }
        
        $class = ucfirst($driver);
        self::$db[$dbname] = new $class($option);
        
        return self::$db[$dbname];
    }
}

?>