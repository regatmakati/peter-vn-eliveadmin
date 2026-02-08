<?php /*a:2:{s:74:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/setting/huawei.html";i:1768747109;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo url('setting/huawei'); ?>">华为云存储</a></li>
    </ul>
    <form method="post" class="js-ajax-form margin-top-20" action="<?php echo url('setting/huaweiPost'); ?>">

        <div class="form-group">
            <label>AccessKey<span class="form-required">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="accessKey"
                           value="<?php echo (isset($accessKey) && ($accessKey !== '')?$accessKey:''); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>SecretKey<span class="form-required">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="secretKey"
                           value="<?php echo (isset($secretKey) && ($secretKey !== '')?$secretKey:''); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Endpoint<span class="form-required">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="endPoint"
                           value="<?php echo (isset($endPoint) && ($endPoint !== '')?$endPoint:''); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Bucket<span class="form-required">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="Bucket"
                           value="<?php echo (isset($Bucket) && ($Bucket !== '')?$Bucket:''); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>访问域名<span class="form-required">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="domain"
                           value="<?php echo (isset($domain) && ($domain !== '')?$domain:''); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0"><?php echo lang('SAVE'); ?></button>
            </div>
        </div>
    </form>
</div>
<script src="/static/js/admin.js"></script>
</body>
</html>