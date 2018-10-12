<?php
date_default_timezone_set('PRC');
set_time_limit(30);
$array =  array(
		"haotianw.com",
		"daishukuaipao.com",
		"ssydoa.com",
		"keendms.com",
);
$ip = "47.104.224.64";

//查询指定域名列表是否被封
query_domain($array,$ip);

 function query_domain($array,$ip){
	if(!$array){return;}
	$user = "293047a";
	$key = "149bada931ba91d2c7b6ddeaa61bd739";
    $forbbiden = array();
	foreach ($array as $k=>$v){	
		sleep(1);
		$api_url = "http://vip.weixin139.com/weixin/wx_domain.php?user=$user&key=$key&domain=".$v;
		$content = http_post($api_url);		
		$data = json_decode($content,true);			
		if($data['status']==2){ //域名被封
			$filename = 'forbbiden/' . $v . '.txt';
			if(!file_exists($filename)){
				file_put_contents($filename,$v);				
				send_sms($v,$ip);
			}
		}
	}	
}

function http_post($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_TIMEOUT,5);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	$data = curl_exec($ch);
	if($data){
		curl_close($ch);
		return $data;
	}else {
		$error = curl_errno($ch);
		curl_close($ch);
		return false;
	}
}

//短信通知
function send_sms($domain,$ip){
	if(!$domain&&$ip){
		return;
	}
	$domain = $domain."-$ip";
	require  './SUBMAIL_PHP_SDK-master/app_config.php';
	require_once './SUBMAIL_PHP_SDK-master/SUBMAILAutoload.php';
	
	$submessage  =new MESSAGEsend($message_configs);
	$submessage->setTo('13710325722');
	$submessage->SetContent("【来自火星的运维】您好，您的服务器{$domain}(域名)已经被封禁！");
	$result =$submessage->send();	
	echo '<pre>';
	var_dump($result);
	echo '</pre>';
}
?>

