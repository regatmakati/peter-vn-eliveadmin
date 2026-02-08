<?php
/**
 * 直播回放
 */
namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;

use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Live\V20180801\LiveClient;
use TencentCloud\Live\V20180801\Models\DescribeLiveStreamStateRequest;

class livebackController extends HomebaseController {
	
	/* 
		回调数据格式
		{
				"channel_id": "2121_15919131751",
				"end_time": 1473125627,
				"event_type": 100,
				"file_format": "flv",
				"file_id": "9192487266581821586",
				"file_size": 9749353,
				"sign": "fef79a097458ed80b5f5574cbc13e1fd",
				"start_time": 1473135647,
				"stream_id": "2121_15919131751",
				"t": 1473126233,
				"video_id": "200025724_ac92b781a22c4a3e937c9e61c2624af7",
				"video_url": "http://200025724.vod.myqcloud.com/200025724_ac92b781a22c4a3e937c9e61c2624af7.f0.flv"
		}
	*/
	function index(){
		$request = file_get_contents("php://input");
        
        $this->callbacklog('callback request:'.json_encode($request));
		$result = array( 'code' => 0 );    
		$data = json_decode($request, true);

		if(!$data){
			$this->callbacklog("request para json format error");
			$result['code']=4001;
			echo json_encode($result);	
			exit;
		}
		
		if(/* array_key_exists("t",$data) && array_key_exists("sign",$data) &&  */array_key_exists("event_type",$data)  && array_key_exists("stream_id",$data))
		{
			// $check_t = $data['t'];
			// $check_sign = $data['sign'];
			$event_type = $data['event_type'];
			$stream_id = $data['stream_id'];
		}else {
			$this->callbacklog("request para error");
			$result['code']=4002;
			echo json_encode($result);	
			exit;
		}
		/* $md5_sign = $this-> GetCallBackSign($check_t);
		if( !($check_sign == $md5_sign) ){
			$this->callbacklog("check_sign error:" . $check_sign . ":" . $md5_sign);
			$result['code']=4003;
			echo json_encode($result);	
			exit;
		}      */   
		
		if($event_type == 100){
			/* 回放回调 */
			if(array_key_exists("video_id",$data) && 
					array_key_exists("video_url",$data) &&
					array_key_exists("start_time",$data) &&
					array_key_exists("end_time",$data) ){
						
				$video_id = $data['video_id'];
				$video_url = $data['video_url'];
				$start_time = $data['start_time'];
				$end_time = $data['end_time'];
			}else{
				$this->callbacklog("request para error:回放信息参数缺少" );
				$result['code']=4002;
				echo json_encode($result);	
				exit;
			}
		}     
		$ret=0;
		if($event_type == 0){        	
			/* 状态回调 断流 */
			//$ret=$this->stopRoom('',$stream_id);
			$this->upOfftime(1,'',$stream_id);
		}elseif ($event_type == 1){
            /* 推流 */
			//$ret = $this->dao_live->callBackLiveStatus($stream_id,1);
            $this->upOfftime(0,'',$stream_id);
		}elseif ($event_type == 100){
			//$duration = $end_time - $start_time;
			//if ( $duration > 60 ){ 	
				$data=array(
					"video_url"=>$video_url,
					//"duration"=>$duration,
					//"file_id"=>$video_id,
				);								
				Db::name("live_record")->where(["stream"=>$stream_id])->update($data);
			//}else {
			//	$ret = 0;
			//	$this->callbacklog("tape duration too short:" . strval($duration) ."|" . $stream_id . "|" . $video_id);
			//}
			
		}	
		$result['code']=$ret; 
		echo json_encode($result);	
		exit;

	}
	
	public function GetCallBackSign($txTime){
		$config=getConfigPri();
        
		$md5_val = md5($config['live_push_key'] . strval($txTime));
		return $md5_val;
	}
	
