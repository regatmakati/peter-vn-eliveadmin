<?php
/**
 * 腾讯直播截图
 * @author sukura
 */
    $config = require_once __DIR__."/config.php";
    require_once __DIR__."/DB.php";
    $db = new DB();
	$db->__setup([
		'dsn' => "mysql:dbname={$config['DATABASE']};host={$config['HOSTNAME']}:{$config['HOSTPORT']}",
		'username' => $config['USERNAME'],
		'password' => $config['PASSWORD'],
		'charset'  => $config['CHARSET']
	]);
    $sql = "SELECT * FROM cmf_live WHERE islive=1 AND (thumb='' OR ISNULL(thumb))";

	while (true) {
		$result = $db->fetchAll($sql);
		foreach($result as $key=>$val){
			$pull = $val['pull'];
			$pos = strpos($pull,"{$config['PULL_STREAM_DOMAIN']}/live/");
			$uid = $val['uid'];
			$ntime = time();
			$sdate = date('Ymd',$ntime);
			$dir = "/www/wwwroot/eliveadmin/public/upload/images/liveScreenShot/{$sdate}/";
			$pic = $dir."pic_{$uid}_{$ntime}.jpg";
			if(!is_dir($dir)){
				$cmd = "mkdir $dir";
				exec($cmd,$res);			
			}
			if($pos){
				//生成鉴权链接
				$key = $config['KEY'];
				$txTime = strtoupper(base_convert(time(),10,16));
				$streamName = $val['stream'];
				$txSecret = md5($key.$streamName.$txTime);
				
                $pull = "{$config['PULL_STREAM_PROTOCOL']}://{$config['PULL_STREAM_DOMAIN']}/live/{$val['stream']}.flv?txSecret={$txSecret}&txTime={$txTime}";
				$cmd = "rm -f /www/wwwroot/eliveadmin/public/upload/images/liveScreenShot/{$sdate}/pic_{$uid}_*";
				exec($cmd,$res);
				$cmd = "/usr/local/ffmpeg/bin/ffmpeg -i '$pull' -y -f image2 -ss 00:00:01 -t 0.001 -vframes 1 -s 800x450 -aspect 16:9 '$pic'";
				exec($cmd,$res);
				if(file_exists($pic)){
					$picurl = "liveScreenShot/{$sdate}/pic_{$uid}_{$ntime}.jpg";
					$db->update('cmf_live',array('pic_full_url'=>$picurl,'isoff'=>0),array('uid'=>$uid));
				}
//				else{
//					$db->update('cmf_live',array('pic_full_url'=>'','isoff'=>1),array('uid'=>$uid));
//				}
				
			}
		}
		sleep(120);
	}



