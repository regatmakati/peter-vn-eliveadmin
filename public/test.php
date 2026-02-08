<?php
	$time = time();
	$url = "https://sports.dawnbyte.com/basketball/api/live/video/ex?begin_id=425390&limit=1&time_stamp={$time}";
	$header =array(
		"Content-Type:application/json;charset=utf-8",
		"Token:XUDngIHknEwn3tmLDejNMMO5xIhbcEjXo8tmoUrETO7PsbyALc"
	);

	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	$tmpInfo = curl_exec($curl);
	curl_close($curl);
	$return = json_decode($tmpInfo,true);
	echo '<pre>';
	print_r($return['result'][0]['live_streams']);//
	echo '</pre>';