	public function callbacklog($msg){
		// file_put_contents(CMF_ROOT.'data/liveback_'.date('Y-m-d').'.txt',date('Y-m-d H:i:s').' 提交参数信息 :'.$msg."\r\n",FILE_APPEND);
	}
    
	public function upOfftime($isoff=1,$uid='',$stream=''){
        $where['islive']=1;
		if($uid){
            $where['uid']=$uid;
		}else{
            $where['stream']=$stream;
		}
        $data=[
            'isoff'=>$isoff,
            'offtime'=>0,
        ];
        if($isoff==1){
            $data['offtime']=time();
        }
        
        $info=Db::name('live')->where($where)->update($data);
        
        return 0;
    }
	
	public function stopRoom($uid='',$stream=''){
        
        file_put_contents(CMF_ROOT.'data/uplive_'.date('Y-m-d').'.txt',date('Y-m-d H:i:s').' 提交参数信息 :'.$uid.'--'.$stream."\r\n",FILE_APPEND);
        $where['islive']=1;
		if($uid){
            $where['uid']=$uid;
		}else{
            $where['stream']=$stream;
		}
			
		$info=Db::name('live')->field('uid,showid,starttime,title,province,city,stream,lng,lat,type,type_val,liveclassid')->where($where)->find();

		if($info){
			Db::name('live')->where(['stream'=>$info['stream']])->delete();
            
            $uid=$info['uid'];
            $stream=$info['stream'];
            
			$nowtime=time();
			$info['endtime']=$nowtime;
			$info['time']=date("Y-m-d",$info['showid']);
            $where2['uid']=['neq',$uid];
            $where2['touid']=$uid;
            $where2['showid']=$info['showid'];
            
			$votes=Db::name('user_coinrecord')
				->where($where2)
				->sum('totalcoin');
			$info['votes']=0;
			if($votes){
				$info['votes']=$votes;
			}
			$nums=zSize('user_'.$stream);			
			hDel("livelist",$uid);
			delcache($uid.'_zombie');
			delcache($uid.'_zombie_uid');
			delcache('attention_'.$uid);
			delcache('user_'.$stream);
			$info['nums']=$nums;			
			$result=Db::name('live_record')->insert($info);	
            
            /* 游戏处理 */
			$game=Db::name('game')
				->where(["stream"=>$stream, "liveuid"=>$uid, "state"=>0])
				->find();
            
			if($game){
				$total=Db::name('gamerecord')
					->field("uid,sum(coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6) as total")
					->where(['gameid'=>$game['id']])
					->group('uid')
					->select()
                    ->toArray();
				foreach($total as $k=>$v){                    
					Db::name('user')->where(['id','=',$v['uid']])->setInc('coin',$v['total']);
                    
					$insert=array("type"=>'1',"action"=>'20',"uid"=>$v['uid'],"touid"=>$v['uid'],"giftid"=>$game['id'],"giftcount"=>1,"totalcoin"=>$v['total'],"addtime"=>$nowtime );
					Db::name('user_coinrecord')->insert($insert);
				}

				Db::name('game')->where(['id' => $game['id']])->update(array('state' =>'3','endtime' => time() ) );
                    
				$brandToken=$stream."_".$game["action"]."_".$game['starttime']."_Game";
				delcache($brandToken);
			}
		}		
		return 0;
	}
    
    
    /* 定时处理关播-允许短时间 断流续推 */
    public function uplive(){
        $notime=time();
        
        $offtime=$notime - 30;
        
        $where=[];
        $where[]=['islive','=','1'];
        $where[]=['isvideo','=','0'];
        $where[]=['isoff','=','1'];
        $where[]=['offtime','<',$offtime];
        $list=Db::name("live")->where($where)->select();
        $list->each(function($v,$k){
            $this->stopRoom('',$v['stream']);
        });
        // file_put_contents(CMF_ROOT.'data/uplive_'.date('Y-m-d').'.txt',date('Y-m-d H:i:s').' 提交参数信息 :'.'OK'."\r\n",FILE_APPEND);
        echo 'OK';
        exit;
    }
    
