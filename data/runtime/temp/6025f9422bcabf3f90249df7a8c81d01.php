<?php /*a:2:{s:83:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/varchar_match/batch_add.html";i:1657269801;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
<style>
    .match {}
    .match input,.match select,.match button {outline:none;}
    .match table {width:100%;font-size:14px;border:1px solid #ecf0f1;}
    .match table thead tr th,.match table tbody tr td div {padding:8px;color:#2C3E50;box-sizing:border-box;}
    .match table tbody tr td div,.match .caozuo {display:flex;align-items:center;justify-content:center;}
    .match table thead tr th {white-space:nowrap;border-bottom:2px solid #ecf0f1;}
    .match table thead tr th:not(:first-child),.match table tbody tr td:not(:first-child) {border-left:1px solid #ecf0f1;}
    .match table tbody tr td input {width:100%;min-width:50px;height:24px;line-height:24px;text-align:center;border:1px solid #b3c8cd;}
    .match table tbody tr td select,.match table tbody tr td select option {width:100%;height:24px;padding-left:8px;box-sizing:border-box;border:1px solid #b3c8cd;}
    .match table tbody tr td select option {line-height:24px;}
    .match table tbody tr td {text-align:center;}
    .match table tbody tr td button {white-space:nowrap;}
    .match .caozuo button {color:#fff;padding:4px 8px;cursor:pointer;border:none;border-color:#E74C3C;background-color:#E74C3C;}
    .match .add-match {margin-top:14px;}
    .match .add-match button {padding:6px 12px;border:none;cursor:pointer;}
    .match .submite {margin:24px auto 0;width:150px;height:40px;line-height:40px;text-align:center;color:#fff;cursor:pointer;border-radius:4px;background-color:#52b6d9;}
    .match .nodata {width:100%;padding:50px;text-align:center;box-sizing:border-box;}
    .match-body tr td{padding: 5px;}
</style>
<body>
<div class="wrap">
    <ul class="nav nav-tabs">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo url('index'); ?>">比赛列表</a></li>
            <li><a href="<?php echo url('add'); ?>"><?php echo lang('ADD'); ?></a></li>
            <li class="active"><a>批量添加</a></li>
        </ul>
    </ul>
    <form method="post" class="match js-ajax-form margin-top-20" action="">
        <table>
            <thead>
            <tr>
                <th style="width: 10%;">球队类型</th>
                <th style="width: 8%;">封面图</th>
                <th style="width: 8%;">联赛名称</th>
                <th style="width: 8%;">A战队</th>
                <th style="width: 8%;">A战队图片</th>
                <th style="width: 8%;">B战队</th>
                <th style="width: 8%;">B战队图片</th>
                <th style="width: 15%;">比赛时间</th>
				<th style="width: 15%;">结束时间</th>
                <th style="width: 18%;">直播地址</th>
                <th style="width: 18%;">是否热门</th>
                <th style="width: 18%;">是否推荐</th>
                <th style="width: 8%;">状态</th>
                <th style="width: 8%;">操作</th>
            </tr>
            </thead>
            <tbody id="match-body">
            <tr>
                <td style="padding: 5px">
                    <select style="height: 40px;width: 80px;" class="form-control" name="data[0][type]">
                        <option value="0">----选择球队类型---</option>
                        <?php if(is_array($match_class) || $match_class instanceof \think\Collection || $match_class instanceof \think\Paginator): $i = 0; $__LIST__ = $match_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $key; ?>" <?php if($key == 1): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <td style="padding: 5px">
                    <input style="height: 40px" type="hidden" name="data[0][thumb]" id="thumb" value="">
                    <a href="javascript:uploadOneImage('图片上传','#thumb','','liveclass');">
                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumb-preview" style="cursor: pointer;max-width:100px;max-height:100px;"/>
                    </a>
                </td>

                <td style="padding: 5px">
                    <input style="height: 40px" type="text" class="form-control" name="data[0][name]" value="">
                </td>
                <td style="padding: 5px">
                    <input style="height: 40px" type="text" class="form-control" name="data[0][home_team]" value="">
                </td>
                <td style="padding: 5px">
                    <input style="height: 40px" type="hidden" name="data[0][home_icon]" id="thumbnail_0" value="">
                    <a href="javascript:uploadOneImage('图片上传','#thumbnail_0','','liveclass');">
                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbnail_0-preview" style="cursor: pointer;max-width:100px;max-height:100px;"/>
                    </a>
                </td>
                <td style="padding: 5px">
                    <input style="height: 40px" type="text" class="form-control" name="data[0][away_team]" value="">
                </td>
                <td style="padding: 5px">
                    <input style="height: 40px" type="hidden" name="data[0][away_icon]" id="thumbnailB_0" value="">
                    <a href="javascript:uploadOneImage('图片上传','#thumbnailB_0','','liveclass');">
                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbnailB_0-preview"style="cursor: pointer;max-width:100px;max-height:100px;"/>
                    </a>
                </td>
                <td>
                    <input style="height: 40px;width: 150px;" readonly class="form-control js-bootstrap-datetime" name="data[0][start_time]" value="<?php echo date('Y-m-d H:i:s'); ?>">
                </td>
                <td>
                    <input style="height: 40px;width: 150px;" readonly class="form-control js-bootstrap-datetime" name="data[0][end_time]" value="">
                </td>
                <td style="padding: 5px">
                    <input style="height: 40px;width: 150px;" type="text" placeholder="直播地址必填" class="form-control J_view_url" name="data[0][view_url]" value="">
                </td>
                <td style="padding: 5px">
                    <select style="width: 60px;height: 40px" class="form-control" name="data[0][hot_status]">
                        <option value="1">是</option>
                        <option value="0" <?php if($status == '0'): ?>selected<?php endif; ?>>否</option>
                    </select>
                </td>
                <td style="padding: 5px">
                    <select style="width: 60px;height: 40px" class="form-control" name="data[0][rocm_status]">
                        <option value="1">是</option>
                        <option value="0" <?php if($status == '0'): ?>selected<?php endif; ?>>否</option>
                    </select>
                </td>
                <td style="padding: 5px">
                    <select style="width: 100px;height: 40px" class="form-control" name="data[0][status]">
                        <option value="0">未开始/进行中</option>
                        <option value="1" <?php if($status == '1'): ?>selected<?php endif; ?>>已结束</option>
                    </select>
                </td>
                <td class="J_click_del" style="padding: 5px">
                    删除
                </td>
            </tr>
            </tbody>
        </table>
        <div class="add-match">
            <button type="button" id="add-match">添加比赛栏</button>
        </div>
        <div class="add-match">
            <button style="padding:0" id="pileiang" class="submite btn btn-primary js-ajax-submit">批量添加</button>
        </div>
    </form>
</div>
<script src="/static/js/admin.js"></script>
<script>
$('#add-match').on('click', function(){
    var lenths = $('#match-body tr').length;
    lenths = lenths + 1;
    var info = '<tr>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <select style="height: 40px;width: 80px;" class="form-control" name="data['+lenths+'][type]">\n' +
        '                        <option value="0">----选择球队类型---</option>\n' +
        '                        <?php if(is_array($match_class) || $match_class instanceof \think\Collection || $match_class instanceof \think\Paginator): $i = 0; $__LIST__ = $match_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>\n' +
        '                            <option value="<?php echo $key; ?>" <?php if($key == '1'): ?>selected<?php endif; ?>><?php echo $v; ?></option>\n' +
        '                        <?php endforeach; endif; else: echo "" ;endif; ?>\n' +
        '                    </select>\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                     <input style="height: 40px" type="hidden" name="data['+lenths+'][thumb]" id="thumb_'+lenths+'" value="">\n' +
        '                         <a href="javascript:uploadOneImage(\'图片上传\',\'#thumb_'+lenths+'\',\'\',\'liveclass\');">\n' +
        '                            <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumb_'+lenths+'-preview" style="cursor: pointer;max-width:100px;max-height:100px;"/>\n' +
        '                       </a>\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <input style="height: 40px" type="text" class="form-control" name="data['+lenths+'][name]" value="">\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <input style="height: 40px" type="text" class="form-control" name="data['+lenths+'][home_team]" value="">\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <input style="height: 40px" type="hidden" name="data['+lenths+'][home_icon]" id="thumbnail_'+lenths+'" value="">\n' +
        '                    <a href="javascript:uploadOneImage(\'图片上传\',\'#thumbnail_'+lenths+'\',\'\',\'liveclass\');">\n' +
        '                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbnail_'+lenths+'-preview" style="cursor: pointer;max-width:100px;max-height:100px;"/>\n' +
        '                    </a>\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <input style="height: 40px" type="text" class="form-control" name="data['+lenths+'][away_team]" value="">\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <input style="height: 40px" type="hidden" name="data['+lenths+'][away_icon]" id="thumbnailB_'+lenths+'" value="">\n' +
        '                    <a href="javascript:uploadOneImage(\'图片上传\',\'#thumbnailB_'+lenths+'\',\'\',\'liveclass\');">\n' +
        '                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbnailB_'+lenths+'-preview"style="cursor: pointer;max-width:100px;max-height:100px;"/>\n' +
        '                    </a>\n' +
        '                </td>\n' +
        '                <td>\n' +
        '                    <input style="height: 40px;width: 150px;" readonly class="form-control js-bootstrap-datetime_'+lenths+'" name="data['+lenths+'][start_time]" value="<?php echo date('Y-m-d H:i:s'); ?>">\n' +
        '                </td>\n' +
        '                <td>\n' +
        '                    <input style="height: 40px;width: 150px;" readonly class="form-control js-bootstrap-datetime_'+lenths+'" name="data['+lenths+'][end_time]" value="">\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <input style="height: 40px;width: 150px;" type="text" placeholder="直播地址必填" class="form-control J_view_url" name="data['+lenths+'][view_url]" value="">\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <select style="width: 60px;height: 40px" class="form-control" name="data['+lenths+'][hot_status]">\n' +
        '                        <option value="1">是</option>\n' +
        '                        <option value="0" <?php if($status == '0'): ?>selected<?php endif; ?>>否</option>\n' +
        '                    </select>\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <select style="width: 60px;height: 40px" class="form-control" name="data['+lenths+'][rocm_status]">\n' +
        '                        <option value="1">是</option>\n' +
        '                        <option value="0" <?php if($status == '0'): ?>selected<?php endif; ?>>否</option>\n' +
        '                    </select>\n' +
        '                </td>\n' +
        '                <td style="padding: 5px">\n' +
        '                    <select style="width: 100px;height: 40px" class="form-control" name="data['+lenths+'][status]">\n' +
        '                        <option value="0">未开始/进行中</option>\n' +
        '                        <option value="1" <?php if($status == '1'): ?>selected<?php endif; ?>>已结束</option>\n' +
        '                    </select>\n' +
        '                </td>\n' +
        '                <td class="J_click_del" style="padding: 5px">\n' +
        '                    删除\n' +
        '                </td>\n' +
        '            </tr>';
    $('#match-body').append(info);
    var bootstrapDateTimeInput = $(".js-bootstrap-datetime_" + lenths);
    if (bootstrapDateTimeInput.length) {
        Wind.css('bootstrapDatetimePicker');
        Wind.use('bootstrapDatetimePicker', function () {
            bootstrapDateTimeInput.datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm-dd hh:ii',
                todayBtn: 1,
                autoclose: true
            });
        });
    }
})

$(document).on("click", ".J_click_del", function(){
    $(this).closest('tr').remove();
});
</script>
</body>
</html>