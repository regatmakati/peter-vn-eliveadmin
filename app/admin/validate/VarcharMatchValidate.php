<?php
namespace app\admin\validate;

use think\Validate;

class VarcharMatchValidate extends Validate
{
    protected $rule =   [
        'type'  => 'require|gt:0',
        'view_url' => 'require'
    ];

    protected $message  =   [
        'type.require' => '类型不得为空',
        'type.gt' => '错误的类型',
        'view_url.require' => '请输入直播地址',
    ];
}
?>