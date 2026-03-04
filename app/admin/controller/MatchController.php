<?php
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class MatchController extends AdminbaseController {

    public static $selfStatusMap = [
        'upcoming' => '未开赛',
        'live' => '进行中',
        'past' => '已结束',
        'cancel' => '已取消',
        'delayed' => '延迟',
        'delete' => '已删除',
        'pending' => '待定',
        'abandoned' => '腰斩',
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


    public function footballList(){

        $data = $this->request->param();
        $where=[];


        $where[] = ['m.sport_id','=',202];

        $state = isset($data['state']) ? $data['state']: '';
        if($state!=''){
            $where[] = ['m.status','=',$state];
        }

        $match_id = isset($data['match_id']) ? $data['match_id']: '';
        if($match_id !=''){
            $where[] = ['m.match_id','=',$match_id];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['m.league_name','like',"%$ename%"];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['m.team_name|m.away_team_name','like',"%$t_name%"];
        }


        $is_hot = isset($data['is_hot']) ? $data['is_hot']: '';
        if($is_hot!==''){
            if($is_hot == '-1'){
                $is_hot = 0;
            }
            $where[] = ['m.is_hot','=',$is_hot];
        }

        // 今天
        $today = date('Y-m-d');
        // 10天后
        $tenDaysLater = date('Y-m-d', strtotime('+10 days'));

        $start_time = $data['start_time'] ?? '';
        $end_time = $data['end_time'] ?? '';

        if(empty($start_time)){
            $start_time = $today;
        }
        if(empty($end_time)){
            $end_time = $tenDaysLater;
        }

        $where[]=['m.start_time','>=',strtotime($start_time)];
        $where[]=['m.start_time','<=',strtotime($end_time) + 60*60*24 - 1];


        $lists = Db::name('ggscore_match')
            ->alias('m')
            ->join('ggscore_league l','l.league_id=m.league_id and l.has_live=1')
            ->join('ggscore_match_anchor a','m.match_id=a.match_id','left')
            ->field("m.*,a.user_ids")
            ->where($where)
            ->order('start_time', 'ASC')
            ->paginate(20);

        $lists->appends($data);
        $page = $lists->render();
        $lists = $lists->toArray();
        foreach ($lists['data'] as $key=>$value){
            $lists['data'][$key]['status'] = self::$selfStatusMap[$value['status']];
        }
        $this->assign('states',self::$selfStatusMap);
        $this->assign('lists', $lists['data']);
        $this->assign("page", $page);
        return $this->fetch();
    }

    //足球比赛列表
    public function basketballList(){

        $data = $this->request->param();
        $where=[];

        $where[] = ['m.sport_id','=',201];

        $state = isset($data['state']) ? $data['state']: '';
        if($state!=''){
            $where[] = ['m.status','=',$state];
        }

        $match_id = isset($data['match_id']) ? $data['match_id']: '';
        if($match_id !=''){
            $where[] = ['m.match_id','=',$match_id];
        }

        $ename = isset($data['ename']) ? $data['ename']: '';
        if($ename!=''){
            $where[] = ['m.league_name','like',"%$ename%"];
        }

        $t_name = isset($data['t_name']) ? $data['t_name']: '';
        if($t_name!=''){
            $where[] = ['m.team_name|m.away_team_name','like',"%$t_name%"];
        }

        $is_hot = isset($data['is_hot']) ? $data['is_hot']: '';
        if($is_hot!==''){
            if($is_hot == '-1'){
                $is_hot = 0;
            }
            $where[] = ['m.is_hot','=',$is_hot];
        }

        // 今天
        $today = date('Y-m-d');
        // 10天后
        $tenDaysLater = date('Y-m-d', strtotime('+10 days'));

        $start_time = $data['start_time'] ?? '';
        $end_time = $data['end_time'] ?? '';

        if(empty($start_time)){
            $start_time = $today;
        }
        if(empty($end_time)){
            $end_time = $tenDaysLater;
        }

        $where[]=['m.start_time','>=',strtotime($start_time)];
        $where[]=['m.start_time','<=',strtotime($end_time) + 60*60*24 - 1];


        $lists = Db::name('ggscore_match')
            ->alias('m')
            ->join('ggscore_league l','l.league_id=m.league_id and l.has_live=1')
            ->join('ggscore_match_anchor a','m.match_id=a.match_id ','left')
            ->field("m.*,a.user_ids")
            ->where($where)
            ->order('start_time', 'ASC')
            ->paginate(20);

        $lists->appends($data);
        $page = $lists->render();
        $lists = $lists->toArray();
        foreach ($lists['data'] as $key=>$value){
            $lists['data'][$key]['status'] = self::$selfStatusMap[$value['status']];
        }
        $this->assign('states',self::$selfStatusMap);
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

        if (!$id) $this->error('参数错误');

        $res = Db::name('ggscore_match')->where('id', $id)->update(['is_hot' => $isHot]);

        if ($res) {
            $this->success('修改成功');
        } else {
            $this->error('修改失败');
        }
    }



    public function addFootballAnchor()
    {

        $params    = $this->request->param();


        $data = Db::name('ggscore_match_anchor')->where([
            'match_id' => $params['match_id'],
            'sport_id' => 202,
        ])->find();

        if($data){
            $params['anchor_id'] = $data['user_ids'];
        }else{
            $params['anchor_id'] = '';
        }

        $this->assign('match_data', $params);
        return $this->fetch();
    }


    public function addFootballAnchorPost()
    {
        $match_id     = $this->request->param('match_id', 0, 'intval');
        $anchor_id  = $this->request->param('anchor_id', '');

        if (!$match_id) $this->error('参数错误');

        $data = Db::name('ggscore_match_anchor')->where([
            'match_id' => $match_id,
        ])->find();

        if(!$data){
            $res = Db::name('ggscore_match_anchor')->insert([
                'match_id' => $match_id,
                'user_ids' => $anchor_id,
                'sport_id' => 202,
            ]);
        }else{
            $res = Db::name('ggscore_match_anchor')->where('id', $data['id'])->update([
                'match_id' => $match_id,
                'user_ids' => $anchor_id,
            ]);
        }

        if ($res) {
            $this->success('绑定成功',"Match/footballList");
        } else {
            $this->error('绑定失败');
        }
    }




    public function addBasketballAnchor()
    {

        $params    = $this->request->param();

        $data = Db::name('ggscore_match_anchor')->where([
            'match_id' => $params['match_id'],
            'sport_id' => 201,
        ])->find();

        if($data){
            $params['anchor_id'] = $data['user_ids'];
        }else{
            $params['anchor_id'] = '';
        }

        $this->assign('match_data', $params);
        return $this->fetch();
    }


    public function addBasketballAnchorPost()
    {
        $match_id     = $this->request->param('match_id', 0, 'intval');
        $anchor_id  = $this->request->param('anchor_id', '');

        if (!$match_id) $this->error('参数错误');

        $data = Db::name('ggscore_match_anchor')->where([
            'match_id' => $match_id,
        ])->find();

        if(!$data){
            $res = Db::name('ggscore_match_anchor')->insert([
                'match_id' => $match_id,
                'user_ids' => $anchor_id,
                'sport_id' => 201,
            ]);
        }else{
            $res = Db::name('ggscore_match_anchor')->where('id', $data['id'])->update([
                'match_id' => $match_id,
                'user_ids' => $anchor_id,
            ]);
        }

        if ($res) {
            $this->success('绑定成功',"Match/basketballList");
        } else {
            $this->error('绑定失败');
        }
    }

}