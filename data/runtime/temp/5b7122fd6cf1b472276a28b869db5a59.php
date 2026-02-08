<?php /*a:5:{s:60:"/www/wwwroot/eliveadmin/themes/default/home/index/index.html";i:1768747135;s:55:"/www/wwwroot/eliveadmin/themes/default/public/head.html";i:1768747139;s:57:"/www/wwwroot/eliveadmin/themes/default/public/header.html";i:1768747139;s:57:"/www/wwwroot/eliveadmin/themes/default/public/footer.html";i:1768747139;s:58:"/www/wwwroot/eliveadmin/themes/default/public/scripts.html";i:1768747139;}*/ ?>

<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie oldie ie6" lang="zh">
<![endif]-->
<!--[if IE 7]>
<html class="ie oldie ie7" lang="zh">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="zh">
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9" lang="zh">
<![endif]-->
<!--[if gt IE 10]><!-->
<html lang="zh">
<!--<![endif]-->
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>	
	
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">

	<!-- No Baidu Siteapp-->
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
    
    <meta name="referrer" content="origin">

	<!-- HTML5 shim for IE8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif]-->
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	
	<link type="text/css" rel="stylesheet" href="/static/home/css/common.css?t=1542606715"/>
	<link type="text/css" rel="stylesheet" href="/static/home/css/login.css"/>

	

<title><?php echo (isset($site_info['site_seo_title']) && ($site_info['site_seo_title'] !== '')?$site_info['site_seo_title']:$site_name); ?></title>
<meta name="keywords" content="<?php echo $site_info['site_seo_keywords']; ?>"/>
<meta name="description" content="<?php echo $site_info['site_seo_description']; ?>"/>
<link type="text/css" rel="stylesheet" href="/static/js/swiper/swiper.min.css"/>
<link type="text/css" rel="stylesheet" href="/static/home/css/index.css"/>
</head>
<body>
<div class="wrapper">
    	<div id="doc-hd" class="header double">
		<div class="topbar">
			<div class="container clearfix">
				<div class="hd-logo">
					<a href="#" class="links"></a>
				</div>
				<ul class="hd-nav">
					<li class="item"><a href="/" <?php if($current == 'index'): ?>class="current" <?php endif; ?> >首页</a></li>
