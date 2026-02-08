<?php /*a:2:{s:79:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/varchar_match/index.html";i:1768747117;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
            <li class="active"><a>比赛列表</a></li>
            <li><a href="<?php echo url('add'); ?>"><?php echo lang('ADD'); ?></a></li>
            <li><a href="<?php echo url('batchAdd'); ?>">批量添加</a></li>
        </ul>
    </ul>
    <form class="well form-inline margin-top-20" action="<?php echo url(request()->action()); ?>" method="get">
        比赛类型：
        <select class="form-control" name="type">
            <option value="">全部</option>
            <?php if(is_array($match_class) || $match_class instanceof \think\Collection || $match_class instanceof \think\Paginator): $i = 0; $__LIST__ = $match_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $key; ?>" <?php echo input('request.type')==$key?'selected':''; ?>><?php echo $v; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        A战队名称：
        <input class="form-control" type="text" name="home_team" style="width: 200px;" value="<?php echo input('request.home_team'); ?>"
               placeholder="请输入A战队名称">
        B战队名称：
        <input class="form-control" type="text" name="away_team" style="width: 200px;" value="<?php echo input('request.away_team'); ?>"
               placeholder="请输入B战队名称">
        <input type="submit" class="btn btn-primary" style="margin-left: 10px;" value="查询">
    </form>
    <form method="post" class="js-ajax-form" action="<?php echo url('listOrder'); ?>">
        <div class="table-actions">
            <button class="btn btn-primary  js-ajax-submit" type="submit"><?php echo lang('SORT'); ?></button>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>排序</th>
                <th>所属游戏</th>
                <th>A战队</th>
                <th>B战队</th>
                <th>开赛时间</th>
                <th>直播地址</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
                <tr>
                    <td>
                        <input name="list_orders[<?php echo $vo['id']; ?>]" class="input-order" type="text" value="<?php echo $vo['sort']; ?>">
                    </td>
                    <td><?php echo $match_class[$vo['type']]; ?> </td>
                    <td><img style="max-width: 40px;max-height: 40px;" src="<?php echo $vo['home_icon']; ?>" alt="">&nbsp;&nbsp;<?php echo $vo['home_team']; ?></td>
                    <td><img style="max-width: 40px;max-height: 40px;" src="<?php echo $vo['away_icon']; ?>" alt="">&nbsp;&nbsp;<?php echo $vo['away_team']; ?></td>
                    <td>
                        <?php echo date("Y-m-d H:i:s",!is_numeric($vo['start_time'])? strtotime($vo['start_time']) : $vo['start_time']); ?>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-info liveurl"  data-url="<?php echo $vo['view_url']; ?>">直播链接</a>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href='<?php echo url("edit",array("id"=>$vo["id"])); ?>'><?php echo lang('EDIT'); ?></a>
                        <a href="<?php echo url('delete',array('id'=>$vo['id'])); ?>" class="js-ajax-delete">删除</a>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="pagination"><?php echo $page; ?></div>
    </form>
</div>
<script src="/static/js/admin.js"></script>
<script type="text/javascript">
    $(function(){
        Wind.use('layer');
        $('.liveurl').click(function(){
            var _this=$(this);
            var url=_this.data('url');

            var lives = layer.open({
                type: 2,
                title: '直播流',
                shade: 0.5,
                area: ['500px', '490px'],
                content: url,
                closeBtn: 1, //不显示关闭按钮
                btn: ['关闭']
            });
            layer.full(lives);
        });
    })
</script>
</body>
</html>