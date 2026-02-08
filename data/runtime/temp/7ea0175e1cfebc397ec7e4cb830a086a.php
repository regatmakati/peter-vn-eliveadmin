<?php /*a:2:{s:78:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/dynamicrepot/index.html";i:1654305670;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
			<li class="active"><a >动态举报列表</a></li>
		</ul>
        
        <form class="well form-inline margin-top-20" method="post" action="<?php echo url('dynamicrepot/index'); ?>">
            状态：
            <select class="form-control" name="status" style="width: 100px;">
                <option value=''>全部</option>
                <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $key; ?>" <?php if(input('request.status') != '' && input('request.status') == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
			类型：
			<select class="form-control" name="content" style="width: 100px;">
				<option value=''>全部</option>
				<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $v['name']; ?>" <?php if(input('request.content') != '' && input('request.content') == $v['name']): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
            提交时间：
            <input class="form-control js-bootstrap-date" name="start_time" id="start_time" value="<?php echo input('request.start_time'); ?>" aria-invalid="false" style="width: 110px;"> - 
            <input class="form-control js-bootstrap-date" name="end_time" id="end_time" value="<?php echo input('request.end_time'); ?>" aria-invalid="false" style="width: 110px;">
            举报用户ID：
            <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
                   placeholder="举报用户ID">
            被举报用户ID：
            <input class="form-control" type="text" name="touid" style="width: 200px;" value="<?php echo input('request.touid'); ?>"
                   placeholder="被举报用户ID">
            动态ID：
            <input class="form-control" type="text" name="dynamicid" style="width: 200px;" value="<?php echo input('request.dynamicid'); ?>"
                   placeholder="动态ID">
            <input type="submit" class="btn btn-primary" value="搜索"/>
            <a class="btn btn-danger" href="<?php echo url('dynamicrepot/index'); ?>">清空</a>
        </form>
    
		<form method="post" class="js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>举报用户</th>
						<th>被举报用户</th>
						<th>动态ID</th>
						<th>类型</th>
						<th width="50%">内容</th>
						<th>状态</th>
						<th>提交时间</th>
						<th align="center"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['userinfo']['user_nicename']; ?> (<?php echo $vo['uid']; ?>)</td>
						<td><?php echo $vo['touserinfo']['user_nicename']; ?> (<?php echo $vo['touid']; ?>)</td>
						<td><?php echo $vo['dynamicid']; ?></td>
						<td><?php 
							echo explode(" ",$vo['content'])[0];
						 ?>
						</td>
						<td>
							<?php 
								$contentArr = explode(" ",$vo['content']);
								foreach ($contentArr as $key=>$value){
									if($key>0){
									echo $value;
								}
								}
							 ?>
						</td>
						<td><?php echo $status[$vo['status']]; ?></td>
                        <td><?php echo date('Y-m-d H:i',$vo['addtime']); ?></td>
						<td>
                            <?php if($vo['status'] == 0): ?>
                                <a class="btn btn-xs btn-success setstatus js-ajax-dialog-btn" href="<?php echo url('dynamicrepot/setstatus',array('id'=>$vo['id'],'status'=>1)); ?>">标记处理</a>
                            <?php endif; ?>
                            
                            <a class="btn btn-xs btn-warning view" data-id="<?php echo $vo['dynamicid']; ?>">查看动态</a>
                            
                            <?php if($vo['isdel'] == 1): ?>
                                <a class="btn btn-xs btn-warning " data-id="<?php echo $vo['dynamicid']; ?>">已下架</a>
                                
                            <?php else: ?>
                                <a class="btn btn-xs btn-warning xiajia" data-id="<?php echo $vo['dynamicid']; ?>">下架动态</a>
                            <?php endif; ?>
                            <a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('dynamicrepot/del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo $page; ?></div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
    <script>
    (function(){
        Wind.use('layer');
        $('.xiajia').click(function(){
            var _this=$(this);
            var id=_this.data('id');
            
            layer.prompt({
                formType: 2,
                title: '请输入下架原因',
                value: '',
                area: ['800px', '100px'] //自定义文本域宽高
            }, function(value, index, elem){
                $.ajax({
                    url:'<?php echo url('Dynamic/setDel'); ?>',
                    type:'POST',
                    data:{id:id,isdel:1,reason:value},
                    dataType:'json',
                    success:function(data){
                        var code=data.code;
                        if(code==0){
                            layer.msg(data.msg);
                            return !1;
                        }
                        layer.msg(data.msg,{},function(){
                            layer.closeAll();
                            reloadPage(window);
                        });
                        
                    },
                    error:function(){
                        layer.msg('操作失败，请重试')
                    }
                });
                
            });
            
        })
        
        $('.view').click(function(){
            var _this=$(this);
            var id=_this.data('id');

            layer.open({
                type: 2,
                title: '查看',
                shadeClose: true,
                shade: 0.8,
                area: ['500px', '100%'],
                content: '/admin/Dynamic/see?id='+id
            }); 
            
        });
    })()
    </script>
</body>
</html>