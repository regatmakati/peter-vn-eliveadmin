<?php /*a:1:{s:65:"/www/wwwroot/eliveadmin/themes/default/appapi/feedback/index.html";i:1654305700;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <title>意见反馈</title>	
    
    <meta charset="utf-8">
    <meta name="referrer" content="origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link href='/static/appapi/css/common.css?t=1576565542' rel="stylesheet" type="text/css" >
      
    <link type="text/css" rel="stylesheet" href="/static/appapi/css/feedback.css"/>
</head>
<body>
    <div id="test">
        <textarea placeholder="请将您遇到的问题／产品建议反馈给我们，建议您尽可能详细的描述问题，便于运营同学帮您解决。" id="content" oninput="check_input()" maxlength='200'></textarea>
        <div class="num">最多只能输入200字</div>
        
        <div class="thumb_bd">
            <div id="upload" ></div>
            <input type="hidden" id="thumb" name="thumb" value="">
            <img src="/static/appapi/images/feedback/add.png" class="fl img-sfz" data-index="ipt-file1" id="img_file1" onclick="file_click($(this))">
            <input type="file" id="ipt-file1" class="file_input" name="file"  accept="image/*" style="display:none;"/>
            <div class="shad1 shadd" data-select="ipt-file1">
                <div class="title-upload">正在上传中...</div>
                <div id="progress1">
                    <div class="progress ipt-file1"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="btm">
        <button disabled id="save_btn" class="button_default">点击反馈</button>
    </div>
    <input type="hidden" id="uid" value="895">
    <input type="hidden" id="token" value="3bf2441a6a110f5be27c78c9fb272e50">
    <input type="hidden" id="version" value="">
    <input type="hidden" id="model" value="">

    <script>
    var uid='895';
    var token='3bf2441a6a110f5be27c78c9fb272e50';
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


    <script src="/static/js/ajaxfileupload.js"></script>
    <script src="/static/appapi/js/feedback.js"></script>
</body>
</html>