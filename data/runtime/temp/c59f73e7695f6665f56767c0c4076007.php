<?php /*a:2:{s:70:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/notice/add.html";i:1769263234;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
<style type="text/css">
	.pic-list li {
		margin-bottom: 5px;
	}
</style>
</head>
<body>
<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li><a href="<?php echo url('Notice/index'); ?>">资讯文章列表</a></li>
		<li class="active"><a >添加</a></li>
	</ul>
	<form action="<?php echo url('Notice/addPost'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">
		<div class="row">
			<div class="col-md-9">
				<table class="table table-bordered">
					<tbody>

					<tr>
						<th width="100">标题<span class="form-required">*</span></th>
						<td>
							<input class="form-control" type="text"  name="title" required placeholder="请输入标题"/>
						</td>
					</tr>
					<tr>
						<th width="100">类型</th>
						<td>
							<select name="type" class="form-control">
								<option value="0">公告</option>
								<option value="17">导航栏</option>
								<option value="1">世界杯</option>	
								<option value="2">欧冠</option>	
								<option value="3">英超</option>	
								<option value="4">意甲</option>	
								<option value="5">西甲</option>	
								<option value="6">法甲</option>	
								<option value="7">德甲</option>	
								<option value="8">中超</option>	
								<option value="9">日职联</option>	
								<option value="10">各国杯赛</option>	
								<option value="11">其他联赛</option>	
								<option value="12">其他国际赛事</option>	
								<option value="13">NBA</option>	
								<option value="14">CBA</option>	
								<option value="15">世锦赛</option>	
								<option value="16">其他国家联赛</option>	
							</select>
						</td>
					</tr>
					<tr>
						<th width="100">缩略图<span class="form-required">*</span></th>
						<td>
							<input class="form-control" type="text"  name="thumb" value="" required placeholder="请输入缩略图外链地址"/>
						</td>
					</tr>					
					<tr>
						<th>内容</th>
						<td style="min-height: 300px;">
							<script type="text/plain" id="content" name="content"></script>
						</td>
					</tr>

					<tr>
						<th width="100">是否热点</th>
						<td>
							<select name="ishot" class="form-control">
								<option value="0">否</option>
								<option value="1">是</option>						
							</select>
						</td>
					</tr>

					<tr>
						<th width="100">是否推荐</th>
						<td>
							<select name="isrecommend" class="form-control">
								<option value="0">否</option>
								<option value="1">是</option>						
							</select>
						</td>
					</tr>

					<tr>
						<th width="100">是否置顶</th>
						<td>
							<select name="istop" class="form-control">
								<option value="0">否</option>
								<option value="1">是</option>						
							</select>
						</td>
					</tr>
					
					<tr>
						<th width="100">状态<span class="form-required">*</span></th>
						<td>
							<select name="status" class="form-control">
								<option value="1">启用</option>
								<option value="0">禁用</option>
							</select>
						</td>
					</tr>

					</tbody>
				</table>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
						<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="/static/js/admin.js"></script>
<script type="text/javascript">
	//编辑器路径定义
	var editorURL = GV.WEB_ROOT;
</script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
	$(function () {

		editorcontent = new baidu.editor.ui.Editor();
		editorcontent.render('content');
		try {
			editorcontent.sync();
		} catch (err) {
		}

		$('#more-template-select').val('page');
	});
</script>
</body>
</html>
