<?php
namespace App\System\Config;

use Phpbe\System\Be;

class Db
{
    public $master = [
        'driver' => 'mysql',
        'host' => '172.24.0.100', // 主机名
        'port' => 3306, // 端口号
        'user' => 'root', // 用户名
        'pass' => '10241024', // 密码
        'name' => 'phpbe' // 数据库名称
    ]; // 主数据库


    public function __construct()
    {
        if (Be::getRuntime()->getEnv() == 'prod') {
            $this->master = [
                'driver' => 'mysql',
                'host' => '127.0.0.1', // 主机名
                'port' => 3306, // 端口号
                'user' => 'root', // 用户名
                'pass' => '', // 密码
                'name' => 'phpbe' // 数据库名称
            ]; // 主数据库
        }
    }
}
