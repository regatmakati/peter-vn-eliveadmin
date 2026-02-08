<?php /*a:2:{s:76:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/turntable/index3.html";i:1768747116;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
			<li class="active"><a >线下奖品列表</a></li>
		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('turntable/index3'); ?>">
            状态：
			<select class="form-control" name="status">
				<option value="">全部</option>
                <option value="0" <?php if(input('request.status') != '' && input('request.status') == 0): ?>selected<?php endif; ?> >未处理</option>
                <option value="1" <?php if(input('request.status') != '' && input('request.status') == 1): ?>selected<?php endif; ?> >已处理</option>
			</select>
			会员： 
            <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
                   placeholder="请输入会员ID、靓号">
			<input type="submit" class="btn btn-primary" value="搜索">
		</form>		
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>会员 (ID)</th>
                    <th>类型</th>
                    <th>奖品</th>
                    <th>数量</th>
                    <th>中奖时间</th>
                    <th>处理时间</th>
                    <th><?php echo lang('ACTIONS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
                <tr>
                    <td><?php echo $vo['userinfo']['user_nicename']; ?> (<?php echo $vo['uid']; ?>)</td>
                    <td><?php echo $type[$vo['type']]; ?></td>
                    <td><?php echo $vo['type_val']; ?></td>
                    <td><?php echo $vo['nums']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
                    <td>
                        <?php if($vo['status'] == 0): ?>
                            未处理
                        <?php else: ?>
                            <?php echo date('Y-m-d H:i:s',$vo['uptime']); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($vo['status'] == 0): ?>
                        <a class="btn btn-xs btn-info js-ajax-dialog-btn" href="<?php echo url('turntable/setstatus',array('id'=>$vo['id'],'status'=>'1')); ?>" >标记处理</a>
                        <?php else: ?>
                        已处理
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="pagination"><?php echo $page; ?></div>

	</div>
    <script src="/static/js/admin.js"></script>
</body>
</html>