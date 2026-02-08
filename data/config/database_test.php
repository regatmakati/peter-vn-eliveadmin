<?php
/**
 * 配置文件
 */

return [
    // 数据库类型
    'type'     => 'mysql',
    // 服务器地址
    'hostname' => '192.168.0.233',
    // 数据库名
    'database' => 'live',
    // 用户名
    'username' => 'root',
    // 密码
    'password' => '1234QWer',
    // 端口
    'hostport' => '3306',
    // 数据库编码默认采用utf8
    'charset'  => 'utf8mb4',
    // 数据库表前缀
    'prefix'   => 'cmf_',
    "authcode" => 'rCt52pF2cnnKNB3Hkp',
    //#COOKIE_PREFIX#

    'REDIS_HOST' => "192.168.0.10",
    'REDIS_AUTH' => "",
    'REDIS_PORT' => "6379",

    'chatUrl' => '192.168.0.211',
    'chatPort' => 9511,
    'socketSecretKey' => 'f7s8v8bnm9ad54c5badda7d6304r0higfuad',
];