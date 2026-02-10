<?php
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class MatchController extends AdminbaseController {

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


    public static $selfMap = [
        "0"=>"未开赛",
        "10"=>"第一节",
        "20"=>"第一节完",
        "30"=>"第二节",
        "40"=>"第二节完",
        "50"=>"第三节",
        "60"=>"第三节完",
        "70"=>"第四节",
        "80"=>"加时",
        "90"=>"未开赛",
        "100"=>"待定",
        "110"=>"延期",
        "120"=>"中断",
        "130"=>"腰斩",
        "140"=>"取消",
        "150"=>"完场",
    ];




    //蓝球比赛列表
//    public function basketballList(){
//
//        $data = $this->request->param();
//        $where=[];
//
//        $state = isset($data['state']) ? $data['state']: '';
//        if($state!=''){
//            $where[] = ['m.state','=',$state];
//        }
//
//        $t_name = isset($data['t_name']) ? $data['t_name']: '';
//        if($t_name!=''){
//            $where[] = ['t_a.nameCn|t_b.nameCn','like',"%$t_name%"];
//        }
//
//        $ename = isset($data['ename']) ? $data['ename']: '';
//        if($ename!=''){
//            $where[] = ['e.leagueNameCnShort','like',"%$ename%"];
//        }
//
//        $lists = Db::name('sports_basketball_match')
//            ->alias('m')
//            ->join('sports_basketball_league e','m.leagueId=e.leagueId')
//            ->join('sports_basketball_team t_a','m.homeId=t_a.teamId')
//            ->join('sports_basketball_team t_b','m.awayId=t_b.teamId')
//            ->field("m.leagueId,m.matchId as match_id,m.state as status,m.matchStartTime,m.matchId,m.homeId,m.live_url,m.awayId,t_a.nameCn as ta_name,t_b.nameCn as tb_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.leagueNameCnShort as ename")
//            ->where($where)
//            ->order('matchStartTime', 'DESC')
//            ->paginate(20);
//        $lists->appends($data);
//        $page = $lists->render();
//        $lists = $lists->toArray();
//        foreach ($lists['data'] as $key=>$value){
//            $lists['data'][$key]['status'] = self::$selfMap[$value['status']];
//        }
//        $this->assign('states',self::$selfMap);
//
//        $this->assign('lists', $lists['data']);
//        $this->assign("page", $page);
//        return $this->fetch();
//    }


    public function basketballList(){

        $data = $this->request->param();
        $where=[];

        $state = isset($data['state']) ? $data['state']: '';
        if($state!=''){
            $where[] = ['m.status_id','=',$state];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['t_a.name_zh|t_b.name_zh','like',"%$t_name%"];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['e.name_zh','like',"%$ename%"];
        }


        $is_hot = isset($data['is_hot']) ? $data['is_hot']: '';
        if($is_hot!==''){
            if($is_hot == '-1'){
                $is_hot = 0;
            }
            $where[] = ['m.is_hot','=',$is_hot];
        }

        $start_time=isset($data['start_time']) ? $data['start_time']: '';
        $end_time=isset($data['end_time']) ? $data['end_time']: '';

        if($start_time!=""){
            $where[]=['m.match_time','>=',strtotime($start_time)];
        }

        if($end_time!=""){
            $where[]=['m.match_time','<=',strtotime($end_time) + 60*60*24];
        }



        $sportDb = config('database.mysql_sport');
        $lists = Db::connect($sportDb)->name('sports_basketball_match')
            ->alias('m')
            ->join('sports_basketball_competition e','m.competition_id=e.id')
            ->join('sports_basketball_team t_a','m.home_team_id=t_a.id')
            ->join('sports_basketball_team t_b','m.away_team_id=t_b.id')
            ->field("m.competition_id,m.id as match_id,m.status_id as status,m.match_time,m.home_team_id as homeId,m.away_team_id as awayId,t_a.name_zh as ta_name,t_b.name_zh as tb_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.name_zh as cname,e.name_zh as ename, m.is_hot")
            ->where($where)
            ->order('match_time', 'DESC')
            ->paginate(20);

        $lists->appends($data);
        $page = $lists->render();
        $lists = $lists->toArray();
        foreach ($lists['data'] as $key=>$value){
            $lists['data'][$key]['status'] = self::$selfFootballMap[$value['status']];
        }
        $this->assign('states',self::$selfFootballMap);
        $this->assign('lists', $lists['data']);
        $this->assign("page", $page);
        return $this->fetch();
    }

    //足球比赛列表
    public function footballList(){

        $data = $this->request->param();
        $where=[];

        $state = isset($data['state']) ? $data['state']: '';
        if($state!=''){
            $where[] = ['m.status_id','=',$state];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['t_a.name_zh|t_b.name_zh','like',"%$t_name%"];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['e.name_zh','like',"%$ename%"];
        }


        $is_hot = isset($data['is_hot']) ? $data['is_hot']: '';
        if($is_hot!==''){
            if($is_hot == '-1'){
                $is_hot = 0;
            }
            $where[] = ['m.is_hot','=',$is_hot];
        }


        $start_time=isset($data['start_time']) ? $data['start_time']: '';
        $end_time=isset($data['end_time']) ? $data['end_time']: '';

        if($start_time!=""){
            $where[]=['m.match_time','>=',strtotime($start_time)];
        }

        if($end_time!=""){
            $where[]=['m.match_time','<=',strtotime($end_time) + 60*60*24];
        }


        $sportDb = config('database.mysql_sport');
        $lists = Db::connect($sportDb)->name('sports_football_match')
            ->alias('m')
            ->join('sports_football_competition e','m.competition_id=e.id')
            ->join('sports_football_team t_a','m.home_team_id=t_a.id')
            ->join('sports_football_team t_b','m.away_team_id=t_b.id')
            ->field("m.competition_id,m.id as match_id,m.status_id as status,m.match_time,m.home_team_id as homeId,m.away_team_id as awayId,t_a.name_zh as ta_name,t_b.name_zh as tb_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.name_zh as cname,e.name_zh as ename, m.is_hot")
            ->where($where)
            ->order('match_time', 'DESC')
            ->paginate(20);

        $lists->appends($data);
        $page = $lists->render();
        $lists = $lists->toArray();
        foreach ($lists['data'] as $key=>$value){
            $lists['data'][$key]['status'] = self::$selfFootballMap[$value['status']];
        }
        $this->assign('states',self::$selfFootballMap);
        $this->assign('lists', $lists['data']);
        $this->assign("page", $page);
        return $this->fetch();
    }

    //英雄联盟比赛列表
    public function lolList(){

        $data = $this->request->param();
        $where=[];

        $status = isset($data['status']) ? $data['status']: '';
        if($status!=''){
            $where[] = ['m.status','=',$status];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['t_a.name|t_b.name','like',"%$t_name%"];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['e.name','like',"%$ename%"];
        }

        $lists = Db::name('lol_match')
            ->alias('m')
            ->join('lol_league e','m.league_id=e.league_id')
            ->join('lol_team t_a','m.team_a_id=t_a.team_id')
            ->join('lol_team t_b','m.team_b_id=t_b.team_id')
            ->field("m.league_id,m.status,m.addtime,m.match_id,m.team_a_id,m.team_b_id,t_a.name as ta_name,t_b.name tb_name,t_a.short_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.name as ename,e.start_time,e.end_time")
            ->where($where)
            ->order('addtime', 'DESC')
            ->paginate(20);

        $lists->appends($data);
        $page = $lists->render();
        $this->assign('lists', $lists);
        $this->assign("page", $page);
        return $this->fetch();
    }

    //CS比赛列表
    public function csList(){

        $data = $this->request->param();
        $where=[];

        $status = isset($data['status']) ? $data['status']: '';
        if($status!=''){
            $where[] = ['m.status','=',$status];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['t_a.name|t_b.name','like',"%$t_name%"];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['e.name','like',"%$ename%"];
        }

        $lists = Db::name('csgo_match')
            ->alias('m')
            ->join('csgo_league e','m.league_id=e.league_id')
            ->join('csgo_team t_a','m.team_a_id=t_a.team_id')
            ->join('csgo_team t_b','m.team_b_id=t_b.team_id')
            ->field("m.league_id,m.status,m.addtime,m.match_id,m.team_a_id,m.team_b_id,t_a.name as ta_name,t_b.name tb_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.name as ename,e.start_time,e.end_time")
            ->where($where)
            ->order('addtime', 'DESC')
            ->paginate(20);

        $lists->appends($data);
        $page = $lists->render();
        $this->assign('lists', $lists);
        $this->assign("page", $page);
        return $this->fetch();
    }

    //直播链接
    public function liveUrl(){

        $data = $this->request->param();
        $match_id = isset($data['match_id']) ? $data['match_id']: '';
        if($match_id==''){
            return false;
        }
        $table = isset($data['tb']) ? $data['tb']: '';
        if($table==''){
            $table = 'lol_match_live';
        }

        $lists = Db::name($table)->field('name,url')->where(array('match_id'=>$match_id))->order('addtime desc')->select();
        $this->assign('lists', $lists);
        return $this->fetch();
    }


    public function liveUrls(){
        $data = $this->request->param();
        $match_id = isset($data['match_id']) ? $data['match_id']: '';
        if($match_id==''){
            return false;
        }
        $table = isset($data['tb']) ? $data['tb']: '';
        if($table==''){
            $table = 'lol_match_live';
        }
        $live_url = Db::name($table)->field('live_url')->where(array('matchId'=>$match_id))->value('live_url');
        if(!empty($live_url)){
            $live_url = json_decode($live_url,true);
            foreach ($live_url as $key=>$value){
                $prefix = "http://gameplay.hruui.com";
                $suffix = ".flv";
                $live_url[$key] = $prefix.$value.$suffix;
            }
        }
        $this->assign('lists', $live_url);
        return $this->fetch();
    }




    public function changeHot()
    {

        $id     = $this->request->param('id', 0, 'intval');
        $isHot  = $this->request->param('is_hot', 0, 'intval');
        $table  = $this->request->param('table', '');

        if (!$id) $this->error('参数错误');

        $sportDb = config('database.mysql_sport');
        $res = Db::connect($sportDb)->name($table)->where('id', $id)->update(['is_hot' => $isHot]);

        if ($res) {
            $this->success('修改成功');
        } else {
            $this->error('修改失败');
        }
    }

}