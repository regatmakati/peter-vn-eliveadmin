<?php
namespace app\admin\controller;

use cmf\controller\AdminBaseController;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

class BaseController extends AdminbaseController
{
    /**
     * 得到分页数据
     * @param  array $where    分页条件
     * @param  int   $pageSize 总记录数
     * @return array
     */
    protected function _list($model, $where = [], $relation = null, $pageSize = 15, $order = 'id desc', $fields = null, $partition = null)
    {
        $orderBy = $order;
        $order = input('order', '');
        $sort = input('sort', '');
        $size = input('page_size', 0, 'intval');
        $pageSize = $size ? $size : $pageSize;
        if ($order && $sort) {
            $orderBy = $order . ' ' . $sort;
        }
        // 条件查找
        $M = $model->where($where)->orderRaw($orderBy);
        // 需要查找的字段
        if (isset($fields)) {
            $M = $M->field($fields);
        }
        if (! empty($partition)) {
            $M->partition($partition[0], $partition[1], $partition[2]);
        }
        if (isset($relation)) {
            $this->relation = $relation;
            $r = $M->paginate($pageSize, false)->each(function($value){
                if (! empty($this->relation)) {
                    $relation = explode(',', str_replace(' ', '', $this->relation));
                    foreach ($relation as $key => $val) {
                        $value->$val;
                    }
                }
            });
        } else {
            $r = $M->paginate($pageSize, false);
        }
        $total = $r->total();
        $lists = $r->items();
        $page  = $r->render();
        $lists = $r->toArray();
        if (! empty($lists['data'])) {
            foreach ($lists['data'] as $key => $val) {
                if ($val['data'] || $val['extend'] || $val['account']) {
                    $val['data'] && $lists['data'][$key]['data'] = unserialize($val['data']);
                    $val['extend'] && $lists['data'][$key]['extend'] = unserialize($val['extend']);
                    $val['account'] && $lists['data'][$key]['account'] = unserialize($val['account']);
                }
            }
        }
        // 分页显示
        $this->assign([
            'lists' => $lists['data'],
            'total_count' => $total,
            'page_size' => $pageSize,
            'page'      => $page,
            'v' => rand(10000,99999)
        ]);
        $this->total_count = $total;
        $this->page_size = $pageSize;
        return $lists['data'];
    }
}