<?php /*a:0:{}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		
    <meta charset="utf-8">
    <meta name="referrer" content="origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link href='/static/appapi/css/common.css?t=1576565542' rel="stylesheet" type="text/css" >

		<title>添加上级</title>
		<link href='/static/appapi/css/agent.css' rel="stylesheet" type="text/css" >
	</head>
<body >

	<div class="setcode">
		<div class="top"></div>
				<div class="mycode">
			请输入上级邀请码：<br>
			<span class="code">
				<i>&nbsp;</i>
				<i>&nbsp;</i>
				<i>&nbsp;</i>
				<i>&nbsp;</i>
				<i>&nbsp;</i>
				<i>&nbsp;</i>
				<input type="text" id="code" maxlength="6" onkeyup="value=value.replace(/[\W]/g,'')">
			</span>
		</div>
		<div class="tips">
			邀请须知：<br>
			请仔细填写对方的邀请码，填写后不可更改
		</div>
		<div class="submit button_default">
			确定
		</div>
			</div>

<script>
    var uid='920';
    var token='8059aa5d2685a5f06cff5e002403f10f';
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