    protected function curl_get($url){
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 要求结果为字符串且输出到屏幕上
       curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
       curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
       curl_setopt($ch, CURLOPT_TIMEOUT, 15);
       $output = curl_exec($ch);
       curl_close($ch);
       return $output;
	}
	
	/**
	 * {
             "tennis": 3, # 网球
             "cricket": 5, # 板球
             'baseball': 6, # 棒球
             'handball': 7, # 手球
             "ice_hockey": 8, # 冰球
             "volleyball": 10, # 排球
             'table_tennis': 11, # 乒乓球
             "american_football": 17, # 美式橄榄球
             'snooker': 19, # 斯诺克
             'waterpolo': 22, # 水球
             'badminton': 24, # 羽毛球
        }
	 */
	protected function getGameType($sportid){
	    $arr = array(
	            1 => 4,//	足球
	            2 => 2,//	篮球
	            //0 => 7,//	电竞
	            3 => 10,//	网球
	            10 => 9,//	排球
	            24 => 11,//	羽毛球
	            11 => 14,//	乒乓球
	            5 => 16,//	板球
	            //0 => 13,//	搏击
	            //0 => 15,//	其他
	        );
	    if(isset($arr[$sportid])){
	        return $arr[$sportid];
	    }else{
	        return 15;
	    }   
	        
	}
    
    //204 -斯诺克 205-棒球 209-美式足球 211-F1 212-拳击
	protected function getGggameType($sportid){
	    $arr = array(
	            202 => 4,//	足球
	            201 => 2,//	篮球
	            //0 => 7,//	电竞
	            203 => 10,//	网球
	            206 => 9,//	排球
	            207 => 11,//	羽毛球
	            208 => 14,//	乒乓球
	            210 => 16,//	板球
	            212 => 13,//	搏击
	            //0 => 15,//	其他
	        );
	    if(isset($arr[$sportid])){
	        return $arr[$sportid];
	    }else{
	        return 15;
	    }   
	        
	}	
	
	/**
        {
        	"code": 0,
        	"data": [{
        		"sport_id": 10,
        		"match_id": 4785632,
        		"match_time": 1751991300,
        		"match_status": 100,
        		"comp_id": 21371,
        		"comp": "World Championship U19 Women",
        		"home": "Chile U19 Women",
        		"away": "Dominican Republic U19 Women",
        		"pushurl1": "rtmp:\/\/zbpush.rlryn.cn\/live\/sd-QfbbuhRHrqgnKFkJQ9u",
        		"pushurl2": "",
        		"pushurl3": ""
        	}, {
        		"sport_id": 10,
        		
         {
        	"code": 0,
        	"data": [{
        		"sport_id": 106,
        		"comp_id": 104,
        		"match_id": 7710,
        		"match_time": 1751968800,
        		"match_status": 3,
        		"comp": "King Pro League Summer 2025",
        		"home": "郑州MTG",
        		"away": "BOA",
        		"pushurl1": "rtmp:\/\/zbpush.rlryn.cn\/live\/sd-2GjuiADWS13rsFskF",
        		"pushurl2": "",
        		"pushurl3": ""       		
        		
	 */
    public function getNamiStreamData(){
        //获取GGscore的比赛信息
        //$this->getGgscoreMatchData();
        //获取全部流
        $result = $this->curl_get('https://video.open.sportnanoapi.com/pushurl_v4?user=sptlrtuou&secret=f47ee79e5dc85b89940598232ba6b3a8');
        $result = json_decode( $result, true);
        //print_r($result);
        if(isset($result['code']) && $result['code'] == 0){//有数据
            $data =  $result['data'];
            $this->createRoom($data);
        }
        //单独获取电竟流
        $result = $this->curl_get('https://video.open.sportnanoapi.com/esports_pushurl?user=sptlrtuou&secret=f47ee79e5dc85b89940598232ba6b3a8');
        $result = json_decode( $result, true);
        //print_r($result);
        if(isset($result['code']) && $result['code'] == 0){//有数据
            $data =  $result['data'];
            $this->createRoom($data,1);
        }
    }
    
