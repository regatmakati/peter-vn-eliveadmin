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
use app\admin\model\AvatarModel;

class AvatarController extends AdminBaseController
{

    /**
     * 敏感词管理
     * @adminMenu(
     *     'name'   => '敏感词',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 50,
     *     'icon'   => '',
     *     'remark' => '敏感词管理',
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
        $avatarModel = new AvatarModel();
        $avatars     = $avatarModel->where($map)->order('id DESC')->paginate(20);
        $avatars->each(function($v,$k){
            $v['image']=get_upload_path($v['image']);
            return $v;
        });
        $page = $avatars->render();
        $this->assign('page',$page);
        $this->assign('avatars', $avatars);

        return $this->fetch();
    }

    /**
     * 添加敏感词
     * @adminMenu(
     *     'name'   => '添加敏感词',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加敏感词',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加敏感词提交保存
     * @adminMenu(
     *     'name'   => '添加敏感词提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加敏感词提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data      = $this->request->param();
        $data['addtime'] = time();
        $avatarModel = new AvatarModel();
        $avatarModel->allowField(true)->save($data);
        $this->success("添加成功！", url("Avatar/index"));
    }

    /**
     * 编辑敏感词
     * @adminMenu(
     *     'name'   => '编辑敏感词',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑敏感词',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function edit()
    {
        $id        = $this->request->param('id', 0, 'intval');
        $avatarModel = new AvatarModel();
        $avatar      = $avatarModel->get($id);
        $this->assign('avatar', $avatar);
        return $this->fetch();
    }

    /**
     * 编辑敏感词提交保存
     * @adminMenu(
     *     'name'   => '编辑敏感词提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑敏感词提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data      = $this->request->param();
        $data['create_time'] = time();
        $avatarModel = new AvatarModel();
        $avatarModel->allowField(true)->isUpdate(true)->save($data);
        $this->success("保存成功！", url("Avatar/index"));
    }

    /**
     * 删除敏感词
     * @adminMenu(
     *     'name'   => '删除敏感词',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除敏感词',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        AvatarModel::destroy($id);
        $this->success("删除成功！", url("avatar/index"));
    }





}