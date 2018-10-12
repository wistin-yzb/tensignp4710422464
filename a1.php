<?php
date_default_timezone_set('PRC');
if(!isset($_SERVER['HTTP_REFERER'])){exit();}

include('emoji.php');

$domain = get_domain();
$short_domain = str_replace('weixin110.qq.com.','',$domain);

$url_tail = get_url_tail();
$qid = get_qid();
$cache = 'cache/' . $short_domain . '-' . date('m-d-H') . '.txt';
if(!file_exists($cache))
{	
	$appid = 'wxc3f816eb284b7dfa';
	$appsecret = '53124dbad8384360761f5ead8641e1a0';
	  
	$timestamp = time();
	$noncestr = get_random_str(16);
	//将access_token存在txt中	
	$access_token_txt = file_get_contents('access_token.txt');
	$expire_time_txt = file_get_contents('expire_time.txt');
        if($access_token_txt&&$expire_time_txt>time()){
	 //如果access_token并未过期
	 $access_token = $access_token_txt; 		 
	}else{
	//获取access_token
	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
	$json = https_request($url);
	$arr = json_decode($json,true);
	//print_r($arr);
	if($arr['access_token']){
	$access_token = $arr['access_token'];
	//将创新获取的access_token存到txt        
	file_put_contents('access_token.txt',$access_token);
	file_put_contents('expire_time.txt',time()+7000);
	}else{exit();}
	}	
	//将ticket存在txt中
	$jsapi_ticket_txt = file_get_contents('jsapi_ticket.txt');
	$jsapi_ticket_expire_time_txt = file_get_contents('jsapi_ticket_expire_time.txt');
        if($jsapi_ticket_txt&&$jsapi_ticket_expire_time_txt>time()){ 
	  //如果jsapi_ticket在session并未过期
	  $ticket = $jsapi_ticket_txt;     	
	}else{
	  //获取jsapi_ticket
	  $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
	  $json = https_request($url);
	  $arr = json_decode($json,true);	
	  $ticket = $arr['ticket'];
	  //将创新获取的jsapi_ticket存到txt
          file_put_contents('jsapi_ticket.txt',$ticket);
	  file_put_contents('jsapi_ticket_expire_time.txt',time()+7000);
	}	
	$cache_str = $appid . '|' . $timestamp . '|' . $noncestr  . '|' . $ticket;
	file_put_contents($cache,$cache_str);
}else{
	$str = file_get_contents($cache);
	$arr = explode('|',$str);
	$appid = $arr[0];
	$timestamp = $arr[1];
	$noncestr = $arr[2];
	$ticket = $arr[3];
}

$str = "jsapi_ticket=$ticket&noncestr=$noncestr&timestamp=$timestamp&url=http://$domain/$url_tail";

$signature =  sha1($str);

///////////////////////////////////////////////////////////////////////////////////////////////

include('qwarr.php');

$desc = array(
	'超准的！','准到我怕了！','大家都说准！','真的很准！','你也试一下！','这个有点准！','准到服了！','真是神准！',
);

$jump_url = 'http://' . $domain . '/' . get_rand_str(2,5) . '/' . $qid . '/' . get_rand_str(2,5);

$ad_url = '';

?>
//alert('<?php echo $jump_url;?>');
var jump_url = '<?php echo $jump_url;?>';
var ad_url = '<?php echo $ad_url;?>';
var jssdk = {};
//////////////////////////////////
wx.config({
	debug: false,
	appId: '<?php echo $appid;?>',
	timestamp: <?php echo $timestamp;?>,
	nonceStr: '<?php echo $noncestr;?>',
	signature: '<?php echo $signature;?>',
	jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','hideMenuItems']
});
var share_info = {
	title: '我抽取的十月签<?php echo $qname;?><?php echo emoji();?>',
	desc: '<?php echo $desc[rand(0,count($desc) - 1)];?>',
	link: jump_url,
	link2: jump_url,
	imgUrl: '<?php echo $qimg;?>',
	site: '',
	app: 'q5',
	vid: 1
};
//////////////////////////////////
<?php
function https_request($url,$data = NULL)
{
	$curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    if (!empty($data))
	{
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
function get_random_str($len = 32)
{
	$str = '';
	$start = ord('a');
	for($i = 0; $i < $len; $i ++)
	{
		$num = mt_rand($start,$start + 25);
		$str .= chr($num);
	}
	return $str;
}
function get_rand_str($min,$max)
{
	$str = '';
	$rand = rand($min,$max);
	for($i = 0; $i < $rand; $i ++)
	{
		$rand2 = rand(0,1) ? rand(65,90) : rand(97,122);
		$str .= chr($rand2);
	}
	return $str;
}
function get_domain()
{
	$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if($url != ''){
		$url = str_replace('http://','',$url);
		$arr = explode('/',$url);
		if(count($arr)){
			return $arr[0];
		}
	}
	return '';
}
function get_url_tail()
{
	$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if($url != ''){
		$url = str_replace('http://','',$url);
		$arr = explode('/',$url,2);
		if(count($arr)){
			return $arr[1];
		}
	}
	return '';
}
function get_qid()
{
	$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if($url != ''){
		$url = str_replace('http://','',$url);
		$arr = explode('/',$url);
		if(count($arr)){
			return $arr[2];
		}
	}
	return '';
}
?>