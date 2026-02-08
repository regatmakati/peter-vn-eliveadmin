<?php

/**
 * 统计数据
 * @author sukura
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class StatisticsController extends AdminbaseController {

    protected function getActions($k=''){
        $action=array(
            '1'=>'PC端android',
            '2'=>'PC端ios',
            '3'=>'h5端android',
            '4'=>'h5端ios',			
        );
        if($k===''){
            return $action;
        }
        
        return isset($action[$k]) ? $action[$k]: '';
    } 
	
    protected function getTypes($k=''){
        $type=array(
            '1'=>'app下载',
        );
        if($k===''){
            return $type;
        }
        
        return isset($type[$k]) ? $type[$k]: '';
    }    
    
    function index(){

        $data = $this->request->param();
        $map=[];
		
        $type=isset($data['type']) ? $data['type']: '';
        if($type!=''){
            $map[]=['type','=',$type];
        }

        $action=isset($data['action']) ? $data['action']: '';
        if($action!=''){
            $map[]=['action','=',$action];
        }
        
        $start_time=isset($data['start_time']) ? $data['start_time']: '';
        $end_time=isset($data['end_time']) ? $data['end_time']: '';
        
        if($start_time!=""){
           $map[]=['updated_at','>=',$start_time];
        }

        if($end_time!=""){
           $map[]=['updated_at','<=',date('Y-m-d H:i:s',strtotime($end_time) + 60*60*24)];
        }
        
    	$lists = DB::name("statistics")
            ->where($map)
            ->order('id desc')
            ->paginate(20);        
       
        $lists->appends($data);
        $page = $lists->render();
        
        $this->assign('lists', $lists);

    	$this->assign('type', $this->getTypes());
		$this->assign('action', $this->getActions());
    	$this->assign("page", $page);
    	
    	return $this->fetch();
    }

}
