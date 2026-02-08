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
use app\admin\model\WatermarkModel;

class WatermarkController extends AdminBaseController
{

    /**
     * 水印管理
     * @adminMenu(
     *     'name'   => '水印',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 50,
     *     'icon'   => '',
     *     'remark' => '水印管理',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {

        $watermarkModel = new WatermarkModel();
        $watermarks     = $watermarkModel->select();
        $this->assign('watermarks', $watermarks);

        return $this->fetch();
    }

    /**
     * 添加水印
     * @adminMenu(
     *     'name'   => '添加水印',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加水印',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加水印提交保存
     * @adminMenu(
     *     'name'   => '添加水印提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加水印提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data      = $this->request->param();
        $watermarkModel = new WatermarkModel();
        $result    = $this->validate($data, 'Watermark');
        if ($result !== true) {
            $this->error($result);
        }
        $watermarkModel->allowField(true)->save($data);

        $this->success("添加成功！", url("Watermark/index"));
    }

    /**
     * 编辑水印
     * @adminMenu(
     *     'name'   => '编辑水印',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑水印',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function edit()
    {
        $id        = $this->request->param('id', 0, 'intval');
        $watermarkModel = new WatermarkModel();
        $watermark      = $watermarkModel->get($id);
        $this->assign('watermark', $watermark);
        return $this->fetch();
    }

    /**
     * 编辑水印提交保存
     * @adminMenu(
     *     'name'   => '编辑水印提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑水印提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data      = $this->request->param();
        $watermarkModel = new WatermarkModel();
        $result    = $this->validate($data, 'Watermark');
        if ($result !== true) {
            $this->error($result);
        }
        $watermarkModel->allowField(true)->isUpdate(true)->save($data);

        $this->success("保存成功！", url("Watermark/index"));
    }

    /**
     * 删除水印
     * @adminMenu(
     *     'name'   => '删除水印',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除水印',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        WatermarkModel::destroy($id);
        $this->success("删除成功！", url("watermark/index"));
    }




}