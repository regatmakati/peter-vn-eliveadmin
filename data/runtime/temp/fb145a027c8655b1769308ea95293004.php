<?php /*a:2:{s:69:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/red/index.html";i:1654305682;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
			<li class="active"><a >红包列表</a></li>
		</ul>
		
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Red/index'); ?>">

			会员： 
            <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
                   placeholder="请输入会员ID、靓号">
			<input type="submit" class="btn btn-primary" value="搜索">
		</form>		
		<form method="post" class="js-ajax-form" >

			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>编号</th>
						<th>发送者（ID）</th>
						<th>红包类型</th>
						<th>发放类型</th>
						<th>已抢/总金额</th>
						<th>已抢/总个数</th>
						<th>描述</th>
						<th>生效时间</th>
						<th>添加时间</th>
						<th><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['id']; ?></td>					
						<td><?php echo $vo['userinfo']['user_nicename']; ?> (<?php echo $vo['uid']; ?>) </td>
						<td><?php echo $type[$vo['type']]; ?>  </td>
						<td><?php echo $type_grant[$vo['type_grant']]; ?></td>
						<td><?php echo $vo['coin_rob']; ?>/<?php echo $vo['coin']; ?></td>
						<td><?php echo $vo['nums_rob']; ?>/<?php echo $vo['nums']; ?></td>
						<td><?php echo $vo['des']; ?></td>
						<td><?php echo date('Y-m-d H:i',$vo['effecttime']); ?></td>
						<td><?php echo date('Y-m-d H:i',$vo['addtime']); ?></td>
						<td>	
                            <a class="btn btn-xs btn-primary" href='<?php echo url("Red/index2",array("redid"=>$vo["id"])); ?>'>领取记录</a>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo $page; ?></div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>