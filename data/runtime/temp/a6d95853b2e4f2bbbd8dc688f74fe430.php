<?php /*a:2:{s:68:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/gift/add.html";i:1654305672;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
			<li ><a href="<?php echo url('Gift/index'); ?>">礼物列表</a></li>
			<li class="active"><a ><?php echo lang('ADD'); ?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Gift/addPost'); ?>">

            <div class="form-group">
				<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>类型</label>
				<div class="col-md-6 col-sm-10" id="type">
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<label class="radio-inline"><input type="radio" name="type" value="<?php echo $key; ?>" <?php if($i == 1): ?>checked<?php endif; ?>><?php echo $v; ?></label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-mark" class="col-sm-2 control-label"><span class="form-required">*</span>标识</label>
				<div class="col-md-6 col-sm-10" id="mark" style="position: relative;">
                    <?php if(is_array($mark) || $mark instanceof \think\Collection || $mark instanceof \think\Paginator): $i = 0; $__LIST__ = $mark;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<label class="radio-inline" for="mark_<?php echo $key; ?>"><input type="radio" name="mark" value="<?php echo $key; ?>" id="mark_<?php echo $key; ?>" <?php if($i == 1): ?>checked<?php endif; ?>><?php echo $v; ?></label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div id="tips" style="position: absolute;left: 450px;top: 0;display:none;">
                        <span style="color:#ff0000">幸运礼物说明</span><br>
                        1.用户送出去幸运礼物时，幸运礼物的价值将分成三份，分别为主播、奖池和平台，后台可以设置主播和奖池获得的比例，剩下的归属于平台，主播和奖池的比例不要超过100%【谨记】<br>
                        2.后台可设置某个礼物为幸运礼物<br>
                        3.成为幸运礼物后，可设置幸运礼物的的中奖设置以及奖池设置，以下是幸运礼物和奖池说明<br>
                            a)在中奖设置中可设置每个礼物每组每个倍数的中奖概率【如：小黄瓜 每组送10个中10倍的概率为 5%，小黄瓜 每组送100个中10倍的概率为 <br>6%】，当用户中奖后，返还的奖励以当组礼物总价值为基数返还【如送了一组10个的，总价值为100，中了10倍，那么会获得1000钻石】<br>
                            b)奖池说明：奖池分为三个阶段，后台可设置每个奖池的金额下限，直接当奖池里边的金额达到最低的金额限制时，奖池才会开启，当有用户中奖时，会赢走奖池内的所有奖金<br>
                            c)幸运礼物与奖池说明：后台可设置每个幸运礼物每个组数相对于奖池每个阶段的中奖概率【如：小黄瓜每组10个对于奖池1阶段的中奖概率为0.01%，】，建议设置：礼物价值越高中奖概率越高，每组数量越多中奖概率越大<br>
                    </div>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-giftname" class="col-sm-2 control-label"><span class="form-required">*</span>名称</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-giftname" name="giftname" style="width:300px;">
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-needcoin" class="col-sm-2 control-label"><span class="form-required">*</span>价格</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-needcoin" name="needcoin" style="width:300px;">
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span>图片</label>
				<div class="col-md-6 col-sm-10">
					<input type="hidden" name="gifticon" id="thumbnail" value="">
                    <a href="javascript:uploadOneImage('图片上传','#thumbnail','','gift');">
                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                 id="thumbnail-preview"
                                 style="cursor: pointer;max-width:100px;max-height:100px;"/>
                    </a>
                    <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片"> 
                    <p class="help-block">建议尺寸： 50 X 50 太大会造成加载图片加载慢等各种问题</p>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-swftype" class="col-sm-2 control-label"><span class="form-required">*</span>动画类型</label>
				<div class="col-md-6 col-sm-10" id="swftype">
                    <?php if(is_array($swftype) || $swftype instanceof \think\Collection || $swftype instanceof \think\Paginator): $i = 0; $__LIST__ = $swftype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<label class="radio-inline"><input type="radio" name="swftype" value="<?php echo $key; ?>" <?php if($i == 1): ?>checked<?php endif; ?>><?php echo $v; ?></label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
            
            <div class="form-group" id="">
				<label for="input-gif" class="col-sm-2 control-label">GIF图片</label>
				<div class="col-md-6 col-sm-10">
                    <div id="swftype_bd_0">
                        <input type="hidden" name="gif" id="thumbnail2" value="">
                        <a href="javascript:uploadOneImage('图片上传','#thumbnail2','','gift');">
                            <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                     id="thumbnail2-preview"
                                     style="cursor: pointer;max-width:100px;max-height:100px;"/>
                        </a>
                        <input type="button" class="btn btn-sm btn-cancel-thumbnail2" value="取消图片"> 
                        <p class="help-block">建议尺寸： 200 X 200</p>
                    </div>
                    <div id="swftype_bd_1" style="display:none;">
                        <input class="form-control" id="js-file-input" type="text" name="svga" value="" style="width: 300px;display: inline-block;" title="文件名称">
                        <a href="javascript:uploadOne('文件上传','#js-file-input','file');">上传SVGA文件</a>
                    </div>
                    
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-swftime" class="col-sm-2 control-label">动画时长</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-swftime" name="swftime" value="0" style="width:300px;">
                    <p class="help-block">秒 精度：小数点后两位</p>
				</div>
			</div>
            
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
            
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
    <script>
        (function(){
            $('.btn-cancel-thumbnail').click(function () {
                $('#thumbnail-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
                $('#thumbnail').val('');
            });
            
            $('.btn-cancel-thumbnail2').click(function () {
                $('#thumbnail2-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
                $('#thumbnail2').val('');
            });
            
            $("#type label input").on('click',function(){
                var v=$(this).val();
                if(v==0){
                    $("#mark_3").removeAttr('disabled')
                }else{
                    //if($("#mark_3").attr("checked")){
                    if($('#mark label input:checked').val()==3){
                        //$("#mark_0").removeAttr('checked');
                        $("#mark_0").attr('checked','checked');
                        $("#tips").hide();
                    }
                    $("#mark_3").attr('disabled','disabled');
                }
            })
            
            $("#mark label input").on('change',function(){
                var v=$(this).val();
                if(v==3){
                    $("#tips").show();
                }else{
                    $("#tips").hide();
                }
            })
            
            $("#swftype label").on('click',function(){
                var v=$("input",this).val();
                var b=$("#swftype_bd_"+v);
                b.siblings().hide();
                b.show();
            })
        })()
    </script>
</body>
</html>