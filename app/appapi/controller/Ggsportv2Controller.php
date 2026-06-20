<?php
/**
 * Gogosport视频源接口
 */
namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class Ggsportv2Controller extends HomebaseController {


    public static $selfFootballMap = [
        '0' => '比赛异常',
        '1' => '未开赛',
        '2' => '上半场',
        '3' => '中场',
        '4' => '下半场',
        '5' => '加时赛',
        '6' => '加时赛(弃用)',
        '7' => '点球决战',
        '8' => '完场',
        '9' => '延迟',
        '10' => '中断',
        '11' => '腰斩',
        '12' => '取消',
        '13' => '待定',
    ];


    public static $selfBasketballMap = [
        "0" => "比赛异常",
        "1" => "未开赛",
        "2" => "第一节",
        "3" => "第一节完",
        "4" => "第二节",
        "5" => "第二节完",
        "6" => "第三节",
        "7" => "第三节完",
        "8" => "第四节",
        "9" => "加时",
        "10" => "完场",
        "11" => "中断",
        "12" => "取消",
        "13" => "延期",
        "14" => "腰斩",
        "15" => "待定",
    ];

    function getSportCategory(){
        $data = $this->request->param();
        $app_id=isset($data['app_id']) ? $data['app_id']: '';
        $app_secret=isset($data['app_secret']) ? $data['app_secret']: '';

        $this->secretcheck($app_id,$app_secret);

        $ip = get_client_ip(0,true);//43.135.86.123

        $this->whitelist($ip);

        $list = Db::name('live_class')
            ->field("id,name,des")
            ->select()
            ->toArray();
        echo json_encode(array("status"=>0,'data'=>array("list" => $list),'msg'=>'success'));
        exit;

    }

    function getMatchList(){
        $data = $this->request->param();

        $date = $data['date'] ?? date('Y-m-d');
        $start_time= strtotime($date);
        $end_time= strtotime($date." 23:59:59");

        $sport_id= $data['sport_id'] ?? 1;
        if(!in_array($sport_id, [1,2])){
            echo json_encode(array("status"=>104,'msg'=>'赛事分类不正确'));
            exit;
        }

        $app_id=isset($data['app_id']) ? $data['app_id']: '';
        $app_secret=isset($data['app_secret']) ? $data['app_secret']: '';
        $page=isset($data['page']) ? intval(abs($data['page'])): 1;
        $pagesize=isset($data['pagesize']) ? intval(abs($data['pagesize'])): 100;

        $this->secretcheck($app_id,$app_secret);

        $ip= get_client_ip(0,true);//43.135.86.123
        $this->whitelist($ip);
        if($pagesize > 100){
            echo json_encode(array("status"=>104,'msg'=>'每页最多返回100条记录'));
            exit;
        }

        $start = ($page - 1) * $pagesize;

        $sportDb = config('database.mysql_sport');

        $where = [];
        if($start_time != ""){
            $where[]=['m.match_time','>=',$start_time];
        }

        if($end_time != ""){
            $where[]=['m.match_time','<=',$end_time];
        }

        switch ($sport_id){
            case 1:
                $list = Db::connect($sportDb)->name('sports_football_match')->alias('m')
                    ->field('
                        m.id as match_id, m.match_time as start_time, m.status_id as status, m.competition_id as league_id,  
                        c.name_zh as league_name,c.short_name_en as league_name_en,c.logo as  league_logo,
                        h.id as home_team_id,h.name_zh as home_team_name,h.name_en as home_team_name_en,h.logo as home_team_logo,m.home_scores,
                        a.id as away_team_id,a.name_zh as away_team_name,a.name_en as away_team_name_en,a.logo as away_team_logo,m.away_scores
                    ')
                    ->leftJoin('sports_football_competition c','m.competition_id=c.id')
                    ->leftJoin('sports_football_team h','m.home_team_id=h.id')
                    ->leftJoin('sports_football_team a','m.away_team_id=a.id')
                    ->where($where)
                    ->order('m.match_time asc')
                    ->paginate($pagesize);

                    foreach($list as $key => &$val){
                        $val['status_text'] = self::$selfFootballMap[$val['status']];
                    }

                break;
            case 2:
                $list = Db::connect($sportDb)->name('sports_basketball_match')->alias('m')
                    ->field('
                        m.id as match_id, m.match_time as start_time, m.status_id as status, m.competition_id as league_id,  
                        c.name_zh as league_name,c.short_name_en as league_name_en,c.logo as  league_logo,
                        h.id as home_team_id,h.name_zh as home_team_name,h.name_en as home_team_name_en,h.logo as home_team_logo,m.home_scores,
                        a.id as away_team_id,a.name_zh as away_team_name,a.name_en as away_team_name_en,a.logo as away_team_logo,m.away_scores
                    ')
                    ->leftJoin('sports_basketball_competition c','m.competition_id=c.id')
                    ->leftJoin('sports_basketball_team h','m.home_team_id=h.id')
                    ->leftJoin('sports_basketball_team a','m.away_team_id=a.id')
                    ->where($where)
                    ->order('m.match_time asc')
                    ->paginate($pagesize);


                foreach($list as $key => &$val){
                    $val['status_text'] = self::$selfBasketballMap[$val['status']];
                }

                break;
            default:
                echo json_encode(array("status"=>104,'msg'=>'赛事分类不正确'));
                exit;
                break;
        }

        echo json_encode(array("status"=>0,'data'=>array("list" => $list),'msg'=>'success'));
        exit;

    }


    function list(){
        $data = $this->request->param();
        $app_id=isset($data['app_id']) ? $data['app_id']: '';
        $app_secret=isset($data['app_secret']) ? $data['app_secret']: '';

        $sport_id= $data['sport_id'] ?? 1;
        if(!in_array($sport_id, [1,2])){
            echo json_encode(array("status"=>104,'msg'=>'赛事分类不正确'));
            exit;
        }


        $this->secretcheck($app_id,$app_secret);

        $ip= get_client_ip(0,true);//43.135.86.123

        $this->whitelist($ip);

        $rkey= 'ROR_'.ip2long(get_client_ip(0,true));
        $ror = cache($rkey)??0;
        if(time() - $ror < 60){
            echo json_encode(array("status"=>105,'msg'=>'接口请求频率太高'));
            exit;
        }
        $sportDb = config('database.mysql_sport');

        $where = [];
        $where[]=['m.sport_id','=',$sport_id];
        $where[]=['m.pushurl1','<>',''];

        switch ($sport_id){
            case 1:
                $list = Db::connect($sportDb)->name('sports_3day_match')->alias('m')
                    ->field('
                        m.id, m.sport_id, m.match_id, m.match_time as start_time, m.match_status as status, m.pushurl1, m.pushurl2, m.pushurl3,
                        m.comp_id as league_id, c.name_zh as league_name,c.short_name_en as league_name_en,c.logo as  league_logo,
                        h.id as home_team_id,m.home as home_team_name,h.name_en as home_team_name_en,h.logo as home_team_logo,
                        a.id as away_team_id,m.away as away_team_name,a.name_en as away_team_name_en,a.logo as away_team_logo
                    ')
                    ->leftJoin('sports_football_competition c','m.comp_id=c.id')
                    ->leftJoin('sports_football_team h','m.home=h.name_zh')
                    ->leftJoin('sports_football_team a','m.away=a.name_zh')
                    ->where($where)
                    ->order('m.match_time asc')
                    ->select();
                break;
            case 2:
                $list = Db::connect($sportDb)->name('sports_3day_match')->alias('m')
                    ->field('
                        m.id, m.sport_id, m.match_id, m.match_time as start_time, m.match_status as status, m.pushurl1, m.pushurl2, m.pushurl3,
                        m.comp_id as league_id, c.name_zh as league_name,c.short_name_en as league_name_en,c.logo as  league_logo,
                        h.id as home_team_id,m.home as home_team_name,h.name_en as home_team_name_en,h.logo as home_team_logo,
                        a.id as away_team_id,m.away as away_team_name,a.name_en as away_team_name_en,a.logo as away_team_logo
                    ')
                    ->leftJoin('sports_basketball_competition c','m.comp_id=c.id')
                    ->leftJoin('sports_basketball_team h','m.home=h.name_zh')
                    ->leftJoin('sports_basketball_team a','m.away=a.name_zh')
                    ->where($where)
                    ->order('m.match_time asc')
                    ->select();
                break;
            default:
                echo json_encode(array("status"=>104,'msg'=>'赛事分类不正确'));
                exit;
                break;
        }
        //die(Db::name("live e")->getlastsql());
        //gogozbpull.frgat.cn  key:7Nj6dK7kdPyQSrPdAPT6
        foreach($list as $key => &$val){
            $stream1 = basename(parse_url($val['pushurl1'], PHP_URL_PATH));
            $stream2 = basename(parse_url($val['pushurl2'], PHP_URL_PATH));
            $stream3 = basename(parse_url($val['pushurl3'], PHP_URL_PATH));
            if($stream1){
                $val["flv1"] = PrivateKey_tx_cs($stream1.".flv", 0,"https://gogozbpull.hbavnna.cn","7Nj6dK7kdPyQSrPdAPT6");
                $val["m3u8_1"] = PrivateKey_tx_cs($stream1.".m3u8", 0,"https://gogozbpull.hbavnna.cn","7Nj6dK7kdPyQSrPdAPT6");
            }else{
                $val["flv1"] = "";
                $val["m3u8_1"] = "";
            }

            if($stream2){
                $val["flv2"] = PrivateKey_tx_cs($stream2.".flv", 0,"https://gogozbpull.hbavnna.cn","7Nj6dK7kdPyQSrPdAPT6");
                $val["m3u8_2"] = PrivateKey_tx_cs($stream2.".m3u8", 0,"https://gogozbpull.hbavnna.cn","7Nj6dK7kdPyQSrPdAPT6");
            }else{
                $val["flv2"] = "";
                $val["m3u8_2"] = "";
            }

            if($stream3){
                $val["flv3"] = PrivateKey_tx_cs($stream3.".flv", 0,"https://gogozbpull.hbavnna.cn","7Nj6dK7kdPyQSrPdAPT6");
                $val["m3u8_3"] = PrivateKey_tx_cs($stream3.".m3u8", 0,"https://gogozbpull.hbavnna.cn","7Nj6dK7kdPyQSrPdAPT6");
            }else{
                $val["flv3"] = "";
                $val["m3u8_3"] = "";
            }

            $val["title_cn"] = "[{$val['league_name']}] ".$val["home_team_name"]." VS ".$val["away_team_name"];
            $val["title_en"] = "[{$val['league_name_en']}] ".$val["home_team_name_en"]." VS ".$val["away_team_name_en"];

            $val['status_text'] = '';
            if($sport_id == 1){
                $val['status_text'] = self::$selfFootballMap[$val['status']];
            }else if($sport_id == 2){
                $val['status_text'] = self::$selfBasketballMap[$val['status']];
            }


        }
        cache($rkey,time());
        echo json_encode(array("status"=>0,"data"=>array("list" => $list),"msg"=>"success"));
        exit;

    }

    private function whitelist($ip){
        $iplist = ['43.135.86.123','35.189.175.8','43.155.26.79','119.28.49.238','101.32.214.215','172.216.19.9','159.65.143.78','172.18.0.1'];
        if(!in_array($ip,$iplist)){
            echo json_encode(array("status"=>103,'msg'=> $ip.'IP受限，请添加白名单'));
            exit;
        }
    }

    private function secretcheck($app_id,$app_secret){
        $ids = ['no3qm09xc1i3b1m4','iWijXbm39Zqx9yiV'];
        if(!in_array($app_id,$ids)){
            echo json_encode(array("status"=>101,'msg'=>'缺少app_id或者app_id不对！'));
            exit;
        }
        $secrets = ['de2316eb58434561a450ab2e915e4e17','8FmWxZ9k7qP2vB4nL1tYc6sJ5uD3hG9A'];
        if(!in_array($app_secret,$secrets)){
            echo json_encode(array("status"=>102,'msg'=>'缺少app_secret或者app_secret不对！'));
            exit;
        }
    }


}