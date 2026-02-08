<?php

/**
 * 联系方式
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class ContractController extends AdminbaseController {

    protected $statusMap=['隐藏全部','显示全部','显示复制按钮'];
    
    protected function getType($k=''){
        $type=array(
            '1'=>'QQ',
            '2'=>'微信',
        );
        if($k===''){
            return $type;
        }
        
        return isset($type[$k]) ? $type[$k]: '';
    }
    
    function index(){
        $data = $this->request->param();
        $map=[];
        
        $start_time=isset($data['start_time']) ? $data['start_time']: '';
        $end_time=isset($data['end_time']) ? $data['end_time']: '';
        
        if($start_time!=""){
           $map[]=['created_at','>=',date("Y-m-d",strtotime($start_time))];
        }

        if($end_time!=""){
           $map[]=['created_at','<=',date("Y-m-d",strtotime($end_time) + 60*60*24)];
        }
        
        $type=isset($data['type']) ? $data['type']: '';
        if($type!=''){
            $map[]=['type','=',$type];
        }
        $keyword=isset($data['keyword']) ? $data['keyword']: '';
        if($keyword!=''){
            $map[]=['contract','like',"%".$keyword."%"];
        }
        
        $uid=isset($data['uid']) ? $data['uid']: '';
        if($uid!=''){
            $lianguid=getLianguser($uid);
            if($lianguid){
                $map[]=['uid',['=',$uid],['in',$lianguid],'or'];
            }else{
                $map[]=['uid','=',$uid];
            }
        }

    	$lists = Db::name("live_contract")
                ->where($map)
                ->order("created_at DESC")
                ->paginate(20);
        $lists->each(function($v,$k){
			$v['userinfo']=getUserInfo($v['uid']);
			$v['statusMap']=$this->statusMap[$v['status']];
            return $v;
        });


        $lists->appends($data);
        $page = $lists->render();
    	$this->assign('lists', $lists);

    	$this->assign("page", $page);
        
        $this->assign('types', $this->getType());
    	
    	return $this->fetch();
    }
    public function add(){
        $param = $this->request->param();
        if(!empty($param['uid'])){
            $this->assign('uid',$param['uid']);
            $qq = DB::name('live_contract')->where(["uid"=>$param['uid'],'type'=>1])->select();
            $wechat = DB::name('live_contract')->where(["uid"=>$param['uid'],'type'=>2])->select();
            $this->assign('qq',$qq);
            $this->assign('wechat',$wechat);
        }

        $types=$this->getType();
        $this->assign('types', $types);
        return $this->fetch();
    }

    function addPost(){
        if ($this->request->isPost()) {

            $data = $this->request->param();

            $uid = (int)$data['uid'];

            if(!$uid){
                $this->error("请填写用户ID");
            }
            $userinfo = DB::name('user')->where(["id"=>$uid])->find();
            if(!$userinfo){
                $this->error('用户不存在');
            }
            // foreach ($data['qq'] as $key=>$value){
                // if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $value, $match)) {
                    // $this->error("联系方式不能输入汉字");
                // }
            // }
            // foreach ($data['wechat'] as $k=>$v){
                // if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $v, $match)) {
                    // $this->error("联系方式不能输入汉字");
                // }
            // }
            $del = DB::name('live_contract')->where(["uid"=>$uid])->delete();

            foreach ($data['qq'] as $qkey=>$qvalue){
                if(!$qvalue) continue;
                $insert['type'] = 1;
                $insert['contract'] = $qvalue;
                $insert['uid'] = $data['uid'];
                $insert['status'] = $data['status'][$qkey];
                $insert['created_at'] = date("Y-m-d H:i:s",time()+rand(0,100));
                DB::name('live_contract')->insert($insert);
            }

            foreach ($data['wechat'] as $wkey=>$wvalue){
                if(!$wvalue) continue;
                $insert['type'] = 2;
                $insert['contract'] = $wvalue;
                $insert['uid'] = $data['uid'];
                $insert['status'] = $data['wechatStatus'][$wkey];
                $insert['created_at'] = date("Y-m-d H:i:s",time()+rand(0,100));
                DB::name('live_contract')->insert($insert);
            }

            $this->success("添加成功！",url('liveing/index'));
        }
    }


    function del(){
        
        $uid = $this->request->param('uid', 0, 'intval');
        $created_at   = $this->request->param('created_at');

        $rs = DB::name('live_contract')->where(['uid'=>$uid,'created_at'=>$created_at])->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        
        $action="删除主播联系方式：{$uid}";
        setAdminLog($action);
        
        $this->success("删除成功！");
            
	}
    
    function edit(){
        
        $uid   = $this->request->param('uid', 0, 'intval');
        $created_at   = $this->request->param('created_at');

        $data=Db::name('live_contract')
            ->where(['uid'=>$uid,'created_at'=>$created_at])
            ->find();
        if(!$data){
            $this->error("信息错误");
        }
        
        $data['userinfo']=getUserInfo($data['uid']);

        $types=$this->getType();

        
        $this->assign('types', $types);
            
        $this->assign('data', $data);
        return $this->fetch();
	}
	function editPost(){
		if ($this->request->isPost()) {
            
            $data = $this->request->param();
            
			$uid=$data['uid'];
            if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $data['contract'], $match)) {
                $this->error("联系方式不能输入汉字");
            }
            $data['updated_at']=date("Y-m-d H:i:s");

			$rs = DB::name('live_contract')->where(['uid'=>$uid,'created_at'=>$data['created_at']])->update($data);
            if($rs===false){
                $this->error("修改失败！");
            }
             $action="修改主播联系方式：{$uid} ";

            setAdminLog($action);
            
            $this->success("修改成功！",url('contract/index'));
		}
	}
	
    
}
