<?php

/**
 * 直播列表
 */

namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Where;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Live\V20180801\LiveClient;
use TencentCloud\Live\V20180801\Models\CreateRecordTaskRequest;
use TencentCloud\Live\V20180801\Models\StopRecordTaskRequest;
class LiveingController extends AdminbaseController
{
    protected function getLiveClass()
    {

        $liveclass = Db::name("live_class")->order('list_order asc, id desc')->column('id,name');

        return $liveclass;
    }

    protected function getKefuList()
    {

        $kefulist = Db::name("kefu")->order('id desc')->column('id,nickname');

        return $kefulist;
    }
	
    protected function getStatus($k = '')
    {
        $status = [
            '1' => 'GO',
            '2' => '红',
            '3' => '黑',
        ];

        if ($k == '') {
            return $status;
        }
        return $status[$k];
    }
	
    protected function getTypes($k = '')
    {
        $type = [
            '0' => '普通房间',
            '1' => '密码房间',
            '2' => '门票房间',
            '3' => '计时房间',
        ];

        if ($k == '') {
            return $type;
        }
        return $type[$k];
    }

    /**
     * 关闭聊天信息折叠
     */
    public function closeFold()
    {
        $uid = $this->request->param('uid', 0, 'intval');
        //推送消息通知前端
        sendDataToChatServer([
            'secretKey' => config('database.socketSecretKey'),
            'type' => 'adminCloseFold',
            'msg' => [
                'liveuid' => $uid
            ]
        ]);
        $GLOBALS['redisdb']->set("{$uid}_is_fold_off", 1);
        DB::name('live')->where(['uid' => $uid])->update(['is_fold_off' => 1]);
        $this->success("关闭成功！", url("liveing/index"));
    }

    /**
     * 开启聊天信息折叠
     */
    public function openFold()
    {
        $uid = $this->request->param('uid', 0, 'intval');
        //推送消息通知前端
        sendDataToChatServer([
            'secretKey' => config('database.socketSecretKey'),
            'type' => 'adminOpenFold',
            'msg' => [
                'liveuid' => $uid
            ]
        ]);
        $GLOBALS['redisdb']->set("{$uid}_is_fold_off", 0);
        DB::name('live')->where(['uid' => $uid])->update(['is_fold_off' => 0]);
        $this->success("开启成功！", url("liveing/index"));
    }
	
	
    /**
     * 关闭礼物
     */
    public function closeGift()
    {
        $uid = $this->request->param('uid', 0, 'intval');
        //推送消息通知前端
        sendDataToChatServer([
            'secretKey' => config('database.socketSecretKey'),
            'type' => 'adminCloseGift',
            'msg' => [
                'liveuid' => $uid,
            ]
        ]);
        $GLOBALS['redisdb']->set("{$uid}_is_gift_off", 1);
        DB::name('live')->where(['uid' => $uid])->update(['is_gift_off' => 1]);
        $this->success("关闭成功！", url("liveing/index"));
    }

    /**
     * 开启礼物
     */
    public function openGift()
    {
        $uid = $this->request->param('uid', 0, 'intval');
        //推送消息通知前端
        sendDataToChatServer([
            'secretKey' => config('database.socketSecretKey'),
            'type' => 'adminOpenGift',
            'msg' => [
                'liveuid' => $uid,
            ]
        ]);
        $GLOBALS['redisdb']->set("{$uid}_is_gift_off", 0);
        DB::name('live')->where(['uid' => $uid])->update(['is_gift_off' => 0]);
        $this->success("开启成功！", url("liveing/index"));
    }
	
    function teidanaddPost()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
			$data['status'] = $data['status']?$data['status']:1;
            $data['addtime'] = time();
			if(!$data['liveuid']){
				$this->error("请选择相应的直播间！");
			}
			if(!$data['type']){
				$this->error("请选择推单分类！");
			}			
            $rs = DB::name('live_teidan')->insertGetId($data);

			//推单消息通知前端
			sendDataToChatServer([
				'secretKey' => config('database.socketSecretKey'),
				'type' => 'sendTeidanMessage',
				'msg' => [
					'action' => 'add',
					'id' => $rs,
					'liveuid' => $data['liveuid'],
					'title' =>  $data['title'],
					'type' => $this->getTeidanTypes($data['type']),
					'status' => $data['status'],//$this->getStatus($data['status']),
					'buy' => 0,
					'oppositebuy' => 0
				]
			]);				
			
