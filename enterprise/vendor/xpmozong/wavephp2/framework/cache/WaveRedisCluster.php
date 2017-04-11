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
 * Wavephp Application RedisCluster Class
 *
 * Redis 操作，支持 Master/Slave 的负载集群
 *
 * @package         Wavephp
 * @subpackage      cache
 * @author          许萍
 *
 */
class WaveRedisCluster
{
    // 是否使用 M/S 的读写集群方案
    private $_isUseCluster = false;

    // Slave 句柄标记
    private $_sn = 0;

    // 服务器连接句柄
    private $_linkHandle = array(
        'master'=>null,// 只支持一台 Master
        'slave'=>array(),// 可以有多台 Slave
    );

    /**
     * 构造函数
     *
     * @param boolean $isUseCluster 是否采用 M/S 方案
     *
     */
    public function __construct($isUseCluster = false)
    {
        $this->_isUseCluster = $isUseCluster;
    }

    /**
     * 连接服务器,注意：这里使用长连接，提高效率，但不会自动关闭
     *
     * @param array $config Redis服务器配置
     * @param boolean $isMaster 当前添加的服务器是否为 Master 服务器
     * @param int $db 数据库
     * @return boolean
     *
     */
    public function connect($config, $isMaster = true, $db = 0)
    {
        // default port
        if (!isset($config['port'])) {
            $config['port'] = 6379;
        }
        // 设置 Master 连接
        if ($isMaster) {
            $this->_linkHandle['master'] = new Redis();
            $ret = $this->_linkHandle['master']
                        ->connect($config['host'],$config['port'], 3);
            if ($ret && $db) {
                $this->_linkHandle['master']->select($db);
            }
        }else {
            // 多个 Slave 连接
            $this->_linkHandle['slave'][$this->_sn] = new Redis();
            $ret = $this->_linkHandle['slave'][$this->_sn]
                        ->connect($config['host'],$config['port'], 3);
            if ($ret && $db) {
                $this->_linkHandle['slave'][$this->_sn]->select($db);
            }
            ++$this->_sn;
        }

        return $ret;
    }

    /**
     * 关闭连接
     *
     * @param int $flag 关闭选择 0:关闭 Master 1:关闭 Slave 2:关闭所有
     * @return boolean
     *
     */
    public function close($flag = 2)
    {
        switch ($flag) {
            // 关闭 Master
            case 0:
                $this->getRedis()->close();
            break;
            // 关闭 Slave
            case 1:
                for ($i = 0; $i < $this->_sn; ++$i) {
                    $this->_linkHandle['slave'][$i]->close();
                }
            break;
            // 关闭所有
            case 2:
                $this->getRedis()->close();
                for ($i = 0 ; $i < $this->_sn; ++$i) {
                    $this->_linkHandle['slave'][$i]->close();
                }
            break;
        }

        return true;
    }

    /**
     * 得到 Redis 原始对象可以有更多的操作
     *
     * @param boolean $isMaster 返回服务器的类型 true:返回Master false:返回Slave
     * @return redis object
     *
     */
    public function getRedis($isMaster = true)
    {
        if ($isMaster) {
            return $this->_linkHandle['master'];
        } else {
            if ($this->_isUseCluster) {
                return $this->_getSlaveRedis();
            } else {
                return $this->_linkHandle['master'];
            }
        }
    }

    /**
     * 写缓存
     *
     * @param string $key 组存KEY
     * @param string $value 缓存值
     * @param int $expire 过期时间， 0:表示无过期时间
     *
     */
    public function set($key, $value, $expire = 0)
    {
        // 永不超时
        if ($expire == 0) {
            $ret = $this->getRedis()->set($key, $value);
        } else {
            $ret = $this->getRedis()->setex($key, $expire, $value);
        }

        return $ret;
    }

    /**
     * 读缓存
     *
     * @param string $key 缓存KEY,支持一次取多个 $key = array('key1','key2')
     * @return string || boolean  失败返回 false, 成功返回字符串
     *
     */
    public function get($key)
    {
        // 是否一次取多个值
        $func = is_array($key) ? 'mGet' : 'get';

        return $this->getRedis(false)->{$func}($key);
    }

    /**
     * 删除缓存
     *
     * @param string || array $key 缓存KEY，支持单个健:"key1" 或多个健:array('key1','key2')
     * @return int 删除的健的数量
     *
     */
    public function delete($key)
    {
        // $key => "key1" || array('key1','key2')
        return $this->getRedis()->delete($key);
    }

    /**
     * 值加加操作,类似 ++$i ,如果 key 不存在时自动设置为 0 后进行加加操作
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     *
     */
    public function incr($key, $default = 1)
    {
        if ($default == 1) {
            return $this->getRedis()->incr($key);
        } else {
            return $this->getRedis()->incrBy($key, $default);
        }
    }

    /**
     * 值减减操作,类似 --$i ,如果 key 不存在时自动设置为 0 后进行减减操作
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     *
     */
    public function decr($key, $default = 1)
    {
        if ($default == 1) {
            return $this->getRedis()->decr($key);
        } else {
            return $this->getRedis()->decrBy($key, $default);
        }
    }

    /**
     * 插入一个值到列表中,如果列表不存在,新建一个列表
     * @param string $key
     * @param string $value
     *
     */
    public function lpush($key, $value)
    {
        return $this->getRedis()->lPush($key, $value);
    }

