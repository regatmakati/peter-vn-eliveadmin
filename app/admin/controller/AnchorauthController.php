<?php

/**
 * 主播授权
 */
namespace app\admin\controller;

use app\admin\model\AnchorAuthModel;
use cmf\controller\AdminBaseController;
use think\Db;

class AnchorauthController extends AdminbaseController {

    public function index(){
        $uid = $this->request->param('uid', '');

        $where = [];
        if($uid != ''){
            if(preg_match("/^[1-9][0-9]*$/",$uid)){
                $where[] = ['uid','=',$uid];
            }else{
                $uids = Db::name("user")->where('user_nicename','like',"%$uid%")->column('id');
                $where[] = ['uid','in',$uids];
            }
        }
			
    	$lists = Db::name("anchor_auth")
            ->where($where)
            ->order("addtime desc")
            ->paginate(20);

        $lists->each(function($v,$k){
            $v['userinfo']=getUserInfo($v['uid']);
            return $v;
        });
        
        $page = $lists->render();
    	$this->assign('lists', $lists);
    	$this->assign("page", $page);
    	return $this->fetch();
    }
		
    function del(){
        
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = DB::name('anchor_auth')->where("id={$id}")->delete();
        if(!$rs){
            $this->error("删除失败！");
        }

        AnchorAuthModel::setLiveOwnerCache();

        $this->success("删除成功！");				
    }

    public function add(){
        return $this->fetch();
    }	
    function addPost(){
        if ($this->request->isPost()) {
            
            $data = $this->request->param();
            
			$uid = (int)$data['uid'];

			if(!$uid){
				$this->error("请填写用户ID");
			}

            $status = $data['status'];
            if($status == "" || !in_array($status,[0,1])){
                $this->error("状态参数错误");
            }

            $userinfo = DB::name('user')->field("ishot,isrecommend")->where(["id"=>$uid])->find();
            if(!$userinfo){
                $this->error('用户不存在');
            }

            $isExist = DB::name('anchor_auth')->where(["uid"=>$uid])->find();
            if($isExist){
                $this->error("请勿重复添加！");
            }

            $data['addtime'] = time();
			$id = DB::name('anchor_auth')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }

            AnchorAuthModel::setLiveOwnerCache();

            $this->success("添加成功！");
		}
    }		
    function edit(){
        
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::name('anchor_auth')
            ->where("id={$id}")
            ->find();
        if(!$data){
            $this->error("信息错误");
        }
        $uid = $data['uid'];
		$userinfo = getUserInfo($uid);
		$data['subscribenum'] = $userinfo['subscribenum'];
		$data['viewnum'] = $userinfo['viewnum'];
        $this->assign('data', $data);
        return $this->fetch(); 			
    }
    
    function editPost(){
        if ($this->request->isPost()) {
            
            $data = $this->request->param();

            $id = (int)$data['id'];

            if(!$id){
                $this->error("参数错误");
            }

            $status = $data['status'];
            if($status == "" || !in_array($status,[0,1])){
                $this->error("状态参数错误");
            }

            $res = DB::name('anchor_auth')->where(["id"=>$id])->update(['status'=>$status]);
            if($res===false){
                $this->error("修改失败！");
            }

			$uid = $data['uid'];
			$arr['subscribenum'] = $data['subscribenum'];
			$arr['viewnum'] = $data['viewnum'];
			DB::name('user')->where(["id"=>$uid])->update($arr);
			
            AnchorAuthModel::setLiveOwnerCache();

            $this->success("修改成功！");
		}	
    }

}