<!-- 					<li class="item"><a href="#"  <?php if($current == 'follow'): ?>class="current" <?php endif; ?> >我的关注</a></li> -->
					<li class="item"><a href="/home/Category/index?cat=2"  <?php if($current == '2'): ?>class="current" <?php endif; ?> >女神驾到</a></li>
					<li class="item"><a href="/home/Category/index?cat=1"  <?php if($current == '1'): ?>class="current" <?php endif; ?> >国民男神</a></li>
					<li class="item"><a href="/home/App/programe"  <?php if($current == 'download'): ?>class="current" <?php endif; ?> >APP</a></li>
					
				</ul>
				<div class="hd-login">
				  <?php if(!$user): ?>
					<div class="no-login">
						<i class="icon-avatar"></i>
						<a href="javascript:void(0);" class="tologin">登录/注册</a>
						<i class="icon-level"></i>
						<i class="icon-more"></i>
					</div>
					<?php else: ?>
					<div class="already-login">
						<a class="link" href="#"><i class="icon-avatar"><img src="<?php echo $user['avatar']; ?>" alt=""/></i><span class="nickname"><?php echo $user['user_nicename']; ?></span></a>
						<i class="icon-level"></i>
						<i class="icon-more"></i>
						<div class="userinfo">
							<div class="userinfo_up">
							</div>
							<div class="userinfo_down">
								<div class="userinfo_name">
									 <div class="live">
										<a href="/<?php echo $user['id']; ?>">我的直播</a>
									</div>
									<div class="live">
										<a href="/home/Personal/index">个人中心</a>
									</div>									
									<div class="logout">
										【退出登录】
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="huajiaodou">
					  <?php if(!$user): ?>
						 <a ></a> 
					    <?php else: ?>
						 <a class="btn-huajiaodou" href="/home/Payment/index" target="_blank">充值</a> 
					  <?php endif; ?>
					</div> 
				</div>
				
				<div class="search-bar">
					<div class="search-hd">
					</div>
					<div class="search-bd">
						<form class="search-form" action="/home/Index/translate" target="_top" method="post" name="search-form">
							<div class="search-input-wrap">
								<input  class="search-input" name="keyword" id="keyword" placeholder="请输入用户名或用户ID"/>
								<input type="submit" class="search-submit-btn"/>
							</div>
						</form>
					</div>
					<div class="search-ft">
						<div id="suggest-container" class="suggest-container" style="display:none;">
							<div class="suggest-bd">
							</div>
							<div class="suggest-ft">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="top_line"></div>
	<div class="index_live">
		<div style="height: 20px;"></div>
		<div class="index_live_area">
			<div class="index_live_area_left">
				<div id="video_bd" style="width: 100%; height: 590px;">
                    <div id="video_play"></div>
                </div>
				<div class="video_mask">
					<a href="/" target="_blank">
						<div class="video_mask_center">
							<p><img src="/static/home/images/index/enter_room.png"></p>
							<p>进入直播间</p>
						</div>
					</a>
				</div>
			</div>
			<div class="index_live_area_right">
				<ul>
					<?php if(is_array($indexLive) || $indexLive instanceof \think\Collection || $indexLive instanceof \think\Paginator): $i = 0; $__LIST__ = $indexLive;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li data-pull="<?php echo $vo['pull']; ?>" data-uid="<?php echo $vo['uid']; ?>" ><img src="<?php echo $vo['thumb']; ?>"></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="clearboth"></div>
		</div>

		<div class="scroll_top">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php if(is_array($slide) || $slide instanceof \think\Collection || $slide instanceof \think\Paginator): $i = 0; $__LIST__ = $slide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="swiper-slide">
                        <a target="_blank" href="<?php echo $vo['url']; ?>">
                            <img src="<?php echo $vo['image']; ?>">
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>       	
    	</div>	
	</div>
    	
	
	
	<div id="doc-bd">
		<div class="container clearfix">
			<div class="main_top_pic"><img src="/static/home/images/index/main_top.png"></div>
			<div class="main clearfix">

				<div id="focuspic" class="focuspic feed-list">
					<ul class="list">
						<?php if(is_array($recommend) || $recommend instanceof \think\Collection || $recommend instanceof \think\Paginator): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

							 <li class="normal  feed <?php if($i == '1'): ?> mar_left0<?php endif; ?>" >
							 	<p class="normal_title"><?php echo $v['user_nicename']; ?></p>
								<a class="link clearfix" target="_blank" href="/<?php echo $v['uid']; ?>">
									<img class="screenshot thumb" src="/static/home/images/lazyload.png" data-original="<?php echo $v['thumb']; ?>"/>
								</a>
							</li>

						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="gray_line"></div>
				<!-- 热门直播 -->
				<div class="g-box feed-list" id="hot">
					<div class="box-hd">
						<h2 class="box-title"><span class="icon"><img src="/static/home/images/index/remen.png"></span>热门直播</h2>
					<!-- 	<a class="box-more" href="/category/1">查看更多 &gt;&gt;</a> -->
					</div>
					<div class="box-bd">
						<ul class="list">
						  <?php if(is_array($hot) || $hot instanceof \think\Collection || $hot instanceof \think\Paginator): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li class="feed <?php if($v['islive'] == '1'): ?>live<?php else: ?><?php endif; ?> "><a class="link" href="/<?php echo $v['uid']; ?>" target="_blank"><img class="screenshot thumb" src="/static/home/images/lazyload.png" data-original="<?php echo $v['thumb']; ?>"/>
							<div class="user">
								<div class="user_left fl"><img class="avatar thumb" src="/static/home/images/lazyload.png" data-original="<?php echo $v['avatar']; ?>"/></div>
								<div class="user_right fl">
									<p class="username"><?php echo $v['user_nicename']; ?></p>
									<p class="bottom">
										<span class="type"><?php echo $v['signature']; ?></span>
										<span class="nums"><?php echo $v['nums']; ?></span>
									</p>
								</div>
								
							</div>
							
							</a></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							
						</ul>
					</div>
				</div>
				<div class="gray_line"></div>				
				<!-- 最新直播 -->
				<div class="g-box feed-list" id="living">
					<div class="box-hd">
						<h2 class="box-title"><span class="icon"><img src="/static/home/images/index/zuixin.png"></span>最新直播</h2>
					</div>
					<div class="box-bd">
						<ul class="list">
						  <?php if(is_array($live) || $live instanceof \think\Collection || $live instanceof \think\Paginator): $i = 0; $__LIST__ = $live;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

							<li class="feed <?php if($v['islive'] == '1'): ?>live<?php else: ?><?php endif; ?>"><a class="link" href="/<?php echo $v['uid']; ?>" target="_blank"><img class="screenshot thumb" src="/static/home/images/lazyload.png" data-original="<?php echo $v['thumb']; ?>"/>
							<div class="user">
								<div class="user_left fl"><img class="avatar thumb" src="/static/home/images/lazyload.png" data-original="<?php echo $v['avatar']; ?>"/></div>
								<div class="user_right fl">
									<p class="username"><?php echo $v['user_nicename']; ?></p>
									<p class="bottom">
										<span class="type"><?php echo $v['signature']; ?></span>
										<span class="nums"><?php echo $v['nums']; ?></span>
									</p>
								</div>
								
							</div>
							
							</a></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="area-ft">
		<div class="down-ft">
			<div class="down-ft_one fl">
				<div class="guan_wei">
					<?php if($site_info['sina_url'] != ''): ?><a href="<?php echo $site_info['sina_url']; ?>" target="_blank"><?php endif; ?>
						<div class="guan_wei_icon fl">
							<img src="<?php echo $site_info['sina_icon']; ?>">
						</div>
						<div class="guan_wei_con fl">
							<p class="guan_wei_title"><?php echo $site_info['sina_title']; ?></p>
							<p class="guan_wei_desc"><?php echo $site_info['sina_desc']; ?></p>
						</div>
					<?php if($site_info['sina_url'] != ''): ?></a><?php endif; ?>
					<div class="clearboth"></div>
				</div>

				<div class="guan_wei mar_top15">
					<?php if($site_info['qq_url'] != ''): ?><a href="<?php echo $site_info['qq_url']; ?>" target="_blank"><?php endif; ?>
						<div class="guan_wei_icon fl">
							<img src="<?php echo $site_info['qq_icon']; ?>">
						</div>
						<div class="guan_wei_con fl">
							<p class="guan_wei_title"><?php echo $site_info['qq_title']; ?></p>
							<p class="guan_wei_desc"><?php echo $site_info['qq_desc']; ?></p>
						</div>
					<?php if($site_info['qq_url'] != ''): ?></a><?php endif; ?>
					<div class="clearboth"></div>
				</div>
				
			</div>
			<div class="down-ft_two fl">
				<ul class="ewm_list">
					<li>
						<p class="ewm_title">微信公众号</p>
						<p class="ewm_icon"><img src="<?php echo $site_info['wechat_ewm']; ?>"></p>
					</li>
					<li>
						<p class="ewm_title">android版下载</p>
						<p class="ewm_icon"><img src="<?php echo $site_info['apk_ewm']; ?>"></p>
					</li>
					<li>
						<p class="ewm_title">iPhone版下载</p>
						<p class="ewm_icon"><img src="<?php echo $site_info['ipa_ewm']; ?>"></p>
					</li>
					<div class="clearboth"></div>
				</ul>
			</div>
			<div class="down-ft_three fl">
				<ul class="href_list fl mar_left50">
					<p><?php echo $site_info['site_name']; ?></p>
				</ul>
				<ul class="href_list fl">
					<p>新手帮助</p>
					<li><a >新手指引</a></li>
					<li><a >赞助中心</a></li>
					<li><a >资费介绍</a></li>
				</ul>
				<div class="clearboth"></div>
			</div>
			<div class="down-ft_four fl">
				<p class="company_mobile"><?php echo $site_info['mobile']; ?></p>
				<p>客服热线(服务时间:8:00-16:00)</p>
				<p>地址:<?php echo $site_info['address']; ?></p>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
	<div id="doc-ft">
		<div class="container">
			<p class="footer">
				<?php echo nl2br($site_info['copyright']); ?>
			</p>
		</div>
	</div>
		
	  