    /**
     * 删除列表的第一个值并返回它
     *
     * @param string $key
     * @return string
     *
     */
    public function lpop($key)
    {
        return $this->getRedis()->lPop($key);
    }

    /**
     * 插入一个值到列表中,如果列表不存在,新建一个列表
     *
     * @param string $key
     * @param string $value
     * @return boolean
     *
     */
    public function rpush($key, $value)
    {
        return $this->getRedis()->rPush($key, $value);
    }

    /**
     * 删除并返回列表的最后一个值
     *
     * @param string $key
     * @return string
     *
     */
    public function rpop($key)
    {
        return $this->getRedis()->rPop($key);
    }

    /**
     * 从列表中返回指定位置的值
     *
     * @param string $key
     * @param int $index
     * @return string
     *
     */
    public function lget($key, $index = 0)
    {
        $func = 'lGet';

        return $this->getRedis(false)->{$func}($key, $index);
    }

    /**
     * 获得列表的长度
     *
     * @param string $key
     * @return int
     *
     */
    public function llen($key)
    {
        $func = 'lLen';

        return $this->getRedis(false)->{$func}($key);
    }

    /**
     * 成员添加
     *
     * @param string $key
     * @param string $value
     * @return boolean
     *
     */
    public function sadd($key, $value)
    {
        return $this->getRedis()->sAdd($key, $value);
    }

    /**
     * 成员列表
     *
     * @param string $key
     * @return array
     *
     */
    public function smembers($key)
    {
        $func = 'sMembers';

        return $this->getRedis(false)->{$func}($key);
    }

    /**
     * 移除成员
     *
     * @param string $key
     * @param string $value
     * @return boolean
     *
     */
    public function sremove($key, $value)
    {
        return $this->getRedis()->sRemove($key, $value);
    }

    /**
     * 添空当前数据库
     *
     * @return boolean
     *
     */
    public function clear()
    {
        return $this->getRedis()->flushDB();
    }

    /* =================== 哈希操作 ========================*/
    /**
     * 将key->value写入hash表中
     *
     * @param $hash string 哈希表名
     * @param $data array 要写入的数据 array('key'=>'value')
     * @return boolean
     *
     */
    public function hashSet($hash, $key, $data)
    {
        $return = null;
        if (is_array($data) && !empty($data)) {
            $return = $this->getRedis()->hSet($hash, $key, $data);
        }

        return $return;
    }

    /**
     * 获取hash表的数据
     *
     * @param $hash string 哈希表名
     * @param $key mixed 表中要存储的key名 默认为null 返回所有key>value
     * @param $type int 要获取的数据类型 0:返回所有key 1:返回所有value 2:返回所有key->value
     * @return array
     *
     */
    public function hashGet($hash, $key = array(), $type = 0)
    {
        $return = null;
        if (!empty($key)) {
            if (is_array($key)) {
                $func = 'hMGet';
            } else {
                $func = 'hGet';
            }

            $return = $this->getRedis(false)->{$func}($hash, $key);
        } else {
            switch ($type) {
                case 0:
                    $func = 'hKeys';
                    break;
                case 1:
                    $func = 'hVals';
                    break;
                case 2:
                    $func = 'hGetAll';
                    break;
                default:
                    $return = false;
                    break;
            }

            $return = $this->getRedis(false)->{$func}($hash);
        }

        return $return;
    }

    /**
     * 获取hash表中元素个数
     *
     * @param $hash string 哈希表名
     *
     */
    public function hashLen($hash)
    {
        $return = null;

        $func = 'hLen';
        $return = $this->getRedis(false)->{$func}($hash);

        return $return;
    }

    /**
     * 删除hash表中的key
     *
     * @param $hash string 哈希表名
     * @param $key mixed 表中存储的key名
     *
     */
    public function hashDel($hash, $key)
    {
        return $this->getRedis()->hDel($hash, $key);
    }

    /**
     * 查询hash表中某个key是否存在
     *
     * @param $hash string 哈希表名
     * @param $key mixed 表中存储的key名
     *
     */
    public function hashExists($hash, $key)
    {
        $return = null;

        $func = 'hExists';
        $return = $this->getRedis(false)->{$func}($hash, $key);

        return $return;
    }

    /* =================== 以下私有方法 =================== */

    /**
     * 随机 HASH 得到 Redis Slave 服务器句柄
     *
     * @return redis object
     *
     */
    private function _getSlaveRedis()
    {
        // 就一台 Slave 机直接返回
        if ($this->_sn <= 1) {
            return $this->_linkHandle['slave'][0];
        }
        // 随机 Hash 得到 Slave 的句柄
        $hash = $this->_hashId(mt_rand(), $this->_sn);

        return $this->_linkHandle['slave'][$hash];
    }

    /**
     * 根据ID得到 hash 后 0～m-1 之间的值
     *
     * @param string $id
     * @param int $m
     * @return int
     *
     */
    private function _hashId($id, $m=10)
    {
        //把字符串K转换为 0～m-1 之间的一个值作为对应记录的散列地址
        $k = md5($id);
        $l = strlen($k);
        $b = bin2hex($k);
        $h = 0;
        for ($i = 0; $i < $l; $i++) {
            //相加模式HASH
            $h += substr($b, $i*2, 2);
        }
        $hash = ($h * 1) % $m;

        return $hash;
    }
}

?>
