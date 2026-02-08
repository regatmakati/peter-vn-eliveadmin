<?php
/**
 * Gogosport视频源接口
 */
namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class GgsportController extends HomebaseController {
	
	function getSportCategory(){       
		$data = $this->request->param();
        $app_id=isset($data['app_id']) ? $data['app_id']: '';
        $app_secret=isset($data['app_secret']) ? $data['app_secret']: '';

		if($app_id != 'no3qm09xc1i3b1m4'){
			echo json_encode(array("status"=>101,'msg'=>'缺少app_id或者app_id不对！'));
			exit;
		}
		if($app_secret != 'de2316eb58434561a450ab2e915e4e17'){
			echo json_encode(array("status"=>102,'msg'=>'缺少app_secret或者app_secret不对！'));
			exit;
		}
		$ip= get_client_ip(0,true);//43.135.86.123
		if($ip != '43.135.86.123'){
			//echo json_encode(array("status"=>103,'msg'=> $ip.'IP受限，请添加白名单'));
			//exit;
		}
		$list = Db::name('live_class')
			->field("id,name,des")
			->select()
			->toArray();
        echo json_encode(array("status"=>0,'data'=>array("list" => $list),'msg'=>'success'));
        exit;			
	    
	}

	function getMatchList(){       
		$data = $this->request->param();
        $app_id=isset($data['app_id']) ? $data['app_id']: '';
        $app_secret=isset($data['app_secret']) ? $data['app_secret']: '';
        $page=isset($data['page']) ? intval(abs($data['page'])): 1;
        $pagesize=isset($data['pagesize']) ? intval(abs($data['pagesize'])): 100;
		
		if($app_id != 'no3qm09xc1i3b1m4'){
			echo json_encode(array("status"=>101,'msg'=>'缺少app_id或者app_id不对！'));
			exit;
		}
		if($app_secret != 'de2316eb58434561a450ab2e915e4e17'){
			echo json_encode(array("status"=>102,'msg'=>'缺少app_secret或者app_secret不对！'));
			exit;
		}
		$ip= get_client_ip(0,true);//43.135.86.123
		if($ip != '43.135.86.123'){
			//echo json_encode(array("status"=>103,'msg'=> $ip.'IP受限，请添加白名单'));
			//exit;
		}
		if($pagesize > 100){
			echo json_encode(array("status"=>104,'msg'=>'每页最多返回100条记录'));
			exit;
		}		
		
		$start = ($page - 1) * $pagesize;
		$list = Db::name('ggscore_match')
			->field("*")
			->limit($start,$pagesize)
			->select()
			->toArray();
        echo json_encode(array("status"=>0,'data'=>array("list" => $list),'msg'=>'success'));
        exit;			
	    
	}

	function list(){       
		$data = $this->request->param();
        $app_id=isset($data['app_id']) ? $data['app_id']: '';
        $app_secret=isset($data['app_secret']) ? $data['app_secret']: '';

		if($app_id != 'no3qm09xc1i3b1m4'){
			echo json_encode(array("status"=>101,'msg'=>'缺少app_id或者app_id不对！'));
			exit;
		}
		if($app_secret != 'de2316eb58434561a450ab2e915e4e17'){
			echo json_encode(array("status"=>102,'msg'=>'缺少app_secret或者app_secret不对！'));
			exit;
		}
		$ip= get_client_ip(0,true);//43.135.86.123
		if($ip != '43.135.86.123'){
			//echo json_encode(array("status"=>103,'msg'=>'IP受限，请添加白名单'));
			//exit;
		}
		$rkey= 'ROR_'.ip2long(get_client_ip(0,true));
		$ror = cache($rkey)??0;
		if(time() - $ror < 60){
			echo json_encode(array("status"=>105,'msg'=>'接口请求频率太高'));
			exit;			
		}
		$list = Db::name('live l')
			->field("l.liveclassid,l.match_id,l.uid as room_id,l.stream,l.title,l.starttime,l.pic_full_url as cover,g.id")
			->leftJoin('ggscore_match g','l.match_id=g.match_id')
			->where("l.islive=1")
            ->order('l.starttime desc')
			->select()
            ->toArray();
		//echo(Db::name('live l')->getlastsql());
		//gogozbpull.frgat.cn  key:7Nj6dK7kdPyQSrPdAPT6	
		foreach($list as $key => &$val){
			$stream_id = $val['stream'];
			$val['flv'] = PrivateKey_tx_cs($stream_id.'.flv', 0,'https://gogozbpull.frgat.cn','7Nj6dK7kdPyQSrPdAPT6');
			$val['m3u8'] = PrivateKey_tx_cs($stream_id.'.m3u8', 0,'https://gogozbpull.frgat.cn','7Nj6dK7kdPyQSrPdAPT6');
			if($val['cover']){
				$val['cover'] = 'https://admin.gogosports.live/upload/images/'.	$val['cover'];
			}
			
		}
		cache($rkey,time());	
        echo json_encode(array("status"=>0,'data'=>array("list" => $list),'msg'=>'success'));
        exit;			
	    
	}	

}