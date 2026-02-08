<?php /*a:2:{s:74:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/watermark/edit.html";i:1654305691;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
        <li><a href="<?php echo url('watermark/index'); ?>"><?php echo lang('ADMIN_WATERMARK_INDEX'); ?></a></li>
        <li><a href="<?php echo url('watermark/add'); ?>"><?php echo lang('ADMIN_WATERMARK_ADD'); ?></a></li>
        <li class="active"><a>编辑水印</a></li>
    </ul>
    <?php $position=array("1"=>"上左遮罩","2"=>"上右遮罩","3"=>"下左遮罩","4"=>"下右遮罩"); $device=array("1"=>"PC","2"=>"APP/H5"); ?>
    <form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('watermark/editPost'); ?>">
        <div class="form-group">
            <label for="input-watermark_name" class="col-sm-2 control-label">水印名称<span class="form-required">*</span></label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" id="input-watermark_name" name="name" value="<?php echo $watermark['name']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="input-image" class="col-sm-2 control-label">图片<span class="form-required">*</span></label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" id="input-image" name="image" value="<?php echo $watermark['image']; ?>">
                <a href="javascript:uploadOneImage('图片上传','#input-image','','watermark');">上传图片</a>
            </div>
        </div>
        <div class="form-group">
            <label for="input-device" class="col-sm-2 control-label">设备</label>
            <div class="col-md-6 col-sm-10">
                <select class="form-control" name="device" id="input-device">
                    <?php if(is_array($device) || $device instanceof \think\Collection || $device instanceof \think\Paginator): if( count($device)==0 ) : echo "" ;else: foreach($device as $key=>$vo): ?>
                        <option value="<?php echo $key; ?>" <?php if($watermark['device'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="input-position" class="col-sm-2 control-label">水印位置</label>
            <div class="col-md-6 col-sm-10">
                <select class="form-control" name="position" id="input-position">
                    <?php if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): if( count($position)==0 ) : echo "" ;else: foreach($position as $key=>$vo): ?>
                        <option value="<?php echo $key; ?>" <?php if($watermark['position'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="input-xpos" class="col-sm-2 control-label">显示位置x轴方向<span class="form-required">*</span></label>
            <div class="col-md-3 col-sm-10">
                <button type="button" class="minus" style="display:inline;">-</button>
                <input type="number" style="display:inline;width: 50%;" class="form-control" id="input-xpos" value="<?php echo $watermark['xpos']; ?>" name="xpos">
                <button type="button" class="add" style="display:inline;">+</button>
            </div>
        </div>
        <div class="form-group">
            <label for="input-ypos" class="col-sm-2 control-label">显示位置y轴方向<span class="form-required">*</span></label>
            <div class="col-md-3 col-sm-10">
                <button type="button" class="minus" style="display:inline;">-</button>
                <input type="number" style="display:inline;width: 50%;"  class="form-control" id="input-ypos" value="<?php echo $watermark['ypos']; ?>" name="ypos">
                <button type="button" class="add" style="display:inline;">+</button>
            </div>
        </div>
        <div class="form-group" style="width: 858px;height: 490px;background: grey;margin-left: 10%;margin-top: 2%;margin-bottom: 2%;">
            <img src="<?php echo get_upload_path($watermark['image']); ?>"
                 id="input-image-preview"
                 style="cursor: pointer;margin-top: <?php echo $watermark['ypos']/858*490; ?>%;margin-left: <?php echo $watermark['xpos']; ?>%"/>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="id" value="<?php echo $watermark['id']; ?>">
                <input type="hidden" name="width" id="width" value="<?php echo $watermark['width']; ?>"/>
                <input type="hidden" name="height" id="height" value="<?php echo $watermark['height']; ?>"/>
                <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
                <a class="btn btn-default" href="<?php echo url('watermark/index'); ?>"><?php echo lang('BACK'); ?></a>
            </div>
        </div>
    </form>
</div>
<script src="/static/js/admin.js"></script>
<script>
    $('.add').click(function(){
        var val = Number($(this).prev().val());
        newval = val+1;
        $(this).prev().val(newval);
        $(this).prev().change();
    })
    $('.minus').click(function () {
        var val = Number($(this).next().val());
        newval = val-1;
        $(this).next().val(newval);
        $(this).next().change();
    })
    $('#input-xpos').on('input change',function(){
        x = $(this).val()+"%"
        console.log(x)
        $("#input-image-preview").css({"margin-left":x});
        console.log(x)
    })
    $('#input-ypos').on('input change',function(){
        y = $(this).val();
        y = $(this).val()*490/858;
        y = y+"%"
        console.log(y)
        $("#input-image-preview").css({"margin-top":y});
        console.log(y)
    })
    $('#input-image-preview').load(function(){
        w = $(this).width();
        width = Math.floor(w/858*100);
        console.log(width)
        $('#width').val(width)
        h = $(this).height();
        height = Math.floor(h/858*100);
        console.log(height)
        $('#height').val(height)
    })
</script>
</body>
</html>