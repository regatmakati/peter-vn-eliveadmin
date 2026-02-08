<?php
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class MatchController extends AdminbaseController {

    public static $selfFootballMap = [
        "10"=>"上半场",
        "20"=>"中场",
        "30"=>"下半场",
        "40"=>"加时",
        "50"=>"点球",
        "60"=>"未开赛",
        "70"=>"待定",
        "80"=>"推迟",
        "90"=>"中断",
        "100"=>"腰斩",
        "110"=>"取消",
        "120"=>"完场",
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
    public function basketballList(){

        $data = $this->request->param();
        $where=[];

        $state = isset($data['state']) ? $data['state']: '';
        if($state!=''){
            $where[] = ['m.state','=',$state];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['t_a.nameCn|t_b.nameCn','like',"%$t_name%"];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['e.leagueNameCnShort','like',"%$ename%"];
        }

        $lists = Db::name('sports_basketball_match')
            ->alias('m')
            ->join('sports_basketball_league e','m.leagueId=e.leagueId')
            ->join('sports_basketball_team t_a','m.homeId=t_a.teamId')
            ->join('sports_basketball_team t_b','m.awayId=t_b.teamId')
            ->field("m.leagueId,m.matchId as match_id,m.state as status,m.matchStartTime,m.matchId,m.homeId,m.live_url,m.awayId,t_a.nameCn as ta_name,t_b.nameCn as tb_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.leagueNameCnShort as ename")
            ->where($where)
            ->order('matchStartTime', 'DESC')
            ->paginate(20);
        $lists->appends($data);
        $page = $lists->render();
        $lists = $lists->toArray();
        foreach ($lists['data'] as $key=>$value){
            $lists['data'][$key]['status'] = self::$selfMap[$value['status']];
        }
        $this->assign('states',self::$selfMap);

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
            $where[] = ['m.state','=',$state];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['t_a.nameCn|t_b.nameCn','like',"%$t_name%"];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['e.leagueNameCnShort','like',"%$ename%"];
        }

        $lists = Db::name('sports_football_match')
            ->alias('m')
            ->join('sports_football_league e','m.leagueId=e.leagueId')
            ->join('sports_football_team t_a','m.homeId=t_a.teamId')
            ->join('sports_football_team t_b','m.awayId=t_b.teamId')
            ->field("m.leagueId,m.matchId as match_id,m.state as status,m.matchStartTime,m.matchId,m.homeId,m.live_url,m.awayId,t_a.nameCn as ta_name,t_b.nameCn as tb_name,t_a.logo as ta_logo,t_b.logo as tb_logo,e.leagueNameCnShort as ename")
            ->where($where)
            ->order('matchStartTime', 'DESC')
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
}