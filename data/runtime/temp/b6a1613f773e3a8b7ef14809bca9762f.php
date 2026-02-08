<?php /*a:2:{s:71:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/system/edit.html";i:1768747113;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
			<!-- <li ><a href="<?php echo url('System/index'); ?>">列表</a></li> -->
			<li class="active"><a >发送消息</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form2 margin-top-20" >
            <div class="form-group">
				<label for="content" class="col-sm-2 control-label"><span class="form-required">*</span>消息内容</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="content" name="content" value="">发送的系统消息将显示到所有直播间的聊天公屏区域
				</div>
			</div>
            

            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit2">发送</button>
					<!-- <a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a> -->
				</div>
			</div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
    <script src="/static/js/socket.io.js"></script>
    <script type="text/javascript">
         var socket = new io("<?php echo $config['chatserver']; ?>");
         $(".js-ajax-submit2").on("click",function(){
            var content=$.trim( $("#content").val() );
            if(!content){
                alert("内容不能为空");
                return !1;
            }
            $.ajax({
                url:'<?php echo url('System/send'); ?>',
                data:{content:content},
                type:'POST',
                dataType:'json',
                success:function(data){
                    if(data.code==0){
                        alert(data.msg);
                        return !1;
                    }
                    
                    var data2 = {"token":"1234567","content":content};
                    socket.emit("systemadmin",data2);
                    alert("发送成功");
                     
                }
            })
         
         })

    </script>
</body>
</html>