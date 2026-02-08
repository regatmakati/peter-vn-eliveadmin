<?php /*a:3:{s:62:"/www/wwwroot/eliveadmin/themes/default/appapi/agent/index.html";i:1654305697;s:55:"/www/wwwroot/eliveadmin/themes/default/appapi/head.html";i:1654305700;s:57:"/www/wwwroot/eliveadmin/themes/default/appapi/footer.html";i:1654305700;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
        
    <meta charset="utf-8">
    <meta name="referrer" content="origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link href='/static/appapi/css/common.css?t=1576565542' rel="stylesheet" type="text/css" >

		<title>邀请奖励</title>
		<link href='/static/appapi/css/agent.css?t=1561712925' rel="stylesheet" type="text/css" >
	</head>
<body >
	<div class="home">
        <div class="top_bg">
			<?php if($bg == 'orange'): ?>
            <img src="/static/appapi/images/agent/agent_bg.png">
			<?php else: ?>
			<img src="/static/appapi/images/agent/agent_bg1.png">
			<?php endif; ?>
        </div>
        <div class="top_code">
            <div class="mycode_title">
                您的邀请码
            </div>
            <div class="mycode">
                <span class="code">
                    <?php if(is_array($code_a) || $code_a instanceof \think\Collection || $code_a instanceof \think\Paginator): $i = 0; $__LIST__ = $code_a;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <i><?php echo $vo; ?></i>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </span>
                <div class="copy" data-code="<?php echo $code; ?>">
                    点击复制
                </div>
                
            </div>
        </div>
		<div class="top">
			<div class="myagent">
                <span class="li_l">我的上级</span> 
                
				<?php if($agentinfo): ?>
                    <span class="li_r"><?php echo $agentinfo['user_nicename']; ?></span>
				<?php else: ?>
                    <a class="agent_add" href="/Appapi/Agent/agent?uid=<?php echo $uid; ?>&token=<?php echo $token; ?>">
                        <span class="li_r">去设置</span>
                    </a>
				<?php endif; ?>
			</div>
		</div>
        <div class="list">
            <ul>
                <li>
                    <a class="see" href="/Appapi/Agent/one?uid=<?php echo $uid; ?>&token=<?php echo $token; ?>">
                        <span class="li_l">下级总提成</span> 
                        <span class="li_r color_default"><?php echo $agnet_profit['one_profit']; ?></span>
                    </a>
                </li>
            </ul>
        </div>
        </a>
		
		<div class="tips">
			邀请须知：<br>
			每个用户都有自己的邀请码，只要您邀请的用户输入您的邀请码，对方充值时，您将获得一定的分成奖励
		</div>
	</div>
    <script>
    var uid='<?php echo (isset($uid) && ($uid !== '')?$uid:''); ?>';
    var token='<?php echo (isset($token) && ($token !== '')?$token:''); ?>';
    var baseSize = 100;
    function setRem () {
      var scale = document.documentElement.clientWidth / 750;
      document.documentElement.style.fontSize = (baseSize * Math.min(scale, 3)) + 'px';
    }
    setRem();
    window.onresize = function () {
      setRem();
    }
</script>
<script src="/static/js/jquery.js"></script>
<script src="/static/js/layer/layer.js"></script>


    <script src="/static/appapi/js/agent.js"></script>
</body>
</html>