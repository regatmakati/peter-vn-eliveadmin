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

class VarcharMatchModel extends Model
{
    protected $insert = ['start_time'];
    protected $update = ['start_time'];

    protected function setStartTimeAttr($time)
    {
        return strtotime($time);
    }

    public function getInfoById($id, $field = true)
    {
        $where = array(
            'id' => $id
        );
        $info = $this->where($where)
            ->field($field)
            ->findOrEmpty()
            ->toArray();
        return $info;
    }
}