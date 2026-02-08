<?php

/**
 * 公告管理
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class NoticeController extends AdminbaseController {

    protected function getArticleSource($k = '')
    {
        $source = [
            '1' => '雷速体育',
            '2' => '懂球帝',
			'3' => '腾讯体育',
        ];

        if ($k == '') {
            return $source[2];
        }
        return $source[$k];
    }
	
	
    protected function getArticleTypes($type)
    {
		
		$catname = DB::name('article_class')->field("id,name")->where("id='$type'")->find();
		
		return $catname['name'];
    }
	
    public function index(){
        $data = $this->request->param();
        $map = [];

        $ishot = isset($data['ishot']) ? $data['ishot'] : '0';
        if ($ishot) {
            $map[] = ['ishot', '=', $ishot];
        }	

        $isrecommend = isset($data['isrecommend']) ? $data['isrecommend'] : '0';
        if ($isrecommend) {
            $map[] = ['isrecommend', '=', $isrecommend];
        }	

        $istop = isset($data['istop']) ? $data['istop'] : '0';
        if ($istop) {
            $map[] = ['istop', '=', $istop];
        }	

        $source = isset($data['source']) ? $data['source'] : '0';
        if ($source) {
            $map[] = ['source', '=', $source];
        }	
		
    	$lists = Db::name("notice")
            ->where($map)
            ->order("addtime desc")
            ->paginate(20);

        $lists->each(function ($v, $k) {
			$v['type'] = $this->getArticleTypes($v['type']);
			$v['source'] = $this->getArticleSource($v['source']);
			return $v;
        });
		
        $page = $lists->render();
    	$this->assign('lists', $lists);
    	$this->assign("page", $page);
    	return $this->fetch();
    }
		
    function del(){
        
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = DB::name('notice')->where("id={$id}")->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        delcache('PCNotice');

        $this->success("删除成功！");				
    }

    public function add(){
        return $this->fetch();
    }	
    function addPost(){
        if ($this->request->isPost()) {
            
            $data = $this->request->param();

			$title = $data['title'];
			if($title==''){
				$this->error("标题不能为空");
			}

            $content = isset($data['content'])?$data['content']:'';
            if($content==''){
                $this->error("内容不能为空");
            }
            $data['content'] = htmlspecialchars($data['content']);

            $status = $data['status'];
            if($status == "" || !in_array($status,[0,1])){
                $this->error("状态参数错误");
            }

            $data['addtime'] = time();

			$id = DB::name('notice')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }
            delcache('PCNotice');

            $this->success("添加成功！");
		}
    }		
    function edit(){
        
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::name('notice')
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


            $data = $this->request->param();

            $id = (int)$data['id'];
            if(!$id){
                $this->error("参数错误");
            }

            $title = $data['title'];
            if($title==''){
                $this->error("标题不能为空");
            }

            $content = isset($data['content'])?htmlspecialchars($data['content']):'';
            if($content==''){
                $this->error("内容不能为空");
            }

            $status = $data['status'];
            if($status == "" || !in_array($status,[0,1])){
                $this->error("状态参数错误");
            }

            $ishot = $data['ishot'];
            if($ishot == "" || !in_array($ishot,[0,1])){
                $this->error("是否热点参数错误");
            }

            $istop = $data['istop'];
            if($istop == "" || !in_array($istop,[0,1])){
                $this->error("是否置顶参数错误");
            }
			
            $isrecommend = $data['isrecommend'];
            if($isrecommend == "" || !in_array($isrecommend,[0,1])){
                $this->error("是否推荐参数错误");
            }
			
            $res = DB::name('notice')->where(["id"=>$id])->update(['title'=>$title,'content'=>$content,'status'=>$status,'ishot'=>$ishot,'isrecommend'=>$isrecommend,'istop'=>$istop,'type'=>$data['type'],'thumb'=>$data['thumb']]);
            if($res===false){
                $this->error("修改失败！");
            }
            delcache('PCNotice');
            $this->success("修改成功！");
		}	
    }

}
