<?php

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class GetNami3DayMatch extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('getNami3DayMatch');
        // 设置参数
        
    }

    protected function execute(Input $input, Output $output)
    {

        $result = $this->curl_get('https://video.open.sportnanoapi.com/pushurl_v4?user=nalsince&secret=85354e61faa389fc488051eb144f4d89');
        $result = json_decode( $result, true);
        //print_r($result);
        if(isset($result['code']) && $result['code'] == 0){//有数据
            $data =  $result['data'];
            $this->insertNami3DayMatch($data);
        }
    }



    protected function insertNami3DayMatch($data){
        $sportDb = config('database.mysql_sport');

        $minUid = 892;
        $maxUid = 1092;
        $lastUserIds =  Db::connect($sportDb)->name('sports_3day_match')->order('id','desc')->limit(1)->value('user_ids');
        if(!$lastUserIds){
            $lastUserIds = $minUid;
        }


        $match_ids = [];

        foreach ($data as $v){
            $in = [
                'sport_id' => $v['sport_id'],
                'match_id' => $v['match_id'],
                'match_time' => $v['match_time'],
                'match_status' => $v['match_status'],
                'comp_id' => $v['comp_id'],
                'comp' => $v['comp'],
                'home' => $v['home'],
                'away' => $v['away'],
                'pushurl1' => $v['pushurl1'],
                'pushurl2' => $v['pushurl2'],
                'pushurl3' => $v['pushurl3'],
            ];

            $one = Db::connect($sportDb)->name('sports_3day_match')->where([
                'sport_id'=>$v['sport_id'],
                'match_id'=>$v['match_id'],
            ])->find();

            if($one){

                $in['updated_at'] = date("Y-m-d H:i:s");
                $res = Db::connect($sportDb)->name('sports_3day_match')->where('id', $one['id'])->update($in);

                if($res){
                    echo "【更新】 72小时内的数据成功, match_id:{$v['match_id']}\n\n";
                }else{
                    echo "【更新】 72小时内的数据失败, match_id:{$v['match_id']}\n\n";
                }
            }else{
                if($lastUserIds == $maxUid){
                    $lastUserIds = $minUid;
                }
                $in['user_ids'] = $lastUserIds;
                $in['created_at'] = date("Y-m-d H:i:s");
                $in['updated_at'] = date("Y-m-d H:i:s");
                $lastUserIds++;
                $res = Db::connect($sportDb)->name('sports_3day_match')->insert($in);

                if($res){
                    echo "【插入】 72小时内的数据成功, match_id:{$v['match_id']}\n\n";
                }else{
                    echo "【插入】 72小时内的数据失败, match_id:{$v['match_id']}\n\n";
                }

            }

            $match_ids[] = $v['match_id'];

        }

        Db::connect($sportDb)->name('sports_3day_match')->whereNotIn('match_id',$match_ids)->delete();

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

}
