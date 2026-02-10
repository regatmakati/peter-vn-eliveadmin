<?php
/**
 * 配置文件
 */

return [
    // 数据库类型
    'type'     => 'mysql',
    // 服务器地址
    'hostname' => '172.19.0.17',
    // 数据库名
    'database' => 'live',
    // 用户名
    'username' => 'live',
    // 密码
    'password' => 'aO!FeJR8lAaH7*yW',
    // 端口
    'hostport' => '3306',
    // 数据库编码默认采用utf8
    'charset'  => 'utf8mb4',
    // 数据库表前缀
    'prefix'   => 'cmf_',
    "authcode" => 'rCt52pF2cnnKNB3Hkp',
    //#COOKIE_PREFIX#

    'REDIS_HOST' => "172.19.0.15",
    'REDIS_AUTH' => "Odgo!L8kH^mKahr$",
    'REDIS_PORT' => "6379",

    'chatUrl' => '101.33.118.229',
    'chatPort' => 9511,
    'socketSecretKey' => 'f7s8v8bnm9ad54c5badda7d6304r0higfuad',



    'mysql_sport' => [
        'type'     => 'mysql',
        'hostname' => '172.19.0.14',
        'database' => 'center_sports',
        'username' => 'sports',
        'password' => 'aO!FeJR8lAaH7*yW',
        'hostport' => '3306',
        'charset'  => 'utf8mb4',
        'prefix'   => '',
    ]
];
