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
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use app\admin\model\NicknameModel;

class NicknameController extends AdminBaseController
{

    /**
     * 随机昵称管理
     * @adminMenu(
     *     'name'   => '随机昵称',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 50,
     *     'icon'   => '',
     *     'remark' => '随机昵称管理',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $data = $this->request->param();
        $map = [];
        if(isset($data['name'])){
            $map[]=['name','like','%'.$data['name'].'%'];
        }
        $nicknameModel = new NicknameModel();
        $nicknames     = $nicknameModel->where($map)->order('id DESC')->paginate(20);
        $page = $nicknames->render();
        $this->assign('page',$page);
        $this->assign('nicknames', $nicknames);

        return $this->fetch();
    }

    /**
     * 添加随机昵称
     * @adminMenu(
     *     'name'   => '添加随机昵称',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加随机昵称',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加随机昵称提交保存
     * @adminMenu(
     *     'name'   => '添加随机昵称提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加随机昵称提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data      = $this->request->param();
        $words = explode(",",$data['name']);
        foreach ($words as &$word) {
            $word = trim($word);
        }
        $words = array_unique($words);
        $nicknameModel = new NicknameModel();
        $nicknames = $nicknameModel->column('name');
        foreach ($words as $value){
            if(in_array($value, $nicknames) || empty($value)) continue;
            $nicknameModel = new NicknameModel();
            $nicknameModel->allowField(true)->save([
                'addtime'=>time(),
                'name'=>$value,
            ]);
        }
        $this->success("添加成功！", url("Nickname/index"));
    }

    /**
     * 编辑随机昵称
     * @adminMenu(
     *     'name'   => '编辑随机昵称',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑随机昵称',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function edit()
    {
        $id        = $this->request->param('id', 0, 'intval');
        $nicknameModel = new NicknameModel();
        $nickname      = $nicknameModel->get($id);
        $this->assign('nickname', $nickname);
        return $this->fetch();
    }

    /**
     * 编辑随机昵称提交保存
     * @adminMenu(
     *     'name'   => '编辑随机昵称提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑随机昵称提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data      = $this->request->param();
        $nicknameModel = new NicknameModel();
        $nicknameModel->allowField(true)->isUpdate(true)->save($data);
        $this->success("保存成功！", url("Nickname/index"));
    }

    /**
     * 删除随机昵称
     * @adminMenu(
     *     'name'   => '删除随机昵称',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除随机昵称',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        NicknameModel::destroy($id);
        $this->success("删除成功！", url("nickname/index"));
    }





}