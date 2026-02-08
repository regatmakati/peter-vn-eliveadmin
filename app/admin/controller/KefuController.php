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
use app\admin\model\KefuModel;

class KefuController extends AdminBaseController
{

    /**
     * 客服管理
     * @adminMenu(
     *     'name'   => '客服',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 50,
     *     'icon'   => '',
     *     'remark' => '客服管理',
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
            $map[]=['nickname','like','%'.$data['nickname'].'%'];
        }
        $kefuModel = new KefuModel();
        $kefus     = $kefuModel->where($map)->order('id DESC')->paginate(20);
        $page = $kefus->render();
        $this->assign('page',$page);
        $this->assign('kefus', $kefus);

        return $this->fetch();
    }

    /**
     * 添加客服
     * @adminMenu(
     *     'name'   => '添加客服',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加客服',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加客服提交保存
     * @adminMenu(
     *     'name'   => '添加客服提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加客服提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data      = $this->request->param();
		$data['addtime'] = time();
        $kefuModel = new KefuModel();
		$kefuModel->allowField(true)->save($data);
        $this->success("添加成功！", url("Kefu/index"));
    }

    /**
     * 编辑客服
     * @adminMenu(
     *     'name'   => '编辑客服',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑客服',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function edit()
    {
        $id        = $this->request->param('id', 0, 'intval');
        $kefuModel = new KefuModel();
        $kefu      = $kefuModel->get($id);
        $this->assign('kefu', $kefu);
        return $this->fetch();
    }

    /**
     * 编辑客服提交保存
     * @adminMenu(
     *     'name'   => '编辑客服提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑客服提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data      = $this->request->param();
        $kefuModel = new KefuModel();
        $kefuModel->allowField(true)->isUpdate(true)->save($data);
        $this->success("保存成功！", url("Kefu/index"));
    }

    /**
     * 删除客服
     * @adminMenu(
     *     'name'   => '删除客服',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除客服',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        KefuModel::destroy($id);
        $this->success("删除成功！", url("Kefu/index"));
    }





}