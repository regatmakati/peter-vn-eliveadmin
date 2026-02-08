<?php /*a:2:{s:72:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/liveing/edit.html";i:1655428165;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>

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
			<li ><a href="<?php echo url('Liveing/index'); ?>">直播列表</a></li>
			<li class="active"><a ><?php echo lang('EDIT'); ?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Liveing/editPost'); ?>">
            <div class="form-group">
				<label for="input-uid" class="col-sm-2 control-label"><span class="form-required">*</span>用户ID</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-uid" name="uid" value="<?php echo $data['uid']; ?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label for="input-title" class="col-sm-2 control-label">直播标题</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-title" name="title" value="<?php echo $data['title']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-thumb" class="col-sm-2 control-label">直播封面</label>
				<div class="col-md-6 col-sm-10">
					<input type="hidden" name="thumb" id="thumbnail" value="<?php echo $data['thumb']; ?>">
					<a href="javascript:uploadOneImage('图片上传','#thumbnail','','live');">
						<?php if(empty($data['thumb'])): ?>
							<img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
								 id="thumbnail-preview"
								 style="cursor: pointer;max-width:100px;max-height:100px;"/>
							<?php else: ?>
							<img src="<?php echo cmf_get_image_preview_url($data['thumb']); ?>"
								 id="thumbnail-preview"
								 style="cursor: pointer;max-width:100px;max-height:100px;"/>
						<?php endif; ?>
					</a>
					<input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
				</div>
			</div>
            <div class="form-group">
				<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>直播分类</label>
				<div class="col-md-6 col-sm-10">
                    <select class="form-control" name="liveclassid">
                    	<option value="0" <?php if($data['liveclassid'] == '0'): ?>selected<?php endif; ?>>默认分类</option>
                        <?php if(is_array($liveclass) || $liveclass instanceof \think\Collection || $liveclass instanceof \think\Paginator): $i = 0; $__LIST__ = $liveclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>" <?php if($data['liveclassid'] > 0 and $data['liveclassid'] == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>房间类型</label>
				<div class="col-md-6 col-sm-10">
                    <select class="form-control" name="type" id="cdn">
                        <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>" <?php if($data['type'] == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</div>
			</div>

            <div class="form-group">
				<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>房间客服</label>
				<div class="col-md-6 col-sm-10">
                    <select class="form-control" name="kefu_id">
                    	<option value="0" <?php if($data['kefu_id'] == '0'): ?>selected<?php endif; ?>>--选择客服--</option>
                        <?php if(is_array($kefulist) || $kefulist instanceof \think\Collection || $kefulist instanceof \think\Paginator): $i = 0; $__LIST__ = $kefulist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>" <?php if($data['kefu_id'] > 0 and $data['kefu_id'] == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</div>
			</div>
            
            <div class="form-group" id="cdn_switch_1" <?php if($data['type'] == '0'): ?>style="display:none;"<?php endif; ?>>
				<label for="input-type_val" class="col-sm-2 control-label"><span class="form-required">*</span>密码或价格</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-type_val" name="type_val" value="<?php echo $data['type_val']; ?>">
				</div>
			</div>
            
            
            <div class="form-group">
				<label for="input-pull" class="col-sm-2 control-label"><span class="form-required">*</span>视频地址</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-pull" name="pull" value="<?php echo $data['pull']; ?>">视频格式：MP4
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-words" class="col-sm-2 control-label"><span class="form-required">*</span>视频类型</label>
				<div class="col-md-6 col-sm-10">
					<select class="form-control" name="anyway">
                        <option value="0" >竖屏</option>
                        <option value="1" <?php if($data['anyway'] == '1'): ?>selected<?php endif; ?>>横屏</option>
                    </select>
				</div>
			</div>
            
            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
    <script type="text/javascript">
    (function(){
		$('.btn-cancel-thumbnail').click(function () {
			$('#thumbnail-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
			$('#thumbnail').val('');
		});
		$("#cdn").on('change',function(){
			var v=$(this).val();
			var b=$("#cdn_switch_1");
			if(v==0){
				b.hide();
				$("#input-type_val").val('');
			}else{
				b.show();
			}
		})
	})()
    </script>
</body>
</html>