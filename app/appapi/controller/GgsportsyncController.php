<?php
/**
 * Gogosport视频源接口
 */
namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class GgsportsyncController extends HomebaseController {	

	function sync(){
		$time = time() + 4 * 3600;
		$data = json_decode(Post('','https://admin.gogosports.live/appapi/ggsport/list?app_id=no3qm09xc1i3b1m4&app_secret=de2316eb58434561a450ab2e915e4e17&lang=en'),true);
		if(isset($data['status']) && $data['status'] == '0'){
			$list = $data['data']['list'];
			if($list){
                $sportDb = config('database.mysql_sport');

				foreach($list as $key => $val){
					// $one = Db::name('varchar_match')->where("match_id='$match_id'")->find();
					// if(!$one){
						// $arr = array(
							// 'type' => $val['liveclassid'],
							// 'name' => $val['title'],
							// 'thumb' => $val['cover'],
							// 'home_team' => $val['team_name'],
							// 'home_icon' => $val['team_logo'],
							// 'away_team' => $val['away_team_name'],
							// 'away_icon' => $val['away_team_logo'],
							// 'start_time' => $val['start_time']??$val['starttime'],
							// 'end_time' => $time,
							// 'view_url' => $val['flv']
						// );
						// Db::name('varchar_match')->insert($arr);	
					// }else{
						// Db::name('varchar_match')->where("match_id='$match_id'")->update(['end_time' => $time]);
					// }


//                    $match_id = $val['match_id'];
//                    switch ($val['liveclassid']){
//                        case 2:  // 篮球
//                            $user_id = Db::connect($sportDb)->name('sports_3day_match')->where('match_id', $match_id)->where('sport_id', 2)->value('user_ids');
//                            break;
//                        case 4:  // 足球
//                            $user_id = Db::connect($sportDb)->name('sports_3day_match')->where('match_id', $match_id)->where('sport_id', 1)->value('user_ids');
//                            break;
//                        default:
//                            $user_id = 0;
//                            break;
//
//                    }
//
//                    if(!$user_id){
//                        continue;
//                    }
//                    $val['room_id'] = $user_id;
					//加入无人值守直播间
					$one = Db::name('live')->where("uid = '{$val['room_id']}'")->find();
					$dataroom = array(
						"uid" => $val['room_id'],
						"showid" => $time,
						"starttime" => $val['start_time']??$val['starttime'],
						"title" => $val['title'],
						"city" => '好像在火星',
						"stream" => $val['stream'],
						"pic_full_url" => $val['cover'],
						"pull" => $val['flv'],
						"goodnum" => 0,
						"isvideo" => 1,
						"islive" => 1,
						"ishot" => 1,
						"liveclassid" => $val['liveclassid'],
						"hotvotes" => 0,
						"pkuid" => 0,
						"pkstream" => '',
						"banker_coin" => 10000000,
						"notice" => '添加下方主播联系方式获取红单',
						"match_id" => $match_id
					);
					if($one){
						DB::name('live')->where("uid = '{$val['room_id']}'")->update($dataroom);
					}else{
						DB::name('live')->insertGetId($dataroom);
					}
										
				}
				//Db::name('varchar_match')->where("end_time != '$time'")->delete();
				Db::name('live')->where("showid != '$time' and isvideo=1")->delete();
				
				
				
			}
			
		}
		
		exit('同步完成');
		
	}


    function syncMatch(){

        $lastMatch = Db::name('ggscore_match')->field('id')->order('id desc')->find();
        $lastMatchId = $lastMatch['id'];
        echo  "当前比赛ID: {$lastMatchId}\n";

        $sportDb = config('database.gogo_live');
        $newMatch = Db::connect($sportDb)->name('ggscore_match')->field('id')->order('id desc')->find();
        $newMatchId = $newMatch['id'];
        echo  "最新比赛ID: {$newMatchId}\n";
        $num = $newMatchId-$lastMatchId;

        echo  "有 {$num} 条比赛数据需要同步\n";

        if($num>0){
            $list = Db::connect($sportDb)->name('ggscore_match')->where('id','between',[$lastMatchId+1, $newMatchId])->order('id asc')->select();
            $data = [];
            foreach ($list as $k => $v){
                $inert = [];
                $inert['id'] = $v['id'];
                $inert['match_id'] = $v['match_id'];
                $inert['sport_id'] = $v['sport_id'];
                $inert['start_time'] = $v['start_time'];
                $inert['status'] = $v['status'];
                $inert['has_push'] = $v['has_push'];
                $inert['team_id'] = $v['team_id'];
                $inert['team_name'] = $v['team_name'];
                $inert['team_name_en'] = $v['team_name_en'];
                $inert['team_logo'] = $v['team_logo'];
                $inert['away_team_id'] = $v['away_team_id'];
                $inert['away_team_name'] = $v['away_team_name'];
                $inert['away_team_name_en'] = $v['away_team_name_en'];
                $inert['away_team_logo'] = $v['away_team_logo'];
                $inert['league_id'] = $v['league_id'];
                $inert['league_name'] = $v['league_name'];
                $inert['league_name_en'] = $v['league_name_en'];
                $inert['league_logo'] = $v['league_logo'];
                $inert['is_hot'] = $v['is_hot'];
                $data[] = $inert;
            }

            Db::name('ggscore_match')->insertAll($data);
        }

        exit('同步完成');

    }

}