    public function getGgscoreStreamData(){
        //获取GGscore的比赛信息
        //$this->getGgscoreMatchData();
        //获取Ggscore推流
        $result = $this->curl_get('https://b.antdata.cc/sport/api/v1/live/stream?page=1&per_page=1000&token=aExWer4gLvfQJhF4hzMLqT7CCb9bvJ3SQR2UyU3PsbN76eE4SN');
        //echo $result;die;
        $result = json_decode( $result, true);
        //print_r($result);
        if(isset($result['code']) && $result['code'] == 0){//有数据
            $data =  $result['data'];
            $this->createGgroom($data);
        }        
        
    }
    
    
    public function getGgscoreDjMatchData(){//电竟比赛
        $result = $this->curl_get("https://b.antdata.cc/api/v1/match?page=1&per_page=100&token=aExWer4gLvfQJhF4hzMLqT7CCb9bvJ3SQR2UyU3PsbN76eE4SN&status=live");
        $result = json_decode( $result, true);
        //print_r($result);
        if(isset($result['code']) && $result['code'] == 0){//有数据
            if(isset($result['data']['list'])){
                 $data =  $result['data']['list'];
                 foreach($data as $key => $val){
                     $matchid = $val['id'];
                     $match = Db::name('ggscore_match')->where("match_id={$matchid}")->find();
                     if(!$match){
                         $arr = array(
                                'match_id' => $matchid,
                                'sport_id' => $val['game_id'],
                                'start_time' => $val['start_time'],
                                'status' => $val['status'],
                                'team_id' => $val['teams'][0]['team_id'],
                                'team_name' => $val['teams'][0]['team_info']['name'],
                                'team_name_en' => $val['teams'][0]['team_info']['name_en'],
                                'team_logo' => $val['teams'][0]['team_info']['logo'],
                                'away_team_id' => $val['teams'][1]['team_id'],
                                'away_team_name' => $val['teams'][1]['team_info']['name'],
                                'away_team_name_en' => $val['teams'][1]['team_info']['name_en'],
                                'away_team_logo' => $val['teams'][1]['team_info']['logo'], 
                                'league_id' => $val['series']['id'],
                                'league_name' => $val['series']['name'],
                                'league_name_en' => $val['series']['name_en'],
                                'league_logo' => $val['series']['logo'], 
                            );
                         $id = DB::name('ggscore_match')->insertGetId($arr);
                         echo "插入成功,比赛id:{$matchid}";
                     }
 
                    $one = Db::name('live')->where("match_id={$matchid}")->find();
                    $uids = DB::name('live')->where('1=1')->group('uid')->column('uid');
                    $num = count($uids);                   
                    if(!$one && $num < 200 ){
                         $result = $this->curl_get("https://b.antdata.cc/api/v1/match/{$matchid}?page=1&per_page=100&token=aExWer4gLvfQJhF4hzMLqT7CCb9bvJ3SQR2UyU3PsbN76eE4SN");
                         
                         $result = json_decode( $result, true); 
                         if(isset($result['id']) && $result['live_urls']){//有流
                            $live_urls = $result['live_urls'];
                            $sport_id = $val['game_id'];
    
                            foreach($live_urls as $k => $v){
                                $url = explode('?',$v['url']);
                                $urlparse = explode('/',rtrim($url[0],'.m3u8'));
                                $streamid = $urlparse[count($urlparse)-1];
                                
                                $pull = PrivateKeyA('rtmp', $streamid, 0);
                                if($this->getStreamStatus($streamid)){
                                    if($match){
                                        $title = '[GG]'.$match['league_name'].'['.$match['team_name'].' VS '.$match['away_team_name'].']';
                                    }else{
                                        $title = '[GG]'.$arr['league_name'].'['.$arr['team_name'].' VS '.$arr['away_team_name'].']';
                                    }

                                    $dataroom = array(
                                        "uid" => $this->getRandUid(),
                                        "showid" => time(),
                                        "starttime" => time(),
                                        "title" => $title,
                                        "city" => '好像在火星',
                                        "stream" => $streamid,
                                        "thumb" => '',
                                        "pull" => $pull,
                                        "goodnum" => 0,
                                        "isvideo" => 0,
                                        "islive" => 1,
                                        "ishot" => 1,
                                        "liveclassid" => 7,
                                        "hotvotes" => 0,
                                        "pkuid" => 0,
                                        "pkstream" => '',
                                        "banker_coin" => 10000000,
                                        "notice" => '添加下方主播联系方式获取红单',
                                        "match_id" => $matchid
                                    );
                                    
                                    $rs = DB::name('live')->insertGetId($dataroom);
                                    echo "插入成功,流id:{$streamid}\n\n";
                                }                   
    
                            }                                 
                             
                         }                       
                        
                    }
                 }
        
            }
            echo "执行完成";
           

        }            

        
        
    }
    
    
    public function getGgscoreMatchData(){
        $sportids = [201,202,203,204,205,206,207,208,209,210,211,212];
        foreach($sportids as $sportid){
            $result = $this->curl_get("https://b.antdata.cc/sport/api/v1/match?page=1&per_page=100&token=aExWer4gLvfQJhF4hzMLqT7CCb9bvJ3SQR2UyU3PsbN76eE4SN&sport_id={$sportid}&status=live");//&status=live
            $result = json_decode( $result, true);
            //print_r($result);
            if(isset($result['code']) && $result['code'] == 0){//有数据
                if(isset($result['data']['list'])){
                     $data =  $result['data']['list'];
                     foreach($data as $key => $val){
                         $matchid = $val['id'];
                         $one = Db::name('ggscore_match')->where("match_id={$matchid}")->find();
                         if(!$one){
                             $arr = array(
                                    'match_id' => $matchid,
                                    'sport_id' => $val['sport_id'],
                                    'start_time' => $val['start_time'],
                                    'status' => $val['status'],
                                    'team_id' => $val['teams'][0]['team_id'],
                                    'team_name' => $val['teams'][0]['team_info']['name'],
                                    'team_name_en' => $val['teams'][0]['team_info']['name_en'],
                                    'team_logo' => $val['teams'][0]['team_info']['logo'],
                                    'away_team_id' => $val['teams'][1]['team_id'],
                                    'away_team_name' => $val['teams'][1]['team_info']['name'],
                                    'away_team_name_en' => $val['teams'][1]['team_info']['name_en'],
                                    'away_team_logo' => $val['teams'][1]['team_info']['logo'], 
                                    'league_id' => $val['league']['id'],
                                    'league_name' => $val['league']['name'],
                                    'league_name_en' => $val['league']['name_en'],
                                    'league_logo' => $val['league']['logo'], 
                                );
                             $id = DB::name('ggscore_match')->insertGetId($arr);
                             echo "插入成功,比赛id:{$matchid}";
                             
                         }
                         
                     }
            
                }
                echo "执行完成";
               

            }            
        }
        
        
    }
    
    
    protected function createGgroom($data){
        //print_r($data);
        $time = time() - 60;
        foreach($data as $key=>$val){
            $id = $val['id'];
            
            $sport_id = $val['sport_id'];
            $live_urls = $val['live_urls'];
            if($live_urls){//存在流
                foreach($live_urls as $k => $v){
                    $url = explode('?',$v['url']);
                    $urlparse = explode('/',rtrim($url[0],'.m3u8'));
                    $streamid = $urlparse[count($urlparse)-1];

                    $pull = PrivateKeyA('rtmp', $streamid, 0);   
                    
                    $matchid = $id;
                    $one = Db::name('live')->where("match_id={$matchid}")->find();
                    //计算开播数量 目前仅有53个主播
                    $uids = DB::name('live')->where('1=1')->group('uid')->column('uid');
                    $num = count($uids);

                    if(!$one && $num < 200  && $this->getStreamStatus($streamid)){
                        //获取比赛信息
                        $matchinfo = Db::name('ggscore_match')->where("match_id={$matchid}")->find();
                        
                        if($matchinfo){
                            $title = '[GG]'.$matchinfo['league_name_en'].'['.$matchinfo['team_name_en'].' VS '.$matchinfo['away_team_name_en'].']';
                        }else{
                            continue;
                            //$title = $streamid;
                        }
                        
                        $dataroom = array(
                            "uid" => $this->getRandUid(),
                            "showid" => $time,
                            "starttime" => $time,
                            "title" => $title,
                            "city" => '好像在火星',
                            "stream" => $streamid,
                            "thumb" => '',
                            "pull" => $pull,
                            "goodnum" => 0,
                            "isvideo" => 0,
                            "islive" => 1,
                            "ishot" => 1,
                            "liveclassid" => $this->getGggameType($sport_id),
                            "hotvotes" => 0,
                            "pkuid" => 0,
                            "pkstream" => '',
                            "banker_coin" => 10000000,
                            "notice" => '添加下方主播联系方式获取红单',
                            "match_id" => $id
                        );
                        $rs = DB::name('live')->insertGetId($dataroom);
                        echo "插入成功,流id:{$streamid}\n\n";
                    }                   
                }


    
            }
        }       
    }    
    
