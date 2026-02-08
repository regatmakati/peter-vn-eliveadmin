<?php
/**
 * 资讯采集
 */
namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;
use cmf\lib\Upload;

class NewsController extends HomebaseController{

	/**
	 * 资讯提交接口
	 * @desc 用于 提交采集的资讯信息
	 * @return int status 提示码，0表示成功
	 * @return string errormsg 提示信息
	 * @params act 限制提交识别码 	qV3bzGfzGNNRdjhXJ0bkkfTJ2a3W5iNw
	 * @params ptype 父类ID 1-足球  2-篮球
	 * @params type  子类ID 1-世界杯，2-欧冠，3-英超，4-意甲，5-西甲，6-法甲，7-德甲，8-中超，9-日职联，10-各国杯赛，
							11-其他联赛，12-其他国际赛事 13-NBA，14-CBA，15-世锦赛，16-其他国家联赛
	 * @params soure 来源ID  1-雷速体育  2-懂球帝  3-腾讯体育
	 * @params title 标题
	 * @params author 作者	 
	 * @params thumb 缩略图  路径定义  /thumb/源ID/二级分类ID/日期/文件名
	 * @params content 内容主体  {$vo.content|htmlspecialchars_decode|strip_tags|subtext=50}
	 * @params publishtime 发布时间
	 */	
	function postNews(){
		$data=$this->request->param();
        if ($data['act'] != "qV3bzGfzGNNRdjhXJ0bkkfTJ2a3W5iNw") {
			echo json_encode(array("status"=>101,'errormsg'=>'非法使用接口！！！'));
            exit;
        }
        $ptype = isset($data['ptype']) ? $data['ptype']: 0;
        if (!$ptype) {
			echo json_encode(array("status"=>102,'errormsg'=>'父类不能为空！！！'));
            exit;
        }		
        $type = isset($data['type']) ? $data['type']: 0;
        if (!$type) {
			echo json_encode(array("status"=>103,'errormsg'=>'子类不能为空！！！'));
            exit;
        }		
		$source =isset($data['source']) ? $data['source']: 0;
        if (!$source) {
			echo json_encode(array("status"=>104,'errormsg'=>'来源不能为空！！！'));
            exit;
        }			
        
        $author =isset($data['author']) ? $data['author']: '';
		$title =isset($data['title']) ? $data['title']: '';
		
        if (!$title) {
			echo json_encode(array("status"=>105,'errormsg'=>'标题不能为空！！！'));
            exit;
        }		
		$thumb =isset($data['thumb']) ? $data['thumb']: '';
		$content =isset($data['content']) ? $data['content']: '';
		if (!$content) {
			echo json_encode(array("status"=>106,'errormsg'=>'内容不能为空！！！'));
            exit;
        }
		$publishtime =isset($data['publishtime']) ? $data['publishtime']: '';
        
		
        $data2=[
            'ptype'=>$ptype,
            'type'=>$type,
            'source'=>$source,
			'title'=>$title,
			'author'=>$author,
            'content'=>htmlspecialchars($content),
			'thumb'=>$thumb,
			'publishtime'=>$publishtime,
            'addtime'=>time(),
        ];
        
        $find = Db::name("notice")->where(['title'=>$title])->find();
        if(!$find){
            $result=Db::name("notice")->insert($data2);
            if($result){
                echo json_encode(array("status"=>0,'msg'=>'提交成功！！！'));
                exit;
            }else{
                echo json_encode(array("status"=>107,'errormsg'=>'提交失败！！！'));
                exit;
            }
        }else{
            echo json_encode(array("status"=>108,'errormsg'=>'请勿重复提交！！！'));
            exit;
        }

	
	}	
    
	/* 图片上传 */
	public function upload(){
        
        $file=isset($_FILES['file'])?$_FILES['file']:'';
        if($file){
            $name=$file['name'];
            $pathinfo = pathinfo($name);
            if(!isset($pathinfo['extension'])){
                $_FILES['file']['name']=$name.'.jpg';
            }
        }
        
        $uploader = new Upload();
        $uploader->setFileType('image');
        $result = $uploader->upload();

        if ($result === false) {
            
            echo json_encode(array("ret"=>0,'file'=>'','msg'=>$uploader->getError()));
            exit;
        }
        
        /* $result=[
            'filepath'    => $arrInfo["file_path"],
            "name"        => $arrInfo["filename"],
            'id'          => $strId,
            'preview_url' => cmf_get_root() . '/upload/' . $arrInfo["file_path"],
            'url'         => cmf_get_root() . '/upload/' . $arrInfo["file_path"],
        ]; */
        
        echo json_encode(array("ret"=>200,'data'=>array("url"=>$result['url']),'msg'=>''));
        exit;
	}
}