<script type="text/javascript">
    window._DATA = window._DATA || {};
    window._DATA.user = <?php echo $userinfo; ?>;
</script> 
<script src="/static/js/jquery.js"></script> 
<script src="/static/home/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="/static/js/layer/layer.js"></script> 
<script type="text/javascript" src="/static/home/js/login.js"></script> 

<div class="fix_area">
	<div class="fix_area_left fl">
		<div class="fix_area_left_con">
			<p>扫一扫</p>
			<p>手机看直播</p>
			<p class="ewm_img"><img src="<?php echo $site_info['apk_ewm']; ?>"></p>
			<p class="app_ewm_name">Android APP</p>
		</div>
	</div>
	<div class="fix_area_right fl">
		<p class="app_type_icon app_type_android mar_top75">
			<img src="/static/home/images/index/az.png">
		</p>
		<p class="app_type_icon app_type_apple">
			<img src="/static/home/images/index/pg1.png">
		</p>
		<p class="go_top">
			<img src="/static/home/images/index/zhiding.png">
		</p>
	</div>
	<div class="clearboth"></div>
</div>

</div>
<script type="text/javascript" src="/static/js/swiper/swiper.min.js"></script>  

<script>
$(function(){
	//图片延迟加载
	$("img.thumb").lazyload({effect: "fadeIn"});	

    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
        },
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: true,
        },
        loop : true
    });
})
</script>

