<?php

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class DeleteNami3DayMatch extends Command
{
    protected function configure()
    {
        // 指令配置 每5分钟删除 昨天已经完结的比赛
        $this->setName('deleteNami3DayMatch');
        // 设置参数
        
    }

    protected function execute(Input $input, Output $output)
    {
        $this->deleteFootballMatch();
        $this->deleteBasketballMatch();

    }



    protected function deleteFootballMatch(){
        $sportDb = config('database.mysql_sport');

        $nowDate = strtotime(date("Y-m-d"));

        $res =  Db::connect($sportDb)->name('sports_3day_match')
            ->whereIn('match_status',[0,8,12])
            ->where('sport_id',1)
            ->where("match_time < {$nowDate}")
            ->delete;
        echo "删除昨天已经结束的足球比赛成功\n\n";

    }


    protected function deleteBasketballMatch(){
        $sportDb = config('database.mysql_sport');

        $nowDate = strtotime(date("Y-m-d"));

        $res =  Db::connect($sportDb)->name('sports_3day_match')
            ->whereIn('match_status',[0,10,12])
            ->where('sport_id',2)
            ->where("match_time < {$nowDate}")
            ->delete;
        echo "删除昨天已经结束的篮球比赛成功\n\n";

    }

}