            if ($rs === false) {
                $this->error("添加失败！");
            }
            $this->success("添加成功！");
        }
    }

	
    function teidanadd()
    {
		$this->assign("type", $this->getTeidanTypes());
        $this->assign("status", $this->getStatus());
		$this->assign("livelist", $this->getLiveList());
		
        return $this->fetch();
    }
	
    function teidaneditPost()
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();
			$data['status'] = $data['status']?$data['status']:1;
			if(!$data['liveuid']){
				$this->error("请选择相应的直播间！");
			}
			if(!$data['type']){
				$this->error("请选择推单分类！");
			}			
            $rs = DB::name('live_teidan')->update($data);
			
			//推单消息通知前端
			sendDataToChatServer([
				'secretKey' => config('database.socketSecretKey'),
				'type' => 'sendTeidanMessage',
				'msg' => [
					'action' => 'edit',
					'id' => $data['id'],
					'liveuid' => $data['liveuid'],
					'title' =>  $data['title'],
					'type' => $this->getTeidanTypes($data['type']),
					'status' => $data['status'],//$this->getStatus($data['status']),
					'buy' => $data['buy'],
					'oppositebuy' => $data['oppositebuy']
				]
			]);
			
            if ($rs === false) {
                $this->error("修改失败！");
            }

            $this->success("修改成功！");
        }
    }
	
    function teidanedit()
    {
        $id = $this->request->param('id', 0, 'intval');
        $data = Db::name('live_teidan')
            ->where("id={$id}")
            ->find();
        if (!$data) {
            $this->error("信息错误");
        }
        $this->assign('data', $data);
		$this->assign("type", $this->getTeidanTypes());
        $this->assign("status", $this->getStatus());
		$this->assign("livelist", $this->getLiveList());
		
        return $this->fetch();
    }	
	
    function teidanmgt()
    {
        $data = $this->request->param();
        $map = [];
        $start_time = isset($data['start_time']) ? $data['start_time'] : '';
        $end_time = isset($data['end_time']) ? $data['end_time'] : '';

        if ($start_time != "") {
            $map[] = ['addtime', '>=', strtotime($start_time)];
        }

        if ($end_time != "") {
            $map[] = ['addtime', '<=', strtotime($end_time) + 60 * 60 * 24];
        }

        $status = isset($data['status']) ? $data['status'] : '';
        if ($status != "") {
            $map[] = ['status', '=', $status];
        }	
        $type = isset($data['type']) ? $data['type'] : '';
        if ($type != "") {
            $map[] = ['type', '=', $type];
        }	

        $lists = Db::name("live_teidan")
            ->where($map)
            ->order("addtime DESC")
            ->paginate(20);

        $lists->each(function ($v, $k) {
			$v['type'] = $this->getTeidanTypes($v['type']);
            $v['status'] = $this->getStatus($v['status']);
			$v['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
			if($v['liveuid']){
				$liveinfo = DB::name('live')->where(['uid' => $v['liveuid']])->find();
				if($liveinfo){
					$userinfo = getUserInfo($v['liveuid']);
					$v['liveinfo'] = '['.$userinfo['user_nicename'].'] - '.$liveinfo['title'];
				}else{
					$v['liveinfo'] = '';
				}
			}else{
				$v['liveinfo'] = '';
			}
			return $v;
        });

        $lists->appends($data);
        $page = $lists->render();

        $this->assign('lists', $lists);

        $this->assign("page", $page);
		
		$this->assign("type", $this->getTeidanTypes());
        $this->assign("status", $this->getStatus());

        return $this->fetch();

    }
	
    function index()
    {
        $data = $this->request->param();
        $map = [];
        $map[] = ['islive', '=', 1];
        $start_time = isset($data['start_time']) ? $data['start_time'] : '';
        $end_time = isset($data['end_time']) ? $data['end_time'] : '';

        if ($start_time != "") {
            $map[] = ['starttime', '>=', strtotime($start_time)];
        }

        if ($end_time != "") {
            $map[] = ['starttime', '<=', strtotime($end_time) + 60 * 60 * 24];
        }

        $uid = isset($data['uid']) ? $data['uid'] : '';
        if ($uid != '') {
            $lianguid = getLianguser($uid);
            if ($lianguid) {
                $map[] = ['uid', ['=', $uid], ['in', $lianguid], 'or'];
            } else {
                $map[] = ['uid', '=', $uid];
            }
        }

        $this->configpri = getConfigPri();


        $lists = Db::name("live")
            ->where($map)
            ->order("starttime DESC")
            ->paginate(20);

        $lists->each(function ($v, $k) {

            $v['userinfo'] = getUserInfo($v['uid']);
            $where = [];
            $where['action'] = 1;
            $where['touid'] = $v['uid'];
            $where['showid'] = $v['showid'];
            /* 本场总收益 */
            $totalcoin = Db::name("user_coinrecord")->where($where)->sum('totalcoin');
            if (!$totalcoin) {
                $totalcoin = 0;
            }
            /* 送礼物总人数 */
            $total_nums = Db::name("user_coinrecord")->where($where)->group("uid")->count();
            if (!$total_nums) {
                $total_nums = 0;
            }
            /* 人均 */
            $total_average = 0;
            if ($totalcoin && $total_nums) {
                $total_average = round($totalcoin / $total_nums, 2);
            }

            /* 人数 */
            //$nums = zSize('user_' . $v['stream']);
            //$pcnums = zSize('userpc_' . $v['stream']);//sCard('roomNum_pc_' . $v['uid']);
            //$h5nums = zSize('userh5_' . $v['stream']);//sCard('roomNum_h5_' . $v['uid']);
            //$androidnums = zSize('userandroid_' . $v['stream']);//sCard('roomNum_android_' . $v['uid']);
            //iosnums = zSize('userios_' . $v['stream']);//sCard('roomNum_ios_' . $v['uid']);

            $nums=zSize('user_'.$v['stream']);
            $pcnums=zSize('roomNum_pc_'.$v['uid']);
            $h5nums=zSize('roomNum_h5_'.$v['uid']);
            $androidnums=zSize('roomNum_android_'.$v['uid']);
            $iosnums=zSize('roomNum_ios_'.$v['uid']);

            $v['totalcoin']=$totalcoin;
            $v['total_nums']=$total_nums;
            $v['total_average']=$total_average;
            $v['nums']=$nums;
            $v['pcnums']=$pcnums;
            $v['h5nums']=$h5nums;
            $v['androidnums']=$androidnums;
            $v['iosnums']=$iosnums;
            $v['allnums']=$pcnums+$h5nums+$androidnums+$iosnums;
			
            if ($v['isvideo'] == 0 && $this->configpri['cdn_switch'] != 5) {
                $v['pull'] = PrivateKeyA('rtmp', $v['stream'], 0);
            }

            return $v;
        });

        $lists->appends($data);
        $page = $lists->render();

        $liveclass = $this->getLiveClass();		
        $liveclass[0] = '默认分类';

        $this->assign('lists', $lists);

        $this->assign("page", $page);

        $this->assign("liveclass", $liveclass);
		
        $this->assign("type", $this->getTypes());

        return $this->fetch();

    }

    function record(){
        $uid = $this->request->param('uid', 0, 'intval');
        $live =   DB::name('live')->where("uid={$uid}")->find();

        $configpri=getConfigPri();
        if($live['isrecord']){
            //有录播停止录播
            try {

                $cred = new Credential($configpri['txcloud_secret_id'], $configpri['txcloud_secret_key']);
                $httpProfile = new HttpProfile();
                $httpProfile->setEndpoint("live.tencentcloudapi.com");

                $clientProfile = new ClientProfile();
                $clientProfile->setHttpProfile($httpProfile);
                $client = new LiveClient($cred, "ap-guangzhou", $clientProfile);

                $req = new StopRecordTaskRequest();

                $params = array(
                    "TaskId" => $live['recordid']
                );
                $req->fromJsonString(json_encode($params));

                $resp = $client->StopRecordTask($req);
                $requestId = $resp->RequestId;
                if($requestId){
                    //停止录播任务成功
                    $res = DB::name('live')->where("uid={$uid}")->update(['isrecord'=>0,'recordid'=>'']);
                    $this->success("停止成功!");
                }else{
                    $this->error("停止失败!");
                }
                print_r($resp->toJsonString());
            }
            catch(TencentCloudSDKException $e) {
                echo $e;
            }
        }else{
            try {
                $cred = new Credential($configpri['txcloud_secret_id'], $configpri['txcloud_secret_key']);
                $httpProfile = new HttpProfile();
                $httpProfile->setEndpoint("live.tencentcloudapi.com");

                $clientProfile = new ClientProfile();
                $clientProfile->setHttpProfile($httpProfile);
                $client = new LiveClient($cred, "ap-guangzhou", $clientProfile);

                $req = new CreateRecordTaskRequest();
                $tx_push = parse_url($configpri['tx_push']);
                $params = array(
                    "StreamName" => $live['stream'],
                    "DomainName" => $tx_push['host'],
                    "AppName" => "live",
                    "EndTime" => time()+2.5*3600
                );
                $req->fromJsonString(json_encode($params));

                $resp = $client->CreateRecordTask($req);
                $taskId = $resp->TaskId;
                if($taskId){
                    //录播任务成功
                    $res = DB::name('live')->where("uid={$uid}")->update(['isrecord'=>1,'recordid'=>$taskId]);
                    $this->success("录播成功!");
                }else{
                    $this->error("录播失败!");
                }
                print_r($resp->toJsonString());
            }
            catch(TencentCloudSDKException $e) {
                echo $e;
            }
        }

    }

    function del()
    {

        $uid = $this->request->param('uid', 0, 'intval');

        $rs = DB::name('live')->where("uid={$uid}")->delete();
        if (!$rs) {
            $this->error("删除失败！");
        }

        $this->success("删除成功！", url("liveing/index"));

    }

    function teidandel()
    {

        $id = $this->request->param('id', 0, 'intval');

        $rs = DB::name('live_teidan')->where("id={$id}")->delete();
        if (!$rs) {
            $this->error("删除失败！");
        }

		//推单消息通知前端
		$one = DB::name('live_teidan')->where("id={$id}")->find();
		sendDataToChatServer([
			'secretKey' => config('database.socketSecretKey'),
			'type' => 'sendTeidanMessage',
			'msg' => [
				'action' => 'delete',
				'id' => $id,
				'liveuid' => $one['liveuid']
			]
		]);
			
        $this->success("删除成功！", url("liveing/teidanmgt"));

    }
	
    function add()
    {

        $this->assign("liveclass", $this->getLiveClass());
		$this->assign("kefulist", $this->getKefuList());
        $this->assign("type", $this->getTypes());

        return $this->fetch();
    }

    function addPost()
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();

            if (checkSensitiveWords($data['title'])) $this->error("直播标题不能包含违禁词！");

            $nowtime = time();
            $uid = $data['uid'];

            $userinfo = DB::name('user')->field("ishot,isrecommend")->where(["id" => $uid])->find();
            if (!$userinfo) {
                $this->error('用户不存在');
            }

            $liveinfo = DB::name('live')->field('uid,islive')->where(["uid" => $uid])->find();
            if ($liveinfo['islive'] == 1) {
                $this->error('该用户正在直播');
            }

            $pull = urldecode($data['pull']);
            $type = $data['type'];
            $type_val = $data['type_val'];
            $anyway = $data['anyway'];
            $liveclassid = $data['liveclassid'];
			$kefu_id = $data['kefu_id']?$data['kefu_id']:0;
            $title = $data['title'];
//            $stream=$uid.'_'.$nowtime;
            $stream = explode("/", $pull);
            $stream = $stream[count($stream) - 1];
            $stream = explode(".", $stream);
            $stream = $stream[0] ?? '';
            $thumb = $data['thumb'];
            $data2 = array(
                "uid" => $uid,
                "ishot" => $userinfo['ishot'],
                "isrecommend" => $userinfo['isrecommend'],
                "showid" => $nowtime,
                "starttime" => $nowtime,
                "title" => $title,
                "province" => '',
                "city" => '好像在火星',
                "stream" => $stream,
                "thumb" => $thumb,
                "pull" => $pull,
                "third_pull" => $pull,
                "lng" => '',
                "lat" => '',
                "type" => $type,
                "type_val" => $type_val,
                "isvideo" => 1,
                "islive" => 1,
                "anyway" => $anyway,
				"kefu_id" => $kefu_id,
                "liveclassid" => $liveclassid,
                "is_manual_close" => $data['is_manual_close'],
            );

            if ($liveinfo) {
                $rs = DB::name('live')->update($data2);
            } else {
                $rs = DB::name('live')->insertGetId($data2);
            }

			//初始化统计
			$score = '001';
			$ip = get_client_ip();
			$GLOBALS['redisdb']->zAdd('user_' . $stream, $score, $ip);
			$GLOBALS['redisdb']->zAdd('userpc_' . $stream, $score, $ip);
			$GLOBALS['redisdb']->set("{$uid}_is_fold_off", 2);
			
			//删除该主播的上一场直播的推单
			DB::name('live_teidan')->where(["liveuid" => $uid])->delete();
			
            if ($rs === false) {
                $this->error("添加失败！");
            }

            $this->success("添加成功！");

        }
    }

	
    function edit()
    {
        $uid = $this->request->param('uid', 0, 'intval');

        $data = Db::name('live')
            ->where("uid={$uid}")
            ->find();
        if (!$data) {
            $this->error("信息错误");
        }

        $this->assign('data', $data);

        $this->assign("liveclass", $this->getLiveClass());
		$this->assign("kefulist", $this->getKefuList());
        $this->assign("type", $this->getTypes());

        return $this->fetch();


    }

    function editPost()
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();

            if (checkSensitiveWords($data['title'])) $this->error("直播标题不能包含违禁词！");

            $data['pull'] = urldecode($data['pull']);
            $data['third_pull'] = urldecode($data['pull']);

            $rs = DB::name('live')->update($data);
            if ($rs === false) {
                $this->error("修改失败！");
            }

            $this->success("修改成功！");
        }
    }

    //排序
    public function listOrder()
    {

        $model = DB::name('live');
        $modelName = '';
        if (is_object($model)) {
            $modelName = $model->getName();
        } else {
            $modelName = $model;
        }

        $pk = Db::name($modelName)->getPk(); //获取主键名称
        $ids = $this->request->post("recom_sorts/a");

        if (!empty($ids)) {
            foreach ($ids as $key => $r) {
                $data['recom_sort'] = $r;
                $data['isrecommend'] = 0;
                if ($r > 0) {
                    $data['isrecommend'] = 1;
                }
                Db::name($modelName)->where($pk, $key)->update($data);
            }
        }

        $this->success("排序更新成功！");
    }

    /**
     * 关闭聊天室
     */
    public function closeChat()
    {
        $uid = $this->request->param('uid', 0, 'intval');
        //推送消息通知前端
        sendDataToChatServer([
            'secretKey' => config('database.socketSecretKey'),
            'type' => 'adminCloseChat',
            'msg' => [
                'liveuid' => $uid,
            ]
        ]);
        $GLOBALS['redisdb']->set("{$uid}_is_chat_off", 1);
        DB::name('live')->where(['uid' => $uid])->update(['is_chat_off' => 1]);
        $this->success("关闭成功！", url("liveing/index"));
    }

    /**
     * 开启聊天室
     */
    public function openChat()
    {
        $uid = $this->request->param('uid', 0, 'intval');
        //推送消息通知前端
        sendDataToChatServer([
            'secretKey' => config('database.socketSecretKey'),
            'type' => 'adminOpenChat',
            'msg' => [
                'liveuid' => $uid,
            ]
        ]);
        $GLOBALS['redisdb']->set("{$uid}_is_chat_off", 0);
        DB::name('live')->where(['uid' => $uid])->update(['is_chat_off' => 0]);
        $this->success("开启成功！", url("liveing/index"));
    }

    protected function getLiveList()
    {
		
		$livelist = DB::name('live')->field("uid,title")->where('1=1')->select()->toArray();
		foreach($livelist as $key=>$val){
			$userinfo = getUserInfo($val['uid']);
			$livelist[$key]['user_nicename'] = $userinfo['user_nicename'];
		}
		return $livelist;
    }
	
    protected function getTeidanTypes($k = '')
    {
        $tdtype = [
            '1' => '大小球',
			'2' => '让分胜负',
			'3' => '足球角球',
			'4' => '足球比分',
			'5' => '篮球单节',
			'6' => '篮球单队大小',
			'7' => '篮球大小分',
			
        ];

        if ($k == '') {
            return $tdtype;
        }
        return $tdtype[$k];
    }
	
}
