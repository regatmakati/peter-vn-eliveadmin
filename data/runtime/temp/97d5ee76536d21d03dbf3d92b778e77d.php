<?php /*a:2:{s:77:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/varchar_match/add.html";i:1768747117;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
        <ul class="nav nav-tabs">
            <li><a href="<?php echo url('index'); ?>">比赛列表</a></li>
            <li class="active"><a><?php echo lang('ADD'); ?></a></li>
            <li><a href="<?php echo url('batchAdd'); ?>">批量添加</a></li>
        </ul>
    </ul>
    <form method="post" class="form-horizontal js-ajax-form margin-top-20" action="">

        <div class="form-group">
            <label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>球队类型</label>
            <div class="col-md-6 col-sm-10">
                <select class="form-control" name="type">
                    <option value="0">----选择球队类型---</option>
                    <?php if(is_array($match_class) || $match_class instanceof \think\Collection || $match_class instanceof \think\Paginator): $i = 0; $__LIST__ = $match_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>" <?php echo $data['type']==$key ? 'selected' : ''; ?>><?php echo $v; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="input-user_login" class="col-sm-2 control-label">封面图</label>
            <div class="col-md-6 col-sm-10">
                <input type="hidden" name="thumb" id="thumbnail_12" value="<?php echo $data['thumb']; ?>">
                <a href="javascript:uploadOneImage('图片上传','#thumbnail_12','','liveclass');">
                    <img src="<?php echo !empty($data['thumb']) ? get_upload_path($data['thumb']) : '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png'; ?>"
                         id="thumbnail_12-preview"
                         style="cursor: pointer;max-width:100px;max-height:100px;"/>
                </a>
                图片尺寸： 50 X 50
            </div>
        </div>
        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label">联赛名称</label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label">A战队</label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" name="home_team" value="<?php echo $data['home_team']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="input-user_login" class="col-sm-2 control-label">A战队图片</label>
            <div class="col-md-6 col-sm-10">
                <input type="hidden" name="home_icon" id="thumbnail" value="<?php echo $data['home_icon']; ?>">
                <a href="javascript:uploadOneImage('图片上传','#thumbnail','','liveclass');">
                    <img src="<?php echo !empty($data['home_icon']) ? get_upload_path($data['home_icon']) : '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png'; ?>"
                         id="thumbnail-preview"
                         style="cursor: pointer;max-width:100px;max-height:100px;"/>
                </a>
                图片尺寸： 50 X 50
            </div>
        </div>

        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label">B战队</label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" name="away_team" value="<?php echo $data['away_team']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="input-user_login" class="col-sm-2 control-label">B战队图片</label>
            <div class="col-md-6 col-sm-10">
                <input type="hidden" name="away_icon" id="thumbnailB" value="<?php echo $data['away_icon']; ?>">
                <a href="javascript:uploadOneImage('图片上传','#thumbnailB','','liveclass');">
                    <img src="<?php echo !empty($data['away_icon']) ? get_upload_path($data['away_icon']) : '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png'; ?>"
                         id="thumbnailB-preview"
                         style="cursor: pointer;max-width:100px;max-height:100px;"/>
                </a>
                图片尺寸： 50 X 50
            </div>
        </div>

        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>开始时间</label>
            <div class="col-md-6 col-sm-10">
                <input class="form-control js-bootstrap-datetime" readonly name="start_time" value="<?php echo date('Y-m-d H:i:s', $data['start_time']?$data['start_time']:time()); ?>" aria-invalid="false">
            </div>
        </div>

        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>直播地址</label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" name="view_url" value="<?php echo $data['view_url']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="input-bonus_switch" class="col-sm-2 control-label">是否热门</label>
            <div class="col-md-6 col-sm-10">
                <select class="form-control" name="hot_status">
                    <option value="1">是</option>
                    <option value="0" <?php if($data['hot_status'] == '0'): ?>selected<?php endif; ?>>否</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="input-bonus_switch" class="col-sm-2 control-label">是否推荐</label>
            <div class="col-md-6 col-sm-10">
                <select class="form-control" name="rocm_status">
                    <option value="1">是</option>
                    <option value="0" <?php if($data['rocm_status'] == '0'): ?>selected<?php endif; ?>>否</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="input-bonus_switch" class="col-sm-2 control-label">直播状态</label>
            <div class="col-md-6 col-sm-10">
                <select class="form-control" name="status">
                    <option value="0">未开始/进行中</option>
                    <option value="1" <?php if($data['status'] == '1'): ?>selected<?php endif; ?>>已结束</option>
                </select>
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

    })()
</script>
</body>
</html>