<?php
namespace app\admin\controller;

class VarcharMatchController extends BaseController
{
    private $_match_class = array(1 => '足球', 2 => '篮球', 3 => '电竞', 4 => '其他');

    public function initialize()
    {
        parent::initialize();

        $this->model = model('VarcharMatch');
    }

    public function index()
    {
        $map = array();
        $map = $this->_search_map($map);
        $this->_list($this->model, $map);
        return $this->fetch('', ['match_class' => $this->_match_class]);
    }

    private function _search_map($map)
    {
        $homeTeam = input('home_team');
        $awayTeam = input('away_team');
        $type = input('type', 0, 'intval');
        $type && $map[] = ['type', '=', $type];
        $homeTeam && $map[] = ['home_team', '=', $homeTeam];
        $awayTeam && $map[] = ['away_team', '=', $awayTeam];
        return $map;
    }

    public function batchAdd()
    {
        if (request()->isPost()) {
            $posts = input('post.data');
            $list = [];
			$i = 0;
            foreach ($posts as $key => $val) {
				$i++;
				$type = intval($val['type'])?intval($val['type']):0;
				$start_time = trim($val['start_time'])?trim($val['start_time']):'';
				$end_time = trim($val['end_time'])?trim($val['end_time']):'';
				$view_url = trim($val['view_url'])?trim($val['view_url']):'';

				if(!$type){
					$this->error("第{$i}行请选择类型！");
				}
				if(!$view_url){
					$this->error("第{$i}行请输入直播地址！");
				}
				if(!$start_time){
					$this->error("第{$i}行请选择比赛时间！");
				}
				
				$start_time = strtotime($start_time);
				
				//判断结束时间
				if($end_time){
					$end_time = strtotime($end_time);
					if($end_time <= $start_time){
						$this->error("第{$i}行比赛结束时间不能小于开始时间！");
					}					
				}else{
					$end_time = $start_time + 150*60;
				}
				
				$val['start_time'] = $start_time;
				$val['end_time'] = $end_time;
				
                $list[$key] = $val;				
            }

            if (! $this->model->insertAll($list)) {
                $this->error('添加失败，请联系技术');
            }
            $this->success('添加成功', 'index');
        }
        return $this->fetch('', ['match_class' => $this->_match_class]);
    }

    //排序
    public function listOrder()
    {
        parent::listOrders($this->model, 'sort');

        $this->success("排序更新成功！");
    }

    public function add()
    {
        if (request()->isPost()) {
            $posts = input('post.');
            $validate = model('VarcharMatch', 'validate');
            if (! $validate->check($posts)) {
                $this->error($validate->getError());
            }
            if (! $this->model->save($posts)) {
                $this->error('添加失败，请联系技术');
            }
            $this->success('添加成功', 'index');
        }
        return $this->fetch('', ['match_class' => $this->_match_class]);
    }

    public function edit()
    {
        $id = input('id', 0, 'intval');
        if (request()->isPost()) {
            $posts = input('post.');
            $validate = model('VarcharMatch', 'validate');
            if (! $validate->check($posts)) {
                $this->error($validate->getError());
            }
            if (! $this->model->save($posts, ['id' => $id])) {
                $this->error('编辑失败，请联系技术');
            }
            $this->success('编辑成功', 'index');
        }
        $data = $this->model->getInfoById($id);
        return $this->fetch('add', ['data' => $data, 'match_class' => $this->_match_class]);
    }

    public function delete()
    {
        $id = input("id", 0, 'intval');
        if (! $this->model->destroy($id)) {
            $this->error('抱歉，删除失败"');
        }
        $this->success("恭喜您，删除成功");
    }
}