    protected function createRoom($data,$isdj=0){
        //$status = [4,6,2,52,1,51,7,18,100];
        $time = time() - 60;
         foreach($data as $key=>$val){
            if($val['pushurl1']){//存在流
                 //获取流id
                $pushurlarr = explode('/',$val['pushurl1']);
                $streamid = $pushurlarr[count($pushurlarr) - 1];
                $pull = PrivateKeyA('rtmp', $streamid, 0);   
                
                $matchid = $val['match_id'];
                $one = Db::name('live')->where("match_id={$matchid}")->find();
                //计算开播数量 目前仅有53个主播
                $uids = DB::name('live')->where('1=1')->group('uid')->column('uid');
                $num = count($uids);
                
                if(!$one && $num < 200  && $this->getStreamStatus($streamid)){
                    $dataroom = array(
                        "uid" => $this->getRandUid(),
                        "showid" => $val['match_time'],
                        "starttime" => $val['match_time'],
                        "title" => $val['comp'].'['.$val['home'].' VS '.$val['away'].']',
                        "city" => '好像在火星',
                        "stream" => $streamid,
                        "thumb" => '',
                        "pull" => $pull,
                        "goodnum" => 0,
                        "isvideo" => 0,
                        "islive" => 1,
                        "ishot" => 1,
                        "liveclassid" => $isdj?7:$this->getGameType($val['sport_id']),
                        "hotvotes" => 0,
                        "pkuid" => 0,
                        "pkstream" => '',
                        "banker_coin" => 10000000,
                        "notice" => '添加下方主播联系方式获取红单',
                        "match_id" => $matchid
                    );
                    $rs = DB::name('live')->insertGetId($dataroom);
                    echo "插入成功,流id:{$streamid}\n\n";
                }
            }
        }       
    }
    
