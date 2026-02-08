<?php /*a:2:{s:74:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/match/lol_list.html";i:1654305678;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta name="referrer" content="origin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo app('request')->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container:'body',
                html:true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('Match/lolList'); ?>">英雄联盟</a></li>
			<li><a href="<?php echo url('Match/csList'); ?>">CS</a></li>
			<li><a href="<?php echo url('Match/footballList'); ?>">足球比赛</a></li>
			<li><a href="<?php echo url('Match/basketballList'); ?>">蓝球比赛</a></li>			
		</ul>
		
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Match/lolList'); ?>">
			战队名称：
            <input class="form-control" type="text" name="t_name" style="width: 200px;" value="<?php echo input('request.t_name'); ?>"
                   placeholder="请输入战队名称">
			赛事名称：
			<input class="form-control" type="text" name="ename" style="width: 200px;" value="<?php echo input('request.ename'); ?>"
				   placeholder="请输入赛事名称">
			比赛状态：
			<select class="form-control" name="status">
				<option value="">全部</option>
				<option value="0" <?php if(input('request.status') != '' && input('request.status') == 0): ?>selected<?php endif; ?>>未开始</option>
				<option value="1" <?php if(input('request.status') != '' && input('request.status') == 1): ?>selected<?php endif; ?>>进行中</option>
				<option value="2" <?php if(input('request.status') != '' && input('request.status') == 2): ?>selected<?php endif; ?>>已结束</option>
				<option value="3" <?php if(input('request.status') != '' && input('request.status') == 3): ?>selected<?php endif; ?>>已延期</option>
				<option value="4" <?php if(input('request.status') != '' && input('request.status') == 4): ?>selected<?php endif; ?>>已删除</option>
			</select>
			<input type="submit" class="btn btn-primary" style="margin-left: 10px;" value="查询">
		</form>		
		<form method="post" class="js-ajax-form" >
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>所属游戏</th>
						<th>赛事名称</th>
						<th>A战队</th>
						<th>B战队</th>
						<th>比赛状态</th>
						<th>联赛开始时间</th>
						<th>联赛结束时间</th>
						<th>总人数</th>
						<th>直播流</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td>英雄联盟</td>
						<td><?php echo $vo['ename']; ?> </td>
						<td><img style="max-width: 40px;max-height: 40px;" src="<?php echo $vo['ta_logo']; ?>" alt="">&nbsp;&nbsp;<?php echo $vo['ta_name']; ?></td>
						<td><img style="max-width: 40px;max-height: 40px;" src="<?php echo $vo['tb_logo']; ?>" alt="">&nbsp;&nbsp;<?php echo $vo['tb_name']; ?></td>
						<td>
							<?php if($vo['status'] == 0): ?> 未开始
							<?php elseif($vo['status'] == 1): ?>进行中
							<?php elseif($vo['status'] == 2): ?>已结束
							<?php elseif($vo['status'] == 3): ?>已延期
							<?php elseif($vo['status'] == 4): ?>已删除
							<?php endif; ?>
						</td>
						<td><?php echo date('Y-m-d H:i:s',$vo['start_time']); ?></td>
						<td><?php echo date('Y-m-d H:i:s',$vo['end_time']); ?></td>
						<td><?php echo getAllPeople($vo['team_a_id'],$vo['team_b_id']); ?></td>
						<td>
							<a class="btn btn-xs btn-info liveurl" data-id="<?php echo $vo['match_id']; ?>">直播链接</a>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo $page; ?></div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
	<script type="text/javascript">

		$(function(){
			Wind.use('layer');

			$('.liveurl').click(function(){
				var _this=$(this);
				var id=_this.data('id');

				var lives = layer.open({
					type: 2,
					title: '直播流',
					shade: 0.5,
					area: ['500px', '490px'],
					content: '/admin/Match/liveUrl?tb=lol_match_live&match_id='+id,
					closeBtn: 1, //不显示关闭按钮
					btn: ['关闭']
				});
				layer.full(lives);

			});

		})
	</script>
</body>
</html>