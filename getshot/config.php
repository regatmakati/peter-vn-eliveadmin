<?php
/**
 * 配置文件
 */

return [
    //mysql
    'HOSTNAME' => '172.19.0.17',//'10.206.0.15',
    'DATABASE' => 'live',
    'USERNAME' => 'live',
    'PASSWORD' => 'aO!FeJR8lAaH7*yW',
    'HOSTPORT' => '3306',
    'CHARSET'  => 'utf8',
    'PREFIX'   => 'cmf_',

	
    //socket server
    'SOCKET_SERVER' => "129.226.169.10",
    'SOCKET_PORT' => "9501",
	
	//redis
    'REDIS_HOST' => '172.19.0.11',//"10.206.0.13",
    'REDIS_AUTH' => "Odgo!L8kH^mKahr$",
    'REDIS_PORT' => "6379",
	
	//拉流域名协议
	'PULL_STREAM_PROTOCOL' => 'https',
	//拉流域名
	'PULL_STREAM_DOMAIN' => 'bt-pull.tsguiju.cn',
	//鉴权key
	'KEY' => '44c84279664f828244bf5f271e87f7ec',
];

