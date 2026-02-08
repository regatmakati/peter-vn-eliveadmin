<?php /*a:2:{s:75:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/impression/edit.html";i:1654305673;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>

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
			<li ><a href="<?php echo url('Impression/index'); ?>">列表</a></li>
			<li class="active"><a ><?php echo lang('EDIT'); ?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Impression/editPost'); ?>">
            
            <div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>名称</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-name" name="name" value="<?php echo $data['name']; ?>">
				</div>
			</div>
            
            
            <div class="form-group">
				<label for="input-colour" class="col-sm-2 control-label"><span class="form-required">*</span>首色</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control js-color" name="colour" style="display:inline-block;width:200px;" value="<?php echo $data['colour']; ?>"> 
                    <input  class="form-control colour_block" style="display:inline-block;width:50px;background:<?php echo $data['colour']; ?>;" disabled/>内容为6位颜色16进制色码，点击可选择
				</div>
			</div>
            <div class="form-group">
				<label for="input-colour2" class="col-sm-2 control-label"><span class="form-required">*</span>尾色</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control js-color" name="colour2" style="display:inline-block;width:200px;" value="<?php echo $data['colour2']; ?>"> 
                    <input  class="form-control colour_block" style="display:inline-block;width:50px;background:<?php echo $data['colour2']; ?>;" disabled/>内容为6位颜色16进制色码，点击可选择
				</div>
			</div>
            


            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
    <script>
        (function(){
            Wind.use('colorpicker',function(){
                $('.js-color').each(function () {
                    var $this=$(this);
                    $this.ColorPicker({
                        livePreview:true,
                        onChange: function(hsb, hex, rgb) {
                            $this.val('#'+hex);
                            $this.siblings(".colour_block").css('background','#'+hex);
                        },
                        onBeforeShow: function () {
                            $(this).ColorPickerSetColor(this.value);
                        }
                    });
                });

            });
        })()
    </script>
    <script>
        
      </script>
</body>
</html>