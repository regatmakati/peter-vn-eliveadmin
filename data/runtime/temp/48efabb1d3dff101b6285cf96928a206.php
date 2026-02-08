<?php /*a:2:{s:74:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/sendcode/index.html";i:1768747108;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
			<li class="active"><a >验证码列表</a></li>

		</ul>
		<form class="well form-inline margin-top-20" name="form1" method="post" action="">
            类型：
            <select class="form-control" name="type">
				<option value="">全部</option>
                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $key; ?>" <?php if(input('request.type') != '' && input('request.type') == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			提交时间：
			<input class="form-control js-bootstrap-date" name="start_time" id="start_time" autocomplete="off" value="<?php echo input('request.start_time'); ?>" aria-invalid="false" style="width: 110px;"> - 
            <input class="form-control js-bootstrap-date" name="end_time" id="end_time" autocomplete="off" value="<?php echo input('request.end_time'); ?>" aria-invalid="false" style="width: 110px;">
			关键字：
            <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
                   placeholder="请输入接收账号">
            
            <input type="button" class="btn btn-primary" value="搜索" onclick="form1.action='<?php echo url('Sendcode/index'); ?>';form1.submit();"/>
			<input type="button" class="btn btn-success" value="导出" onclick="form1.action='<?php echo url('Sendcode/export'); ?>';form1.submit();"/>
		</form>	
    	
		<form method="post" class="js-ajax-form" >
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>信息类型</th>
						<th>接收账号</th>
						<th>信息内容</th>
						<th>提交时间</th>
						<!-- <th><?php echo lang('ACTIONS'); ?></th> -->
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['id']; ?></td>
						<td><?php echo $type[$vo['type']]; ?></td>
						<td><?php echo $vo['account']; ?></td>
						<td><?php echo $vo['content']; ?></td>
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
						<!-- <td align="center">	 -->
							<!-- <a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('Sendcode/del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a> -->
						<!-- </td> -->
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