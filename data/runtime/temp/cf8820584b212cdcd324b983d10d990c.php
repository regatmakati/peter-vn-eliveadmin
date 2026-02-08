<?php /*a:2:{s:72:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/notice/index.html";i:1769263234;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
			<li class="active"><a >资讯文章列表</a></li>
			<li ><a href="<?php echo url('Notice/add'); ?>">添加</a></li>

		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Notice/index'); ?>">
			是否热点：
            <select class="form-control" name="ishot">
                <option value="0" <?php if(input('request.ishot') == '0'): ?>selected<?php endif; ?>>否</option>
				<option value="1" <?php if(input('request.ishot') == '1'): ?>selected<?php endif; ?>>是</option>
			</select>		

			是否推荐：
            <select class="form-control" name="isrecommend">
                <option value="0" <?php if(input('request.isrecommend') == '0'): ?>selected<?php endif; ?>>否</option>
				<option value="1" <?php if(input('request.isrecommend') == '1'): ?>selected<?php endif; ?>>是</option>
			</select>	

			是否置顶：
            <select class="form-control" name="istop">
                <option value="0" <?php if(input('request.istop') == '0'): ?>selected<?php endif; ?>>否</option>
				<option value="1" <?php if(input('request.istop') == '1'): ?>selected<?php endif; ?>>是</option>
			</select>	

			采集源：
            <select class="form-control" name="source">
			    <option value="0" <?php if(input('request.source') == '0'): ?>selected<?php endif; ?>>--请选择--</option>
                <option value="1" <?php if(input('request.source') == '1'): ?>selected<?php endif; ?>>雷速体育</option>
				<option value="2" <?php if(input('request.source') == '2'): ?>selected<?php endif; ?>>懂球帝</option>
				<option value="3" <?php if(input('request.source') == '3'): ?>selected<?php endif; ?>>腾讯体育</option>
			</select>
			
			<input type="submit" class="btn btn-primary" value="查询">
		</form>	    	
		<form method="post" class="js-ajax-form" >
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>标题</th>
						<th>分类</th>
						<th>缩略图</th>
						<th>热点</th>
						<th>推荐</th>
						<th>置顶</th>
						<th>浏览</th>
						<th>点赞</th>
						<th>评论</th>
						<th>发布</th>
						<th>采集源</th>
						<th>状态</th>
						<th>发布时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['title']; ?></td>
						<td><?php echo $vo['type']; ?></td>
						<!--<td><?php echo subtext(strip_tags(htmlspecialchars_decode($vo['content'])),50); ?></td>-->
						<td><img src="<?php echo $vo['thumb']; ?>" width='50px'/></td>
						<td><?php if($vo['ishot'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
						<td><?php if($vo['isrecommend'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
						<td><?php if($vo['istop'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
						<td><?php echo $vo['views']; ?></td>
						<td><?php echo $vo['likes']; ?></td>
						<td><?php echo $vo['comments']; ?></td>
						<td><?php echo $vo['author']; ?></td>
						<td><?php echo $vo['source']; ?></td>
						<td><?php if($vo['status'] == 1): ?>已发布<?php else: ?>未发布<?php endif; ?></td>
						<td><?php echo $vo['publishtime']; ?></td>
						<td>
							<a class="btn btn-xs btn-primary" href='<?php echo url("Notice/edit",array("id"=>$vo["id"])); ?>'><?php echo lang('EDIT'); ?></a>
							<a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('Notice/del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
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