<!-- 视频播放start -->
<script src="/static/xigua/xgplayer.js?t=1574906138" type="text/javascript"></script>
<script src="/static/xigua/xgplayer-flv.js.js" type="text/javascript"></script>
<script src="/static/xigua/xgplayer-hls.js.js" type="text/javascript"></script>
<script src="/static/xigua/player.js?t=1585644510" type="text/javascript"></script>

<!-- 视频播放end -->
<script type="text/javascript">
	$(function(){
		$(".index_live_area_right ul li").click(function(){
			if($(this).hasClass("on")){
				return;
			}
			$(this).siblings().removeClass("on");
			$(this).addClass("on");
            
			var pull=$(this).attr("data-pull");
            
			$(".video_mask a").attr("href","/"+$(this).attr("data-uid"));
			xgPlay('video_play',pull);
		});
        
        var firstLive=$(".index_live_area_right ul li")[0];
        if(firstLive){
            firstLive.click();
        }

		$(".index_live_area_left").mouseover(function() {
			$(".video_mask").show();
		});
		$(".index_live_area_left").mouseleave(function() {
			$(".video_mask").hide();
		});


		var apk_ewm='<?php echo $site_info['apk_ewm']; ?>';
		var ios_ewm='<?php echo $site_info['ipa_ewm']; ?>';

		$(".app_type_apple").mouseover(function(){
			$(this).find('img').attr("src","/static/home/images/index/pg.png");
			$(".app_type_android").find('img').attr("src","/static/home/images/index/az1.png");
			$(".ewm_img").find("img").attr("src",ios_ewm);
			$(".app_ewm_name").text("iOS App");
		});
			
		

		$(".app_type_apple").mouseleave(function(){
			$(this).find('img').attr("src","/static/home/images/index/pg1.png");
			$(".app_type_android").find('img').attr("src","/static/home/images/index/az.png");
			$(".ewm_img").find("img").attr("src",apk_ewm);
			$(".app_ewm_name").text("Android App");
		});

		$(".go_top").mouseover(function() {
			$(this).find("img").attr("src",'/static/home/images/index/zhiding1.png');
		});
		$(".go_top").mouseleave(function() {
			$(this).find("img").attr("src",'/static/home/images/index/zhiding.png');
		});
		
		$(".go_top").click(function(){
			document.body.scrollTop = 0;
    		document.documentElement.scrollTop = 0;
		});
	});
</script>
</body>
</html>