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
		$data = json_decode(Post('','https://admin.gogosports.live/appapi/ggsport/list?app_id=no3qm09xc1i3b1m4&app_secret=de2316eb58434561a450ab2e915e4e17'),true);
		if(isset($data['status']) && $data['status'] == '0'){
			$list = $data['data']['list'];
			if($list){
				foreach($list as $key => $val){
					$match_id = $val['match_id'];
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
					
					print_r($val);
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

}