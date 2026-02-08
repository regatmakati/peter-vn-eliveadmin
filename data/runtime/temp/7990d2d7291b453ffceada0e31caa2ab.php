<?php /*a:2:{s:75:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/anchorauth/edit.html";i:1654305668;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
		<li ><a href="<?php echo url('Anchorauth/index'); ?>">主播授权</a></li>
		<li class="active"><a ><?php echo lang('EDIT'); ?></a></li>
	</ul>

	<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Anchorauth/editPost'); ?>">

		<div class="form-group">
			<label for="input-uid" class="col-sm-2 control-label"><span class="form-required">*</span>用户ID</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-uid" name="uid" value="<?php echo $data['uid']; ?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>授权状态</label>
			<div class="col-md-6 col-sm-10">
				<select class="form-control" name="status">
					<option value="">请选择</option>
					<option value="1" <?php if($data['status'] == 1): ?>selected<?php endif; ?>>正常</option>
					<option value="0" <?php if($data['status'] == 0): ?>selected<?php endif; ?>>禁用</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="input-subscribenum" class="col-sm-2 control-label"><span class="form-required">*</span>默认主播订阅数</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-subscribenum" name="subscribenum" value="<?php echo $data['subscribenum']; ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label for="input-viewnum" class="col-sm-2 control-label"><span class="form-required">*</span>默认主播热度</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-viewnum" name="viewnum" value="<?php echo $data['viewnum']; ?>"/>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
				<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
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
