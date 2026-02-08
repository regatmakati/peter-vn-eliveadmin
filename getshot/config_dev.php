<?php
/**
 * 配置文件
 */

return [
    //mysql
    'HOSTNAME' => '124.71.31.246',
    'DATABASE' => 'live',
    'USERNAME' => 'root',
    'PASSWORD' => '1234QWer',
    'HOSTPORT' => '3306',
    'CHARSET'  => 'utf8',
    'PREFIX'   => 'cmf_',

	
    //socket server
    'SOCKET_SERVER' => "0.0.0.0",
    'SOCKET_PORT' => "9501",
	
	//redis
    'REDIS_HOST' => "127.0.0.1",
    'REDIS_AUTH' => "",
    'REDIS_PORT' => "6379",
	
	//拉流域名协议
	'PULL_STREAM_PROTOCOL' => 'https',
	//拉流域名
	'PULL_STREAM_DOMAIN' => 'liveplay.netipv6.com',
	//鉴权key
	'KEY' => '02019d98d6084be641cbf67ce3aa65fc',
];

