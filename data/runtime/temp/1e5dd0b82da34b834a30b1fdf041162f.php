<?php /*a:2:{s:72:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/contract/add.html";i:1654305670;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
			<li class="active"><a ><?php echo lang('ADD'); ?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('contract/addPost'); ?>">

            <div class="form-group" style="display: none">
				<label for="input-uid" class="col-sm-2 control-label"><span class="form-required">*</span>用户ID</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-uid" name="uid" value="<?php echo (isset($uid) && ($uid !== '')?$uid:''); ?>">
				</div>
			</div>
<!--            <div class="form-group">-->
<!--				<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>类型</label>-->
<!--				<div class="col-md-6 col-sm-10">-->
<!--					<select class="form-control" name="type">-->
<!--						<?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
<!--							<option value="<?php echo $key; ?>" ><?php echo $v; ?></option>-->
<!--						<?php endforeach; endif; else: echo "" ;endif; ?>-->
<!--					</select>-->
<!--				</div>-->
<!--			</div>-->
			<div class="form-group">
				<label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>QQ</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-contract" name="qq[]" value="<?php echo (isset($qq[0]['contract']) && ($qq[0]['contract'] !== '')?$qq[0]['contract']:''); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>显示状态</label>
				<div class="col-md-6 col-sm-10">
					<?php if(isset($qq[0])): ?>
						<label>
							<input type="radio" name="status[0]" value="0" <?php if($qq[0]['status'] == '0'): ?>checked<?php endif; ?> >隐藏全部</label>
						<label>
							<input type="radio" name="status[0]" value="1" <?php if($qq[0]['status'] == '1'): ?>checked<?php endif; ?> >显示全部</label>
						<label>
							<input type="radio" name="status[0]" value="2" <?php if($qq[0]['status'] == '2'): ?>checked<?php endif; ?> >显示复制按钮</label>

						<?php else: ?>
						<label>
							<input type="radio" name="status[0]" value="0" checked >隐藏全部</label>
						<label>
							<input type="radio" name="status[0]" value="1" >显示全部</label>
						<label>
							<input type="radio" name="status[0]" value="2" >显示复制按钮</label>
					<?php endif; ?>

				</div>
			</div>
            <div class="form-group">
                <label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>QQ</label>
                <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="input-contract" name="qq[]"  value="<?php echo (isset($qq[1]['contract']) && ($qq[1]['contract'] !== '')?$qq[1]['contract']:''); ?>">
                </div>
            </div>
			<div class="form-group">
				<label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>显示状态</label>
				<div class="col-md-6 col-sm-10">
					<label>
					<?php if(isset($qq[1])): ?>
						<input type="radio" name="status[1]" value="0" <?php if($qq[1]['status'] == '0'): ?>checked<?php endif; ?>  >隐藏全部</label>
					<label>
						<input type="radio" name="status[1]" value="1" <?php if($qq[1]['status'] == '1'): ?>checked<?php endif; ?> >显示全部</label>
					<label>
						<input type="radio" name="status[1]" value="2" <?php if($qq[1]['status'] == '2'): ?>checked<?php endif; ?> >显示复制按钮</label>
					<?php else: ?>
					<label>
						<input type="radio" name="status[1]" value="0" checked >隐藏全部</label>
					<label>
						<input type="radio" name="status[1]" value="1" >显示全部</label>
					<label>
						<input type="radio" name="status[1]" value="2" >显示复制按钮</label>
					<?php endif; ?>
				</div>
			</div>
            <div class="form-group">
                <label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>微信</label>
                <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="input-contract" name="wechat[]"  value="<?php echo (isset($wechat[0]['contract']) && ($wechat[0]['contract'] !== '')?$wechat[0]['contract']:''); ?>">
                </div>
            </div>
			<div class="form-group">
				<label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>显示状态</label>
				<div class="col-md-6 col-sm-10">
					<?php if(isset($wechat[0])): ?>
					<label>
						<input type="radio" name="wechatStatus[0]" value="0" <?php if($wechat[0]['status'] == '0'): ?>checked<?php endif; ?>  >隐藏全部</label>
					<label>
						<input type="radio" name="wechatStatus[0]" value="1" <?php if($wechat[0]['status'] == '1'): ?>checked<?php endif; ?> >显示全部</label>
					<label>
						<input type="radio" name="wechatStatus[0]" value="2" <?php if($wechat[0]['status'] == '2'): ?>checked<?php endif; ?> >显示复制按钮</label>
					<?php else: ?>
					<label>
						<input type="radio" name="wechatStatus[0]" value="0" checked >隐藏全部</label>
					<label>
						<input type="radio" name="wechatStatus[0]" value="1"  >显示全部</label>
					<label>
						<input type="radio" name="wechatStatus[0]" value="2"  >显示复制按钮</label>
					<?php endif; ?>
				</div>
			</div>
            <div class="form-group">
                <label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>微信</label>
                <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="input-contract" name="wechat[]"  value="<?php echo (isset($wechat[1]['contract']) && ($wechat[1]['contract'] !== '')?$wechat[1]['contract']:''); ?>">
                </div>
            </div>
			<div class="form-group">
				<label for="input-reason" class="col-sm-2 control-label"><span class="form-required"></span>显示状态</label>
				<div class="col-md-6 col-sm-10">
					<?php if(isset($wechat[1])): ?>
					<label>
						<input type="radio" name="wechatStatus[1]" value="0" <?php if($wechat[1]['status'] == '0'): ?>checked<?php endif; ?>  >隐藏全部</label>
					<label>
						<input type="radio" name="wechatStatus[1]" value="1" <?php if($wechat[1]['status'] == '1'): ?>checked<?php endif; ?> >显示全部</label>
					<label>
						<input type="radio" name="wechatStatus[1]" value="2" <?php if($wechat[1]['status'] == '2'): ?>checked<?php endif; ?> >显示复制按钮</label>
					<?php else: ?>
					<label>
						<input type="radio" name="wechatStatus[1]" value="0" checked >隐藏全部</label>
					<label>
						<input type="radio" name="wechatStatus[1]" value="1"  >显示全部</label>
					<label>
						<input type="radio" name="wechatStatus[1]" value="2"  >显示复制按钮</label>
					<?php endif; ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
					<a class="btn btn-default" href="<?php echo url('liveing/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
            
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
    <script>
	(function(){
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