	protected function getRandUid(){
	    $arr = [924,923,922,921,920,919,918,917,916,915,914,913,912,911,910,909,908,907,906,905,904,903,902,901,900,899,898,897,896,895,894,893,892,925,926,927,928,929,930,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,975,976,977,978,979,980,981,982,983,984,985,986,987,988,989,990,991,992,993,994,995,996,997,998,999,1000,1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090];
	    $uids = DB::name('live')->where('1=1')->column('uid');
	    $arr = array_diff($arr, $uids);
        $random_key = array_rand($arr);
        return $arr[$random_key];
	        
	}    
    
 
    protected function getStreamStatus($stream){
		try {
			$cred = new Credential('IKIDzr8E9rQlvvmQr7B6pMxCJE1oV0JWWLyO', 'KVfliWLzSilmmr24tVwBGCwXw88xb2HM');
			$httpProfile = new HttpProfile();
			$httpProfile->setEndpoint("live.tencentcloudapi.com");

			$clientProfile = new ClientProfile();
			$clientProfile->setHttpProfile($httpProfile);
			$client = new LiveClient($cred, "", $clientProfile);

			$req = new DescribeLiveStreamStateRequest();

			$params = array(
				"AppName" => 'live',
				"DomainName" => 'zbpush.khpnq.cn',
				"StreamName" => $stream
			);
			$req->fromJsonString(json_encode($params));
			$resp = $client->DescribeLiveStreamState($req);
			$res = json_decode($resp->toJsonString(),true);
			if($res['StreamState']=='inactive'){
                return false;
			}else{
			    return true;   
			}
		}
		catch(TencentCloudSDKException $e) {
    		return false;
		}        
        
    }    


