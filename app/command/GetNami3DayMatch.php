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

        $result = $this->curl_get('https://video.open.sportnanoapi.com/pushurl_v4?user=whftlx&secret=f40e481a8ca6d088b316d2a2986163ea');
        $result = json_decode( $result, true);
        // $output->writeln("拉取纳米数据：".json_encode($result,256));
        if(isset($result['code']) && $result['code'] == 0){//有数据
            $data =  $result['data'];
            $this->insertNami3DayMatch($data);
        }
    }



    protected function insertNami3DayMatch($data){
        $sportDb = config('database.mysql_sport');
        $match_ids = [];
        $anchorInsert = [];
        foreach ($data as $v){

            if(!in_array($v['sport_id'],[1,2])){
                continue;
            }


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
                $in['created_at'] = date("Y-m-d H:i:s");
                $in['updated_at'] = date("Y-m-d H:i:s");
                $res = Db::connect($sportDb)->name('sports_3day_match')->insert($in);



                if($res){
                    echo "【插入】 72小时内的数据成功, match_id:{$v['match_id']}\n\n";
                }else{
                    echo "【插入】 72小时内的数据失败, match_id:{$v['match_id']}\n\n";
                }

                $anchorInsert[] = [
                    'sport_id' => $v['sport_id'],
                    'match_id' => $v['match_id'],
                    'is_hot' => 0,
                    'user_ids' => '',
                ];



            }


            $match_ids[] = $v['match_id'];

        }

        Db::connect($sportDb)->name('sports_3day_match')->whereNotIn('match_id',$match_ids)->delete();

        Db::connect($sportDb)->name('sports_3day_match_anchor_vn')->whereNotIn('match_id',$match_ids)->delete();


        if($anchorInsert){
            $this->insertAnchor($anchorInsert);
        }


//        $this->setAnchor();


    }


    protected function  insertAnchor($anchorInsert)
    {
        $sportDb = config('database.mysql_sport');

        $res1 = Db::connect($sportDb)->name('sports_3day_match_anchor_vn')->insertAll($anchorInsert);
        if($res1){
            echo "【插入 vn】 anchorInsert 数据成功\n\n";
        }else{
            echo "【插入 vn】 anchorInsert 数据失败\n\n";
        }
        $res2 = Db::connect($sportDb)->name('sports_3day_match_anchor_huas')->insertAll($anchorInsert);
        if($res2){
            echo "【插入 huas】 anchorInsert 数据成功\n\n";
        }else{
            echo "【插入 huas】 anchorInsert 数据失败\n\n";
        }
    }




    protected function setAnchor(){
        $sportDb = config('database.mysql_sport');

        $minUid = 892;
        $maxUid = 1092;
        $lastUserIds =  Db::connect($sportDb)->name('sports_3day_match')->order(['match_time'=>'desc','id'=>'desc'])->limit(1)->value('user_ids');
        if(!$lastUserIds){
            $lastUserIds = $minUid;
        }

        $data = Db::connect($sportDb)->name('sports_3day_match')->where('user_ids = ""')->order(['match_time'=>'asc','id'=>'asc'])->select();
        foreach ($data as $v){
            if($lastUserIds > $maxUid){
                $lastUserIds = $minUid;
            }
            $in['user_ids'] = $lastUserIds;
            $in['updated_at'] = date("Y-m-d H:i:s");
            $res = Db::connect($sportDb)->name('sports_3day_match')->where('id', $v['id'])->update($in);

            if($res){
                echo "【更新】 72小时内的数据成功, match_id:{$v['match_id']}\n\n";
            }else{
                echo "【更新】 72小时内的数据失败, match_id:{$v['match_id']}\n\n";
            }

            $lastUserIds++;

        }


    }






    protected function curl_get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
