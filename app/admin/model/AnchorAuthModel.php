<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;

class AnchorAuthModel extends Model
{
    CONST STATUS_ON = 1;
    CONST STATUS_OFF = 0;
    public static $statusMap = [
        self::STATUS_ON => '正常',
        self::STATUS_OFF => '金融',
    ];

    public static function setLiveOwnerCache()
    {
        $anchorAuthModel = new AnchorAuthModel();
        $liveOwners = $anchorAuthModel->where(['status' => AnchorAuthModel::STATUS_ON])->column('uid');
        if (!empty($liveOwners)) {
            $GLOBALS['redisdb']->watch('set_live_owner');
            $GLOBALS['redisdb']->multi();
            $GLOBALS['redisdb']->del('set_live_owner');
            foreach ($liveOwners as $liveOwner) {
                $GLOBALS['redisdb']->sadd('set_live_owner', $liveOwner);
            }
            $GLOBALS['redisdb']->exec();
        }
    }
}