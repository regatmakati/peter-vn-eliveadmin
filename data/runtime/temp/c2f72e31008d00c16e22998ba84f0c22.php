<?php /*a:2:{s:73:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/monitor/index.html";i:1654305679;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1654305693;}*/ ?>
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
<style>
li{
    list-style:none;
}
.js-ajax-form li 
{
	list-style:none;
	width:160px;
	height:335px;
	border: 1px solid #C2D1D8;
	float:left;
	margin:10px;			
}
.js-ajax-form li button
{
	margin-left:30px;
}
.js-ajax-form li span
{
	display:block;
	text-align:center
}
.js-ajax-form li .name
{
	width:157px;
	overflow:hidden;
	white-space:nowrap;
	text-overflow:ellipsis;
}
.full_btn
{
	float: left;
  height: 30px;
  padding: 0 18px;
  background: #1dccaa;
  border-radius: 4px;
  line-height: 30px;
  text-align: center;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
  text-decoration: none;
  margin-left: 10px;
}
.full_btn:hover
{
	background: #356f64;
	color: #fff;
	text-decoration:none;
}
</style>
</head>
<body>
	<script src="/static/js/admin.js"></script>
	<script src="/static/home/js/socket.io.js"></script>
	<script src="/static/xigua/xgplayer.js?t=1574906138" type="text/javascript"></script>
    <script src="/static/xigua/xgplayer-flv.js.js" type="text/javascript"></script>
    <script src="/static/xigua/xgplayer-hls.js.js" type="text/javascript"></script>
    <script src="/static/xigua/player.js?t=1586844770" type="text/javascript"></script>
    
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a >监控</a></li>
		</ul>
		<form method="post" class="js-ajax-form" >
            <ul>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$v): ?>
	    		<li class="mytd">
					<span>开播时长:<?php 
								$times = time()-$v['showid'];
								$result = '';
								$hour = floor($times/3600);
                                $minute = floor(($times-3600 * $hour)/60);
                                $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);
                                $result = $hour.':'.$minute.':'.$second;
                                echo  $result;?>
                     </span>
                    <div  id="<?php echo $v['uid'];?>" style="width:160px;height:230px;"></div><br>
                    <span class="name">主播:<?php echo $v['userinfo']['user_nicename'];?></span>
                    <span>房间号:<?php echo $v['uid'];?></span>
                    <div style="text-align:center;">
                        <a  onclick="closeRoom('<?php echo $v['uid'];?>')" class="btn btn-xs btn-warning">关闭</a>
                        <!-- <a  onclick="fullRoom('<?php echo $v['uid'];?>')" class="full_btn mybtn">大屏</a> -->
                    </div>
                </li>
                <script type="text/javascript">
                    (function(){
                        xgPlays('<?php echo $v['uid']; ?>','<?php echo $v['url']; ?>');
                    })()
                </script>				
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

		</form>
        <div style="clear:both;"></div>
        <div class="pagination"  style="clear:both"><?php echo $page; ?></div>
	</div>

    <script type="text/javascript">
         //var socket = new io("<?php echo $config['chatserver']; ?>");
		var socket = new WebSocket("<?php echo $config['chatserver']; ?>");
		 
        function closeRoom(roomId){
          var data2={"type":"adminEndLive","secretKey":"f7s8v8bnm9ad54c5badda7d6304r0higfuad","msg":{"liveuid":roomId,"livetype":"live"}};
                $.ajax({
                    async: false,
                    url: '/admin/Monitor/stopRoom',
                    data:{uid:roomId},
                    dataType: "json",
                    success: function(data){
                        console.log(data);
                        if(data.status ==0){
                            alert(data.info);
                        }else{
                            //socket.emit("superadminaction",data2);
							socket.send(data2);
                            alert("房间已关闭");
                            location.reload();
                        }
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert('关闭失败，请重试');
                    }
                });
            }
    </script>
</body>
</html>