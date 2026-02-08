<?php /*a:2:{s:77:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/admin/setting/configpri.html";i:1768747108;s:67:"/www/wwwroot/eliveadmin/themes/admin_simpleboot3/public/header.html";i:1768747123;}*/ ?>
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
.cdnhide{
	display:none;
}
.codehide{
	display:none;
}
</style>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#A" data-toggle="tab">基本设置</a></li>
        <li><a href="#B" data-toggle="tab">登录配置</a></li>
        <li><a href="#C" data-toggle="tab">直播配置</a></li>
        <li><a href="#D" data-toggle="tab">映票提现配置</a></li>
        <li><a href="#E" data-toggle="tab">推送配置</a></li>
        <li><a href="#F" data-toggle="tab">支付配置</a></li>
        <li><a href="#G" data-toggle="tab">邀请奖励</a></li>
        <li><a href="#H" data-toggle="tab">统计配置</a></li>
        <li><a href="#I" data-toggle="tab">视频配置</a></li>
<!--        <li><a href="#J" data-toggle="tab">店铺/商品配置</a></li>-->
        <li><a href="#K" data-toggle="tab">动态配置</a></li>
        <li><a href="#L" data-toggle="tab">游戏配置</a></li>
<!--        <li><a href="#M" data-toggle="tab">物流配置</a></li>-->
    </ul>
    <form class="form-horizontal js-ajax-form margin-top-20" role="form" action="<?php echo url('setting/configpriPost'); ?>" method="post">
        <fieldset>
            <div class="tabbable">
                <div class="tab-content">
                    <div class="tab-pane active" id="A">
                        <div class="form-group">
                            <label for="input-family_switch" class="col-sm-2 control-label">家族控制</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[family_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['family_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-family_member_divide_switch" class="col-sm-2 control-label">家族长修改成员分成比例是否管理员审核</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[family_member_divide_switch]">
                                    <option value="0">否</option>
                                    <option value="1" <?php if($config['family_member_divide_switch'] == '1'): ?>selected<?php endif; ?>>是</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-service_switch" class="col-sm-2 control-label">客服</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[service_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['service_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-service_url" class="col-sm-2 control-label">客服链接</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-service_url"
                                       name="options[service_url]" value="<?php echo (isset($config['service_url']) && ($config['service_url'] !== '')?$config['service_url']:''); ?>">
                                       <p class="help-block">注册链接：http://www.53kf.com/reg/index?yx_from=210260</p>
                            </div>
                        </div>
                        
                        <!--<div class="form-group">
                            <label for="input-sensitive_words" class="col-sm-2 control-label">敏感词</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" id="input-sensitive_words" name="options[sensitive_words]" ><?php echo (isset($config['sensitive_words']) && ($config['sensitive_words'] !== '')?$config['sensitive_words']:''); ?></textarea><p class="help-block">设置多个敏感字，请用英文状态下逗号隔开</p>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="1">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="B">
                        <div class="form-group">
                            <label for="input-reg_reward" class="col-sm-2 control-label">注册奖励</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-reg_reward"
                                       name="options[reg_reward]" value="<?php echo (isset($config['reg_reward']) && ($config['reg_reward'] !== '')?$config['reg_reward']:''); ?>">
                                       <p class="help-block">新用户注册奖励（整数）</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-bonus_switch" class="col-sm-2 control-label">登录奖励开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[bonus_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['bonus_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-login_wx_pc_appid" class="col-sm-2 control-label">PC 微信登录appid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_wx_pc_appid" name="options[login_wx_pc_appid]" value="<?php echo (isset($config['login_wx_pc_appid']) && ($config['login_wx_pc_appid'] !== '')?$config['login_wx_pc_appid']:''); ?>">  
                                <p class="help-block">PC 微信登录appid（微信开放平台网页应用 APPID） </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-login_wx_pc_appsecret" class="col-sm-2 control-label">PC 微信登录appsecret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_wx_pc_appsecret" name="options[login_wx_pc_appsecret]" value="<?php echo (isset($config['login_wx_pc_appsecret']) && ($config['login_wx_pc_appsecret'] !== '')?$config['login_wx_pc_appsecret']:''); ?>">
                                <p class="help-block">PC 微信登录appsecret（微信开放平台网页应用 AppSecret） </p>
                            </div>
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for="input-login_sina_pc_akey" class="col-sm-2 control-label">PC微博登陆akey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_sina_pc_akey" name="options[login_sina_pc_akey]" value="<?php echo (isset($config['login_sina_pc_akey']) && ($config['login_sina_pc_akey'] !== '')?$config['login_sina_pc_akey']:''); ?>">  PC 微信登录appsecret（微信开放平台网页应用 AppSecret） 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-login_sina_pc_skey" class="col-sm-2 control-label">PC新浪微博skey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_sina_pc_skey" name="options[login_sina_pc_skey]" value="<?php echo (isset($config['login_sina_pc_skey']) && ($config['login_sina_pc_skey'] !== '')?$config['login_sina_pc_skey']:''); ?>">  PC 微信登录appsecret（微信开放平台网页应用 AppSecret） 
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="input-login_wx_appid" class="col-sm-2 control-label">微信公众平台Appid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_wx_appid" name="options[login_wx_appid]" value="<?php echo (isset($config['login_wx_appid']) && ($config['login_wx_appid'] !== '')?$config['login_wx_appid']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-login_wx_appsecret" class="col-sm-2 control-label">微信公众平台AppSecret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_wx_appsecret" name="options[login_wx_appsecret]" value="<?php echo (isset($config['login_wx_appsecret']) && ($config['login_wx_appsecret'] !== '')?$config['login_wx_appsecret']:''); ?>"> 
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="input-ihuyi_account" class="col-sm-2 control-label">互亿无线APIID</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-ihuyi_account" name="options[ihuyi_account]" value="<?php echo (isset($config['ihuyi_account']) && ($config['ihuyi_account'] !== '')?$config['ihuyi_account']:''); ?>"> 短信验证码   http://www.ihuyi.com/  互亿无线后台-》验证码、短信通知-》账号及签名->APIID
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-ihuyi_ps" class="col-sm-2 control-label">互亿无线key</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-ihuyi_ps" name="options[ihuyi_ps]" value="<?php echo (isset($config['ihuyi_ps']) && ($config['ihuyi_ps'] !== '')?$config['ihuyi_ps']:''); ?>">  短信验证码 互亿无线后台-》验证码、短信通知-》账号及签名->APIKEY
                            </div>
                        </div> -->
                        
                        <div class="form-group">
                            <label for="input-sendcode_switch" class="col-sm-2 control-label">短信验证码开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[sendcode_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['sendcode_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                                <p class="help-block">短信验证码开关,关闭后不再发送真实验证码，采用默认验证码123456</p>
                            </div>
                        </div>
                       
						
                        <div class="form-group">
                            <label for="input-typecode_switch" class="col-sm-2 control-label">短信接口平台</label>
                            <div class="col-md-6 col-sm-10" id="duanxin">
                                <label class="radio-inline"><input type="radio" value="1" name="options[typecode_switch]" <?php if(in_array(($config['typecode_switch']), explode(',',"1"))): ?>checked="checked"<?php endif; ?>>阿里云</label>
                                <label class="radio-inline"><input type="radio" value="2" name="options[typecode_switch]" <?php if(in_array(($config['typecode_switch']), explode(',',"2"))): ?>checked="checked"<?php endif; ?>>容联云</label>
								<label class="radio-inline"><input type="radio" value="3" name="options[typecode_switch]" <?php if(in_array(($config['typecode_switch']), explode(',',"3"))): ?>checked="checked"<?php endif; ?>>云之讯</label>
                            </div>
                        </div>
						
                        <div class=" code_bd <?php if($config['typecode_switch'] != '1'): ?>codehide<?php endif; ?>" id="typecode_switch_1">
                            <div class="form-group">
								<label for="input-aly_keydi" class="col-sm-2 control-label">阿里云AccessKey ID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-aly_keydi" name="options[aly_keydi]" value="<?php echo (isset($config['aly_keydi']) && ($config['aly_keydi'] !== '')?$config['aly_keydi']:''); ?>">  阿里云控制台==》云通信-》短信服务==》 AccessKey ID 
								</div>
							</div>

							<div class="form-group">							
								<label for="input-aly_secret" class="col-sm-2 control-label">阿里云AccessKey Secret</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-aly_secret" name="options[aly_secret]" value="<?php echo (isset($config['aly_secret']) && ($config['aly_secret'] !== '')?$config['aly_secret']:''); ?>">  阿里云控制台==》云通信-》短信服务==》 AccessKey Secret 
								</div>
							</div>

							<div class="form-group">
								<label for="input-aly_signName" class="col-sm-2 control-label">阿里云短信签名</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-aly_signName" name="options[aly_signName]" value="<?php echo (isset($config['aly_signName']) && ($config['aly_signName'] !== '')?$config['aly_signName']:''); ?>">  阿里云控制台==》云通信-》短信服务==》 短信签名 
								</div>
							</div>

							<div class="form-group">							
								<label for="input-aly_templateCode" class="col-sm-2 control-label">阿里云短信模板ID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-aly_templateCode" name="options[aly_templateCode]" value="<?php echo (isset($config['aly_templateCode']) && ($config['aly_templateCode'] !== '')?$config['aly_templateCode']:''); ?>">  阿里云控制台==》云通信-》短信服务==》 短信模板ID  
								</div>
							</div>
                        
                        </div>
				
						<div class=" code_bd <?php if($config['typecode_switch'] != '2'): ?>codehide<?php endif; ?>" id="typecode_switch_2">
							<div class="form-group">
								<label for="input-ccp_sid" class="col-sm-2 control-label">容联云ACCOUNT SID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-ccp_sid" name="options[ccp_sid]" value="<?php echo (isset($config['ccp_sid']) && ($config['ccp_sid'] !== '')?$config['ccp_sid']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-ccp_token" class="col-sm-2 control-label">容联云AUTH TOKEN</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-ccp_token" name="options[ccp_token]" value="<?php echo (isset($config['ccp_token']) && ($config['ccp_token'] !== '')?$config['ccp_token']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-ccp_appid" class="col-sm-2 control-label">容联云应用APPID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-ccp_appid" name="options[ccp_appid]" value="<?php echo (isset($config['ccp_appid']) && ($config['ccp_appid'] !== '')?$config['ccp_appid']:''); ?>"> 
								</div>
							</div>
							<div class="form-group">
								<label for="input-ccp_tempid" class="col-sm-2 control-label">容联云短信模板ID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-ccp_tempid" name="options[ccp_tempid]" value="<?php echo (isset($config['ccp_tempid']) && ($config['ccp_tempid'] !== '')?$config['ccp_tempid']:''); ?>"> 
								</div>
							</div>
                        </div>
                        

						<div class=" code_bd <?php if($config['typecode_switch'] != '3'): ?>codehide<?php endif; ?>" id="typecode_switch_3">
							<div class="form-group">
								<label for="input-app_id" class="col-sm-3 control-label">云之讯 APPID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-app_id" name="options[app_id]" value="<?php echo (isset($config['app_id']) && ($config['app_id'] !== '')?$config['app_id']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-account_sid" class="col-sm-3 control-label">云之讯 ACCOUNT SID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-account_sid" name="options[account_sid]" value="<?php echo (isset($config['account_sid']) && ($config['account_sid'] !== '')?$config['account_sid']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-auth_token" class="col-sm-3 control-label">云之讯 AUTH TOKEN</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-auth_token" name="options[auth_token]" value="<?php echo (isset($config['auth_token']) && ($config['auth_token'] !== '')?$config['auth_token']:''); ?>"> 
								</div>
							</div>
							<div class="form-group">
								<label for="input-rzx_tempid" class="col-sm-3 control-label">云之讯模板ID</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-rzx_tempid" name="options[rzx_tempid]" value="<?php echo (isset($config['rzx_tempid']) && ($config['rzx_tempid'] !== '')?$config['rzx_tempid']:''); ?>"> 
								</div>
							</div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="input-iplimit_switch" class="col-sm-2 control-label">短信验证码IP限制开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[iplimit_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['iplimit_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-iplimit_times" class="col-sm-2 control-label">短信验证码IP限制次数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-iplimit_times" name="options[iplimit_times]" value="<?php echo (isset($config['iplimit_times']) && ($config['iplimit_times'] !== '')?$config['iplimit_times']:''); ?>"> 
                                <p class="help-block">同一IP每天可以发送验证码的最大次数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="C">
                        <div class="form-group">
                            <label for="input-auth_islimit" class="col-sm-2 control-label">认证限制</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[auth_islimit]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['auth_islimit'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                                <p class="help-block">主播开播是否需要身份认证</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-level_islimit" class="col-sm-2 control-label">直播等级控制</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[level_islimit]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['level_islimit'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                                <p class="help-block">直播等级控制是否开启</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-level_limit" class="col-sm-2 control-label">直播限制等级</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-level_limit" name="options[level_limit]" value="<?php echo (isset($config['level_limit']) && ($config['level_limit'] !== '')?$config['level_limit']:''); ?>"> 
                                <p class="help-block">直播等级限制开启时，最低开播等级（用户等级）</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-speak_limit" class="col-sm-2 control-label">发言等级限制</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-speak_limit" name="options[speak_limit]" value="<?php echo (isset($config['speak_limit']) && ($config['speak_limit'] !== '')?$config['speak_limit']:''); ?>">
                                <p class="help-block"> 0表示无限制</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-barrage_limit" class="col-sm-2 control-label">弹幕等级限制</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-barrage_limit" name="options[barrage_limit]" value="<?php echo (isset($config['barrage_limit']) && ($config['barrage_limit'] !== '')?$config['barrage_limit']:''); ?>"> <p class="help-block">0表示无限制</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-barrage_fee" class="col-sm-2 control-label">弹幕费用</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-barrage_fee" name="options[barrage_fee]" value="<?php echo (isset($config['barrage_fee']) && ($config['barrage_fee'] !== '')?$config['barrage_fee']:''); ?>"> 
                                <p class="help-block">每条弹幕的价格（整数）</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-userlist_time" class="col-sm-2 control-label">用户列表请求间隔(秒)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-userlist_time" name="options[userlist_time]" value="<?php echo (isset($config['userlist_time']) && ($config['userlist_time'] !== '')?$config['userlist_time']:''); ?>"> <p class="help-block">直播间用户列表刷新间隔时间  注：不小于5s</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-mic_limit" class="col-sm-2 control-label">连麦等级限制</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-mic_limit" name="options[mic_limit]" value="<?php echo (isset($config['mic_limit']) && ($config['mic_limit'] !== '')?$config['mic_limit']:''); ?>"> 
                               <p class="help-block"> 0表示无限制</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-chatserver" class="col-sm-2 control-label">聊天服务器带端口</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-chatserver" name="options[chatserver]" value="<?php echo (isset($config['chatserver']) && ($config['chatserver'] !== '')?$config['chatserver']:''); ?>"> 
                               <p class="help-block"> 格式：http://域名(:端口) 或者 http://IP(:端口)</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-live_sdk" class="col-sm-2 control-label">模式选择</label>
                            <div class="col-md-6 col-sm-10" id="sdk">
                                <label class="radio-inline"><input type="radio" value="0" name="options[live_sdk]" <?php if(in_array(($config['live_sdk']), explode(',',"0"))): ?>checked="checked"<?php endif; ?>>直播模式</label>
                                <label class="radio-inline"><input type="radio" value="1" name="options[live_sdk]" <?php if(in_array(($config['live_sdk']), explode(',',"1"))): ?>checked="checked"<?php endif; ?>>直播+连麦模式</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-cdn_switch" class="col-sm-2 control-label">CDN</label>
                            <div class="col-md-6 col-sm-10" id="cdn">
                                <label class="radio-inline"><input type="radio" value="1" name="options[cdn_switch]" <?php if(in_array(($config['cdn_switch']), explode(',',"1"))): ?>checked="checked"<?php endif; if(in_array(($config['live_sdk']), explode(',',"1"))): ?>disabled<?php endif; ?>>阿里云</label>
                                <label class="radio-inline"><input type="radio" value="2" name="options[cdn_switch]" <?php if(in_array(($config['cdn_switch']), explode(',',"2"))): ?>checked="checked"<?php endif; ?>>腾讯云</label>
                                <label class="radio-inline"><input type="radio" value="3" name="options[cdn_switch]" <?php if(in_array(($config['cdn_switch']), explode(',',"3"))): ?>checked="checked"<?php endif; if(in_array(($config['live_sdk']), explode(',',"1"))): ?>disabled<?php endif; ?>>七牛云</label>
                                <label class="radio-inline"><input type="radio" value="4" name="options[cdn_switch]" <?php if(in_array(($config['cdn_switch']), explode(',',"4"))): ?>checked="checked"<?php endif; if(in_array(($config['live_sdk']), explode(',',"1"))): ?>disabled<?php endif; ?>>网宿</label>
                                <label class="radio-inline"><input type="radio" value="5" name="options[cdn_switch]" <?php if(in_array(($config['cdn_switch']), explode(',',"5"))): ?>checked="checked"<?php endif; if(in_array(($config['live_sdk']), explode(',',"1"))): ?>disabled<?php endif; ?>>网易云</label>
                                <label class="radio-inline"><input type="radio" value="6" name="options[cdn_switch]" <?php if(in_array(($config['cdn_switch']), explode(',',"6"))): ?>checked="checked"<?php endif; if(in_array(($config['live_sdk']), explode(',',"1"))): ?>disabled<?php endif; ?>>奥点云</label>
                            </div>
                        </div>

                        <div class="cdn_bd <?php if($config['cdn_switch'] != '1'): ?>cdnhide<?php endif; ?>" id="cdn_switch_1">
                             <div class="form-group">
                                <label for="input-push_url" class="col-sm-2 control-label">推流服务器地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-push_url" name="options[push_url]" value="<?php echo (isset($config['push_url']) && ($config['push_url'] !== '')?$config['push_url']:''); ?>"> 
                                    <p class="help-block">格式：域名(:端口) 或者 IP(:端口)</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-auth_key_push" class="col-sm-2 control-label">推流鉴权KEY</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-auth_key_push" name="options[auth_key_push]" value="<?php echo (isset($config['auth_key_push']) && ($config['auth_key_push'] !== '')?$config['auth_key_push']:''); ?>"> 
                                    <p class="help-block">推流鉴权KEY 留空表示不启用</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-auth_length_push" class="col-sm-2 control-label">推流鉴权有效时长</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-auth_length_push" name="options[auth_length_push]" value="<?php echo (isset($config['auth_length_push']) && ($config['auth_length_push'] !== '')?$config['auth_length_push']:''); ?>"> 
                                    <p class="help-block">推流鉴权有效时长（秒）</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-pull_url" class="col-sm-2 control-label">播流服务器地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-pull_url" name="options[pull_url]" value="<?php echo (isset($config['pull_url']) && ($config['pull_url'] !== '')?$config['pull_url']:''); ?>"> 
                                    <p class="help-block">格式：域名(:端口) 或者 IP(:端口)</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-auth_key_pull" class="col-sm-2 control-label">播流鉴权KEY</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-auth_key_pull" name="options[auth_key_pull]" value="<?php echo (isset($config['auth_key_pull']) && ($config['auth_key_pull'] !== '')?$config['auth_key_pull']:''); ?>"> 
                                    <p class="help-block">播流鉴权KEY 留空表示不启用</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-auth_length_pull" class="col-sm-2 control-label">播流鉴权有效时长</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-auth_length_pull" name="options[auth_length_pull]" value="<?php echo (isset($config['auth_length_pull']) && ($config['auth_length_pull'] !== '')?$config['auth_length_pull']:''); ?>"> 
                                    <p class="help-block">播流鉴权有效时长（秒）</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-aliy_key_id" class="col-sm-2 control-label">阿里云AccessKey ID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aliy_key_id" name="options[aliy_key_id]" value="<?php echo (isset($config['aliy_key_id']) && ($config['aliy_key_id'] !== '')?$config['aliy_key_id']:''); ?>">
                                    <p class="help-block"> 回放用</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-aliy_key_secret" class="col-sm-2 control-label">阿里云AccessKey Secret</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aliy_key_secret" name="options[aliy_key_secret]" value="<?php echo (isset($config['aliy_key_secret']) && ($config['aliy_key_secret'] !== '')?$config['aliy_key_secret']:''); ?>">
                                    <p class="help-block"> 回放用</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="cdn_bd <?php if($config['cdn_switch'] != '2'): ?>cdnhide<?php endif; ?>" id="cdn_switch_2">
                            <div class="form-group">
                                <label for="input-tx_appid" class="col-sm-2 control-label">腾讯云直播appid</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_appid" name="options[tx_appid]" value="<?php echo (isset($config['tx_appid']) && ($config['tx_appid'] !== '')?$config['tx_appid']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_bizid" class="col-sm-2 control-label">腾讯云直播bizid</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_bizid" name="options[tx_bizid]" value="<?php echo (isset($config['tx_bizid']) && ($config['tx_bizid'] !== '')?$config['tx_bizid']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_push_key" class="col-sm-2 control-label">腾讯云推流防盗链Key</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_push_key" name="options[tx_push_key]" value="<?php echo (isset($config['tx_push_key']) && ($config['tx_push_key'] !== '')?$config['tx_push_key']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_acc_key" class="col-sm-2 control-label">腾讯云直播低延迟Key</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_acc_key" name="options[tx_acc_key]" value="<?php echo (isset($config['tx_acc_key']) && ($config['tx_acc_key'] !== '')?$config['tx_acc_key']:''); ?>">
                                    <p class="help-block">一般是 直播推流防盗链Key</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_api_key" class="col-sm-2 control-label">腾讯云直播推流鉴权key</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_api_key" name="options[tx_api_key]" value="<?php echo (isset($config['tx_api_key']) && ($config['tx_api_key'] !== '')?$config['tx_api_key']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_play_key" class="col-sm-2 control-label">腾讯云直播播流鉴权key</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_play_key" name="options[tx_play_key]" value="<?php echo (isset($config['tx_play_key']) && ($config['tx_play_key'] !== '')?$config['tx_play_key']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_play_time" class="col-sm-2 control-label">腾讯云直播播流鉴权时间(秒)</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_play_time" name="options[tx_play_time]" value="<?php echo (isset($config['tx_play_time']) && ($config['tx_play_time'] !== '')?$config['tx_play_time']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_play_key_switch" class="col-sm-2 control-label">是否开启腾讯云播流鉴权</label>
                                <div class="col-md-6 col-sm-10" id="sdk">
                                    <label class="radio-inline"><input type="radio" value="0" name="options[tx_play_key_switch]" <?php if(array_key_exists('tx_play_key_switch',$config) && $config['tx_play_key_switch'] == '0'): ?>checked="checked" <?php endif; ?>>关闭</label>
                                    <label class="radio-inline"><input type="radio" value="1" name="options[tx_play_key_switch]" <?php if(array_key_exists('tx_play_key_switch',$config) && $config['tx_play_key_switch'] == '1'): ?>checked="checked" <?php endif; ?>>开启</label>
                                    <p class="help-block">如果选择开启，请确保腾讯云-->云直播-->域名管理--><?php echo (isset($config['tx_pull']) && ($config['tx_pull'] !== '')?$config['tx_pull']:''); ?>-->管理-->访问控制-->鉴权配置 里的信息开启了配置,并保持腾讯云填写的鉴权key和鉴权时间与此处填写的一致,参考文档：<a href="https://cloud.tencent.com/document/product/267/32463" target="_blank">https://cloud.tencent.com/document/product/267/32463</a></p>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label for="input-play_pop_text_switch" class="col-sm-2 control-label">是否开启弹幕</label>
                                <div class="col-md-6 col-sm-10">
                                    <label class="radio-inline"><input type="radio" value="0" name="options[play_pop_text_switch]" <?php if(array_key_exists('play_pop_text_switch',$config) && $config['play_pop_text_switch'] == '0'): ?>checked="checked" <?php endif; ?>>关闭</label>
                                    <label class="radio-inline"><input type="radio" value="1" name="options[play_pop_text_switch]" <?php if(array_key_exists('play_pop_text_switch',$config) && $config['play_pop_text_switch'] == '1'): ?>checked="checked" <?php endif; ?>>开启</label>                                    
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label for="input-tx_push" class="col-sm-2 control-label">腾讯云直播推流域名</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_push" name="options[tx_push]" value="<?php echo (isset($config['tx_push']) && ($config['tx_push'] !== '')?$config['tx_push']:''); ?>">
                                    <p class="help-block"> 需要加上rtmp:// ,最后无 /</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-tx_pull" class="col-sm-2 control-label">腾讯云直播播流域名</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-tx_pull" name="options[tx_pull]" value="<?php echo (isset($config['tx_pull']) && ($config['tx_pull'] !== '')?$config['tx_pull']:''); ?>">
                                    <p class="help-block"> 需要加上https:// ,最后无 /</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-txcloud_secret_id" class="col-sm-2 control-label">腾讯云Api密钥SecretId</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-txcloud_secret_id" name="options[txcloud_secret_id]" value="<?php echo (isset($config['txcloud_secret_id']) && ($config['txcloud_secret_id'] !== '')?$config['txcloud_secret_id']:''); ?>">
                                    <p class="help-block">腾讯云连麦混流时身份验证，只在直播+连麦模式时才需要配置，获取方式：腾讯云后台-->用户登录账号下拉菜单-->访问管理-->访问密钥-->API密钥管理</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-txcloud_secret_key" class="col-sm-2 control-label">腾讯云Api密钥SecretKey</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-txcloud_secret_key" name="options[txcloud_secret_key]" value="<?php echo (isset($config['txcloud_secret_key']) && ($config['txcloud_secret_key'] !== '')?$config['txcloud_secret_key']:''); ?>">
                                    <p class="help-block">腾讯云连麦混流时身份验证，只在直播+连麦模式时才需要配置，获取方式：腾讯云后台-->用户登录账号下拉菜单-->访问管理-->访问密钥-->API密钥管理</p>
                                </div>
                            </div>
                            
                        </div>

                        <div class="cdn_bd <?php if($config['cdn_switch'] != '3'): ?>cdnhide<?php endif; ?>" id="cdn_switch_3">
                            <div class="form-group">
                                <label for="input-qn_ak" class="col-sm-2 control-label">七牛云AccessKey</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-qn_ak" name="options[qn_ak]" value="<?php echo (isset($config['qn_ak']) && ($config['qn_ak'] !== '')?$config['qn_ak']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-qn_sk" class="col-sm-2 control-label">七牛云SecretKey</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-qn_sk" name="options[qn_sk]" value="<?php echo (isset($config['qn_sk']) && ($config['qn_sk'] !== '')?$config['qn_sk']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-qn_hname" class="col-sm-2 control-label">七牛云直播空间名称</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-qn_hname" name="options[qn_hname]" value="<?php echo (isset($config['qn_hname']) && ($config['qn_hname'] !== '')?$config['qn_hname']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-qn_push" class="col-sm-2 control-label">七牛云推流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-qn_push" name="options[qn_push]" value="<?php echo (isset($config['qn_push']) && ($config['qn_push'] !== '')?$config['qn_push']:''); ?>"> 
                                    <p class="help-block">七牛云直播云域名管理中RTMP推流域名</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-qn_pull" class="col-sm-2 control-label">七牛云播流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-qn_pull" name="options[qn_pull]" value="<?php echo (isset($config['qn_pull']) && ($config['qn_pull'] !== '')?$config['qn_pull']:''); ?>"> 
                                    <p class="help-block">七牛云直播云域名管理中RTMP播流域名</p>
                                </div>
                            </div>
                        </div>

                        <div class="cdn_bd <?php if($config['cdn_switch'] != '4'): ?>cdnhide<?php endif; ?>" id="cdn_switch_4">
                            <div class="form-group">
                                <label for="input-ws_push" class="col-sm-2 control-label">网宿推流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ws_push" name="options[ws_push]" value="<?php echo (isset($config['ws_push']) && ($config['ws_push'] !== '')?$config['ws_push']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-ws_pull" class="col-sm-2 control-label">网宿播流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ws_pull" name="options[ws_pull]" value="<?php echo (isset($config['ws_pull']) && ($config['ws_pull'] !== '')?$config['ws_pull']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-ws_apn" class="col-sm-2 control-label">网宿AppName</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ws_apn" name="options[ws_apn]" value="<?php echo (isset($config['ws_apn']) && ($config['ws_apn'] !== '')?$config['ws_apn']:''); ?>"> 
                                </div>
                            </div>
                        </div>

                        <div class="cdn_bd <?php if($config['cdn_switch'] != '5'): ?>cdnhide<?php endif; ?>" id="cdn_switch_5">
                            <div class="form-group">
                                <label for="input-wy_appkey" class="col-sm-2 control-label">网易cdn Appkey</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-wy_appkey" name="options[wy_appkey]" value="<?php echo (isset($config['wy_appkey']) && ($config['wy_appkey'] !== '')?$config['wy_appkey']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-wy_appsecret" class="col-sm-2 control-label">网易cdn AppSecret</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-wy_appsecret" name="options[wy_appsecret]" value="<?php echo (isset($config['wy_appsecret']) && ($config['wy_appsecret'] !== '')?$config['wy_appsecret']:''); ?>"> 
                                </div>
                            </div>
                        </div>

                        <div class="cdn_bd <?php if($config['cdn_switch'] != '6'): ?>cdnhide<?php endif; ?>" id="cdn_switch_6">
                            <div class="form-group">
                                <label for="input-ady_push" class="col-sm-2 control-label">奥点云推流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ady_push" name="options[ady_push]" value="<?php echo (isset($config['ady_push']) && ($config['ady_push'] !== '')?$config['ady_push']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-ady_pull" class="col-sm-2 control-label">奥点云播流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ady_pull" name="options[ady_pull]" value="<?php echo (isset($config['ady_pull']) && ($config['ady_pull'] !== '')?$config['ady_pull']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-ady_hls_pull" class="col-sm-2 control-label">奥点云HLS播流地址</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ady_hls_pull" name="options[ady_hls_pull]" value="<?php echo (isset($config['ady_hls_pull']) && ($config['ady_hls_pull'] !== '')?$config['ady_hls_pull']:''); ?>"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-ady_apn" class="col-sm-2 control-label">奥点云AppName</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ady_apn" name="options[ady_apn]" value="<?php echo (isset($config['ady_apn']) && ($config['ady_apn'] !== '')?$config['ady_apn']:''); ?>"> 
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="D">
                        <div class="form-group">
                            <label for="input-cash_rate" class="col-sm-2 control-label">提现比例</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_rate" name="options[cash_rate]" value="<?php echo (isset($config['cash_rate']) && ($config['cash_rate'] !== '')?$config['cash_rate']:''); ?>">
                                <p class="help-block">提现一元人民币需要的票数</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-cash_min" class="col-sm-2 control-label">提现最低额度（元）</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_min" name="options[cash_min]" value="<?php echo (isset($config['cash_min']) && ($config['cash_min'] !== '')?$config['cash_min']:''); ?>">
                                <p class="help-block">可提现的最小额度，低于该额度无法提现</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-cash_start" class="col-sm-2 control-label">每月提现期</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_start" name="options[cash_start]" value="<?php echo (isset($config['cash_start']) && ($config['cash_start'] !== '')?$config['cash_start']:''); ?>" style="width:100px;display:inline-block;"> - 
                                <input type="text" class="form-control" id="input-cash_end" name="options[cash_end]" value="<?php echo (isset($config['cash_end']) && ($config['cash_end'] !== '')?$config['cash_end']:''); ?>" style="width:100px;display:inline-block;">
                                <p class="help-block">每月提现期限，不在时间段无法提现</p> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-cash_max_times" class="col-sm-2 control-label">每月提现次数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_max_times" name="options[cash_max_times]" value="<?php echo (isset($config['cash_max_times']) && ($config['cash_max_times'] !== '')?$config['cash_max_times']:''); ?>">
                                <p class="help-block">每月可提现最大次数，0表示不限制</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="E">
                        <div class="form-group">
                            <label for="input-letter_switch" class="col-sm-2 control-label">私信开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[letter_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['letter_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                                <p class="help-block">关闭后用户间不可私信</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-jpush_sandbox" class="col-sm-2 control-label">极光推送模式</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[jpush_sandbox]">
                                    <option value="0">开发</option>
                                    <option value="1" <?php if($config['jpush_sandbox'] == '1'): ?>selected<?php endif; ?>>生产</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-jpush_key" class="col-sm-2 control-label">极光推送APP_KEY</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-jpush_key" name="options[jpush_key]" value="<?php echo (isset($config['jpush_key']) && ($config['jpush_key'] !== '')?$config['jpush_key']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-jpush_secret" class="col-sm-2 control-label">极光推送master_secret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-jpush_secret" name="options[jpush_secret]" value="<?php echo (isset($config['jpush_secret']) && ($config['jpush_secret'] !== '')?$config['jpush_secret']:''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="F">
                        <div class="form-group">
                            <label for="input-aliapp_switch" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值支付宝APP开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[aliapp_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['aliapp_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                                <p class="help-block">支付宝APP支付是否开启</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-aliapp_partner" class="col-sm-2 control-label">支付宝合作者身份ID</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-aliapp_partner" name="options[aliapp_partner]" value="<?php echo (isset($config['aliapp_partner']) && ($config['aliapp_partner'] !== '')?$config['aliapp_partner']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-aliapp_seller_id" class="col-sm-2 control-label">支付宝登录账号</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-aliapp_seller_id" name="options[aliapp_seller_id]" value="<?php echo (isset($config['aliapp_seller_id']) && ($config['aliapp_seller_id'] !== '')?$config['aliapp_seller_id']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-aliapp_key_android" class="col-sm-2 control-label">支付宝安卓密钥</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" id="input-aliapp_key_android" name="options[aliapp_key_android]" ><?php echo (isset($config['aliapp_key_android']) && ($config['aliapp_key_android'] !== '')?$config['aliapp_key_android']:''); ?></textarea>
                                <p class="help-block">支付宝安卓密钥pkcs8</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-aliapp_key_ios" class="col-sm-2 control-label">支付宝苹果密钥</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" id="input-aliapp_key_ios" name="options[aliapp_key_ios]" ><?php echo (isset($config['aliapp_key_ios']) && ($config['aliapp_key_ios'] !== '')?$config['aliapp_key_ios']:''); ?></textarea>
                                <p class="help-block">支付宝苹果密钥pkcs8</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-aliapp_pc" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值支付宝PC开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[aliapp_pc]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['aliapp_pc'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-aliapp_check" class="col-sm-2 control-label">支付宝校验码</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-aliapp_check" name="options[aliapp_check]" value="<?php echo (isset($config['aliapp_check']) && ($config['aliapp_check'] !== '')?$config['aliapp_check']:''); ?>">
                                <p class="help-block">支付宝校验码（PC扫码支付）（对应为 开放平台=》mapi网关产品=》MD5密钥）</p>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="input-wx_switch_pc" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值微信支付PC开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[wx_switch_pc]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['wx_switch_pc'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-wx_switch" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值微信支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[wx_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['wx_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-wx_appid" class="col-sm-2 control-label">微信开放平台移动应用AppID</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_appid" name="options[wx_appid]" value="<?php echo (isset($config['wx_appid']) && ($config['wx_appid'] !== '')?$config['wx_appid']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-wx_appsecret" class="col-sm-2 control-label">微信开放平台移动应用appsecret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_appsecret" name="options[wx_appsecret]" value="<?php echo (isset($config['wx_appsecret']) && ($config['wx_appsecret'] !== '')?$config['wx_appsecret']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-wx_mchid" class="col-sm-2 control-label">微信商户号mchid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_mchid" name="options[wx_mchid]" value="<?php echo (isset($config['wx_mchid']) && ($config['wx_mchid'] !== '')?$config['wx_mchid']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-wx_key" class="col-sm-2 control-label">微信密钥key</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_key" name="options[wx_key]" value="<?php echo (isset($config['wx_key']) && ($config['wx_key'] !== '')?$config['wx_key']:''); ?>">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="input-shop_aliapp_switch" class="col-sm-2 control-label">店铺支付宝支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[shop_aliapp_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['shop_aliapp_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_wx_switch" class="col-sm-2 control-label">店铺微信支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[shop_wx_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['shop_wx_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_balance_switch" class="col-sm-2 control-label">店铺余额支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[shop_balance_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['shop_balance_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-paidprogram_aliapp_switch" class="col-sm-2 control-label">付费内容支付宝支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[paidprogram_aliapp_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['paidprogram_aliapp_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-paidprogram_wx_switch" class="col-sm-2 control-label">付费内容微信支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[paidprogram_wx_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['paidprogram_wx_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-paidprogram_balance_switch" class="col-sm-2 control-label">付费内容余额支付APP开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[paidprogram_balance_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['paidprogram_balance_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="G">
                        <div class="form-group">
                            <label for="input-agent_switch" class="col-sm-2 control-label">邀请开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[agent_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['agent_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-distribut1" class="col-sm-2 control-label">一级分成</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-distribut1" name="options[distribut1]" value="<?php echo (isset($config['distribut1']) && ($config['distribut1'] !== '')?$config['distribut1']:''); ?>">%
                                <p class="help-block">一级分成(整数) 注：比例小于40%</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="H">
                        <div class="form-group">
                            <label for="input-um_apikey" class="col-sm-2 control-label">友盟OpenApi-apiKey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_apikey" name="options[um_apikey]" value="<?php echo (isset($config['um_apikey']) && ($config['um_apikey'] !== '')?$config['um_apikey']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-um_apisecurity" class="col-sm-2 control-label">友盟OpenApi-apiSecurity</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_apisecurity" name="options[um_apisecurity]" value="<?php echo (isset($config['um_apisecurity']) && ($config['um_apisecurity'] !== '')?$config['um_apisecurity']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-um_appkey_android" class="col-sm-2 control-label">友盟Android应用-appkey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_appkey_android" name="options[um_appkey_android]" value="<?php echo (isset($config['um_appkey_android']) && ($config['um_appkey_android'] !== '')?$config['um_appkey_android']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-um_appkey_ios" class="col-sm-2 control-label">友盟IOS应用-appkey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_appkey_ios" name="options[um_appkey_ios]" value="<?php echo (isset($config['um_appkey_ios']) && ($config['um_appkey_ios'] !== '')?$config['um_appkey_ios']:''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="I">
                        
                        <div class="form-group">
                            <label for="input-video_audit_switch" class="col-sm-2 control-label">视频审核开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[video_audit_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['video_audit_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="input-video_watermark" class="col-sm-2 control-label">视频水印图片</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="hidden" name="options[video_watermark]" id="thumbnail2" value="<?php echo (isset($config['video_watermark']) && ($config['video_watermark'] !== '')?$config['video_watermark']:''); ?>">
                                <a href="javascript:uploadOneImage('图片上传','#thumbnail2','','configpri');">
                                    <?php if(empty($config['video_watermark'])): ?>
                                    <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                             id="thumbnail2-preview"
                                             style="cursor: pointer;max-width:150px;max-height:150px;"/>
                                    <?php else: ?>
                                    <img src="<?php echo cmf_get_image_preview_url($config['video_watermark']); ?>"
                                         id="thumbnail2-preview"
                                         style="cursor: pointer;max-width:150px;max-height:150px;"/>
                                    <?php endif; ?>
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-thumbnail2" value="取消图片">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="K">
                        <div class="form-group">
                            <label for="input-dynamic_auth" class="col-sm-2 control-label">动态认证开关</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[dynamic_auth]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['dynamic_auth'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-dynamic_switch" class="col-sm-2 control-label">动态审核</label>
                            <div class="col-md-6 col-sm-10">
								<select class="form-control" name="options[dynamic_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['dynamic_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-comment_weight" class="col-sm-2 control-label">评论权重值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-comment_weight" name="options[comment_weight]" value="<?php echo (isset($config['comment_weight']) && ($config['comment_weight'] !== '')?$config['comment_weight']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-like_weight" class="col-sm-2 control-label">点赞权重值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-like_weight" name="options[like_weight]" value="<?php echo (isset($config['like_weight']) && ($config['like_weight'] !== '')?$config['like_weight']:''); ?>">
                            </div>
                        </div>
                        
                        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="L">
                        <div class="form-group">
                            <label for="input-dynamic_auth" class="col-sm-2 control-label"></label>
                            <div class="col-md-6 col-sm-10">
								<span style="color:#ff0000">系统干预：人为控制游戏结果，保证平台收益<br>
                                    &nbsp;&nbsp;&nbsp;当进行系统干预时，<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;普通游戏：总是下注金额最少的位置获胜<br>
                                    <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上庄游戏：庄家全胜<br> -->
                                    &nbsp;&nbsp;&nbsp;&nbsp;不进行系统干预时：<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏结果完全随机
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-shop_fans" class="col-sm-2 control-label">游戏开关</label>
                            <div class="col-md-6 col-sm-10">
                                <?php 
									$game1='1';
									$game3='3';
									$game4='4';
								 ?>
								<label class="checkbox-inline"><input type="checkbox" value="1" name="game_switch[]" <?php if(in_array(($game1), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>智勇三张</label>
								<label class="checkbox-inline"><input type="checkbox" value="3" name="game_switch[]" <?php if(in_array(($game3), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>转盘</label>
								<label class="checkbox-inline" style="display:none;"><input type="checkbox" value="4" name="game_switch[]" <?php if(in_array(($game4), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>开心牛仔</label>
                            </div>
                        </div>
                        
                        
                        <div class="form-group" style="display:none;">
                            <label for="input-game_banker_limit" class="col-sm-2 control-label">上庄限制</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-game_banker_limit" name="options[game_banker_limit]" value="<?php echo (isset($config['game_banker_limit']) && ($config['game_banker_limit'] !== '')?$config['game_banker_limit']:''); ?>"> 上庄游戏 申请上庄的用户拥有的钻石数的最低值
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-game_odds" class="col-sm-2 control-label">普通游戏赔率</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-game_odds" name="options[game_odds]" value="<?php echo (isset($config['game_odds']) && ($config['game_odds'] !== '')?$config['game_odds']:''); ?>">% 
                                <p class="help-block">游戏结果不进行系统干预的概率，0 表示 完全进行 系统干预，平台绝对不会赔，100 表示完全随机</p>
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                            <label for="input-game_odds_p" class="col-sm-2 control-label">系统坐庄游戏赔率</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-game_odds_p" name="options[game_odds_p]" value="<?php echo (isset($config['game_odds_p']) && ($config['game_odds_p'] !== '')?$config['game_odds_p']:''); ?>">% 
                                <p class="help-block">游戏结果不进行系统干预的概率 0 表示 完全进行 系统干预，庄家绝对不会赔，100 表示完全随机</p>
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                            <label for="input-game_odds_u" class="col-sm-2 control-label">用户坐庄游戏赔率</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-game_odds_u" name="options[game_odds_u]" value="<?php echo (isset($config['game_odds_u']) && ($config['game_odds_u'] !== '')?$config['game_odds_u']:''); ?>">% 
                                <p class="help-block">游戏结果不进行系统干预的概率 0 表示 完全进行 系统干预，庄家绝对不会赔，100 表示完全随机</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-game_pump" class="col-sm-2 control-label">游戏抽水</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-game_pump" name="options[game_pump]" value="<?php echo (isset($config['game_pump']) && ($config['game_pump'] !== '')?$config['game_pump']:''); ?>">% 
                                <p class="help-block">用户获胜后，去除本金部分的抽成比例 </p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-turntable_switch" class="col-sm-2 control-label">直播间大转盘开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[turntable_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['turntable_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin.js"></script>
<script>
(function(){

    $('.btn-cancel-thumbnail2').click(function () {
        $('#thumbnail2-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
        $('#thumbnail2').val('');
    });
    

    $("#sdk label").on('click',function(){
        var v=$("input",this).val();
        if(v==1){
            $("#cdn label input[type=radio]").attr('disabled','disabled');
            $("#cdn label input[type=radio][value=2]").removeAttr('disabled');
            $("#cdn label").eq(1).click();
        }else{
            $("#cdn label input[type=radio]").removeAttr('disabled');
        }
    })
    
    $("#cdn label").on('click',function(){
        var v_d=$("input",this).attr('disabled');
        if(v_d=='disabled'){
            return !1;
        }
        var v=$("input",this).val();
        var b=$("#cdn_switch_"+v);
        $(".cdn_bd").hide();
        b.show();
    })
    
    $("#cloudtype label").on('click',function(){
        var v=$("input",this).val();
        var b=$("#cloudtype_"+v);
        $(".cloudtype_bd").siblings('.cloudtype_bd').hide();
        b.show();
    })
	
	$("#duanxin label").on('click',function(){
        var v_d=$("input",this).attr('disabled');
        if(v_d=='disabled'){
            return !1;
        }
        var v=$("input",this).val();
        var b=$("#typecode_switch_"+v);
        $(".code_bd").hide();
        b.show();
    })

       
    
})()
</script>
</body>
</html>
