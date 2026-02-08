<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use think\Controller;
use think\Db;

class VideoController extends Controller
{

    public function getDouyinVideo(){
//        $sql = "select * from cmf_video order by id desc ";
//        $result = Db::connect("mysql://root:root@127.0.0.1:3306/live_video#utf8")->query($sql);
//        dump($result);

        $redata = $this->getDir();
        foreach ($redata as $k=>$v){
            foreach ($v as $key=>$val){
                $data[] = [
                    'uid' => mt_rand(24,29),
                    'title' => $val['name'],
                    'thumb' => '',
                    'href' => $val['url'],
                    'href_w' => $val['url'],
                    'likes' => mt_rand(2,10),
                    'views' => mt_rand(10,40),
                    'addtime' => time(),
                    'status' => 1,
                    'classid' => 1,
                ];
            }
        }

        $res = Db::connect("mysql://root:root@127.0.0.1:3306/live_video#utf8")->table('cmf_video')->insertAll($data);
        dump($res);
    }


    public function searchDir($path, &$data,$k='',$url='',$name=''){
        if(is_dir($path)){
            $dp=dir($path);
            while($file=$dp->read()){
                if($file!='.'&& $file!='..'){
                    if(is_dir($path.'/'.$file)){
                        $k = $file;
                    }else{
                        $info = pathinfo($file);
                        if ($info['extension'] == 'txt') {
                            continue;
                        }
                        $url = $k.'/'.$file;
                        $nameadd = str_replace('.mp4','.txt',$path.'/'.$file);
                        $myfile = fopen($nameadd, "r");
                        $name = fread($myfile,1024);
                        $name = iconv("gb2312", "utf-8", $name);
                        fclose($myfile);
//                        $name2 = file_get_contents($nameadd);
//                        $name2 = iconv("gb2312", "utf-8", $name2);
                    }

                    $this->searchDir($path.'/'.$file,$data,$k,$url,$name);
                }
            }
            $dp->close();
        }
        if(is_file($path)){
            $data[$k][]=['name'=>$name,'url'=>$url];
        }
    }
    public function getDir(){
        $dir = 'D:\phpstudy_pro\WWW\video';
        $data=array();
        $this->searchDir($dir,$data);
//        var_dump($data);
        return $data;
    }



}
