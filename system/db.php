<?php
namespace system;
use system\db\exception;

/**
 * 数据库类
 */
class db extends db\mysql
{
    private static $instances = [];

    public static function get_instance($db) {
        if (isset(self::$instances[$db])) return self::$instances[$db];
        $config = be::get_config('db');
        if (!isset($config->$db)) {
            throw new exception('数据库配置项（'.$db.'）不存在！');
        }

        $config = $config->$db;
        switch ($config['driver']) {
            case 'mysql':
                self::$instances[$db] = new \system\db\mysql();
                break;
            default:
                throw new exception('数据库配置项（'.$db.'）指定的数据库驱动'.$config['driver'].'不支持！');
        }

        return self::$instances[$db];
    }
}