	protected function get3QGameType($sportid){
	    $arr = array(
	            1 => 4,//	足球
	            2 => 2,//	篮球
	        );
	    if(isset($arr[$sportid])){
	        return $arr[$sportid];
	    }else{
	        return 15;
	    }   
	        
	}    
    
    public function get3QStreamData(){
        //获取3Q推流
        $result = $this->curl_get('https://www.sportlive.asia/lives/pushList?auth=68aed0bbfe64b2442ddabc42');
		$result = json_decode( $result, true);

		if(isset($result['errCode']) && $result['errCode'] == 0){//有数据
			if(isset($result['data'])){
				$data =  $result['data'];
				foreach($data as $key => $val){
					$matchid = $val['id'];
					$one = Db::name('ggscore_match')->where("match_id='{$matchid}'")->find();
					if(!$one){
						$arr = array(
								'match_id' => $matchid,
								'sport_id' => $val['type'],//1表⽰⾜球，2表⽰篮球
								'start_time' => $val['date']/1000,
								'status' => isset($val['streamInfo'])?'live':'',
								'team_id' => 0,
								'team_name' => $val['home'],
								'team_name_en' => $val['homeEn'],
								'team_logo' => 'https://admin.gogosports.live/default_thumb.jpg',
								'away_team_id' => 0,
								'away_team_name' => $val['away'],
								'away_team_name_en' => $val['awayEn'],
								'away_team_logo' => 'https://admin.gogosports.live/default_thumb.jpg', 
								'league_id' => 0,
								'league_name' => $val['leagueName'],
								'league_name_en' => $val['leagueNameEn'],
								'league_logo' => 'https://admin.gogosports.live/default_thumb.jpg', 
							);
						$id = DB::name('ggscore_match')->insertGetId($arr);
						echo "插入成功,比赛id:{$matchid}";
						 
					}
					if(!isset($val['streamInfo'])) continue;
					 
					//创建直播间
					$streamid = $val['type'].'-'.$matchid;
					$pull = PrivateKeyA('rtmp', $streamid, 0);   					
					$one = Db::name('live')->where("match_id='{$matchid}'")->find();
					$uids = DB::name('live')->where('1=1')->group('uid')->column('uid');
					$num = count($uids);					
					if(!$one && $num < 200  && $this->getStreamStatus($streamid)){
						$dataroom = array(
							"uid" => $this->getRandUid(),
							"showid" => $val['date']/1000,
							"starttime" => $val['date']/1000,
							"title" => '[3Q]'.$val['leagueName'].'['.$val['home'].' VS '.$val['away'].']',
							"city" => '好像在火星',
							"stream" => $streamid,
							"thumb" => "",//https://slaimg6.oss-ap-southeast-1.aliyuncs.com/sla/{$streamid}.jpg
							"pull" => $pull,
							"goodnum" => 0,
							"isvideo" => 0,
							"islive" => 1,
							"ishot" => 1,
							"liveclassid" => $this->get3QGameType($val['type']),
							"hotvotes" => 0,
							"pkuid" => 0,
							"pkstream" => '',
							"banker_coin" => 10000000,
							"notice" => '添加下方主播联系方式获取红单',
							"match_id" => $matchid
						);
						$rs = DB::name('live')->insertGetId($dataroom);
						echo "插入成功,流id:{$streamid}\n\n";
					}
				}
			}
			echo "执行完成";
		}
    }    
    
    
    public function get3QBQStreamData(){//棒球
        //获取3Q推流
        $result = $this->curl_get('https://env-00jxh1c541d5.dev-hz.cloudbasefunction.cn/lives/pushList_v2?auth=68aed0bbfe64b2442ddabc42');
		$result = json_decode( $result, true);

		if(isset($result['errCode']) && $result['errCode'] == 0){//有数据
			if(isset($result['data'])){
				$data =  $result['data'];
				foreach($data as $key => $val){
					$matchid = $val['id'];
					$one = Db::name('ggscore_match')->where("match_id='{$matchid}'")->find();
					if(!$one){
						$arr = array(
								'match_id' => $matchid,
								'sport_id' => $val['type'],//1表⽰⾜球，2表⽰篮球
								'start_time' => $val['date']/1000,
								'status' => isset($val['streamInfo'])?'live':'',
								'team_id' => 0,
								'team_name' => $val['home'],
								'team_name_en' => $val['home'],
								'team_logo' => 'https://admin.gogosports.live/default_thumb.jpg',
								'away_team_id' => 0,
								'away_team_name' => $val['away'],
								'away_team_name_en' => $val['away'],
								'away_team_logo' => 'https://admin.gogosports.live/default_thumb.jpg', 
								'league_id' => 0,
								'league_name' => $val['leagueName'],
								'league_name_en' => $val['leagueName'],
								'league_logo' => 'https://admin.gogosports.live/default_thumb.jpg', 
							);
						$id = DB::name('ggscore_match')->insertGetId($arr);
						echo "插入成功,比赛id:{$matchid}";
						 
					}
					if(!isset($val['streamInfo'])) continue;
					 
					//创建直播间
					$streamid = $val['type'].'-'.$matchid;
					$pull = PrivateKeyA('rtmp', $streamid, 0);   					
					$one = Db::name('live')->where("match_id='{$matchid}'")->find();
					$uids = DB::name('live')->where('1=1')->group('uid')->column('uid');
					$num = count($uids);					
					if(!$one && $num < 200  && $this->getStreamStatus($streamid)){
						$dataroom = array(
							"uid" => $this->getRandUid(),
							"showid" => $val['date']/1000,
							"starttime" => $val['date']/1000,
							"title" => '[3Q]'.$val['leagueName'].'['.$val['home'].' VS '.$val['away'].']',
							"city" => '好像在火星',
							"stream" => $streamid,
							"thumb" => "",//https://slaimg6.oss-ap-southeast-1.aliyuncs.com/sla/{$streamid}.jpg
							"pull" => $pull,
							"goodnum" => 0,
							"isvideo" => 0,
							"islive" => 1,
							"ishot" => 1,
							"liveclassid" => $this->get3QGameType($val['type']),
							"hotvotes" => 0,
							"pkuid" => 0,
							"pkstream" => '',
							"banker_coin" => 10000000,
							"notice" => '添加下方主播联系方式获取红单',
							"match_id" => $matchid
						);
						$rs = DB::name('live')->insertGetId($dataroom);
						echo "插入成功,流id:{$streamid}\n\n";
					}
				}
			}
			echo "执行完成";
		}
    }      

}