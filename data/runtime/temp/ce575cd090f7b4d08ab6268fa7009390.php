<?php /*a:2:{s:74:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/musiccat/index.html";i:1654305679;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
			<li class="active"><a >音乐分类列表</a></li>
			<li><a href="<?php echo url('Musiccat/add'); ?>"><?php echo lang('ADD'); ?></a></li>
		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Musiccat/index'); ?>">
			关键字： 
            <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
                   placeholder="请输入分类名称">
			<input type="submit" class="btn btn-primary" value="搜索">
		</form>
		<form method="post" class="js-ajax-form" action="<?php echo url('Musiccat/listOrder'); ?>">
			<div class="table-actions">
                <button class="btn btn-primary  js-ajax-submit" type="submit"><?php echo lang('SORT'); ?></button>
            </div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>序号</th>
						<th>ID</th>
						<th>分类名称</th>
						<th>分类图标</th>
						<th>添加时间</th>
						<th>修改时间</th>
						<th>是否删除</th>
						<th><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td><input name="list_orders[<?php echo $vo['id']; ?>]" class="input-order" type="text" value="<?php echo $vo['list_order']; ?>"></td>
						<td><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['title']; ?></td>
						<td><img src="<?php echo $vo['img_url']; ?>" width="50px" height="50px"></td>
						<td><?php echo date('Y-m-d H:i',$vo['addtime']); ?></td>
						<td><?php if($vo['updatetime'] != '0'): ?><?php echo date('Y-m-d H:i',$vo['updatetime']); else: ?>--<?php endif; ?></td>
						<td><?php echo $isdel[$vo['isdel']]; ?></td>
						<td align="center">
                            <a class="btn btn-xs btn-primary" href='<?php echo url("Musiccat/edit",array("id"=>$vo["id"])); ?>'><?php echo lang('EDIT'); ?></a>
							<?php if($vo['isdel'] == '0'): ?>
							<a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('Musiccat/del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
							<?php else: ?>
                            <a class="btn btn-xs btn-info js-ajax-dialog-btn" href="<?php echo url('Musiccat/canceldel',array('id'=>$vo['id'])); ?>" >取消删除</a>
							<?php endif; ?>
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