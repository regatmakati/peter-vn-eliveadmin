<?php

/**
 * 资讯分类
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class ArticleclassController extends AdminbaseController {
    function index(){
			
    	$lists = Db::name("article_class")
            //->where()
            ->order("list_order asc, id desc")
            ->paginate(20);
            
        
        $page = $lists->render();

    	$this->assign('lists', $lists);

    	$this->assign("page", $page);
    	
    	return $this->fetch();
    }
		
    function del(){
        
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = DB::name('article_class')->where("id={$id}")->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        
        $action="删除资讯分类：{$id}";
        setAdminLog($action);
                    
        $this->resetcache();
        $this->success("删除成功！");				
    }		
    //排序
    public function listOrder() { 
		
        $model = DB::name('article_class');
        parent::listOrders($model);
        
        $action="更新资讯分类排序";
        setAdminLog($action);
        
        $this->resetcache();
        $this->success("排序更新成功！");
    }	
    

    function add(){        
        return $this->fetch();
    }	
    function addPost(){
        if ($this->request->isPost()) {
            
            $data = $this->request->param();
            
			$name=$data['name'];

			if($name==""){
				$this->error("请填写分类名称");
			}
			// $thumb=$data['thumb'];
			// if($thumb==""){
				// $this->error("请上传图标");
			// }

            $des=$data['des'];
            if($des==''){
                $this->error("请填写资讯分类描述");
            }

            if(mb_strlen($des)>200){
                $this->error("资讯分类描述在200字以内");
            }
            
			$id = DB::name('article_class')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }
            
            $action="添加资讯分类：{$id}";
            setAdminLog($action);
            
            $this->resetcache();
            $this->success("添加成功！");
            
		}
    }		
    function edit(){
        
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::name('article_class')
            ->where("id={$id}")
            ->find();
        if(!$data){
            $this->error("信息错误");
        }
        
        $this->assign('data', $data);
        return $this->fetch(); 			
    }
    
    function editPost(){
        if ($this->request->isPost()) {
            
            $data      = $this->request->param();
            
			$name=$data['name'];

			if($name==""){
				$this->error("请填写分类名称");
			}
			// $thumb=$data['thumb'];
			// if($thumb==""){
				// $this->error("请上传图标");
			// }

			$des=$data['des'];
            if($des==''){
                $this->error("请填写资讯分类描述");
            }

            if(mb_strlen($des)>200){
                $this->error("资讯分类描述在200字以内");
            }
            
			$id = DB::name('article_class')->update($data);
            if($id===false){
                $this->error("修改失败！");
            }
            
            $action="修改资讯分类：{$data['id']}";
            setAdminLog($action);
            
            $this->resetcache();
            $this->success("修改成功！");
		}	
    }
    
    function resetCache(){
        $key='getArticleClass';
        $rules= DB::name('article_class')
                ->order('list_order asc,id desc')
                ->select();
        if($rules){
            setcaches($key,$rules);
        }else{
			delcache($key);
		}
        
        return 1;
    }
}
