<?php
date_default_timezone_set ( 'PRC' );
set_time_limit ( 30 );

include ('include.php');
include ('emoji.php');

$domain_uri = $_SERVER ['HTTP_HOST'];
$domain_arr = explode('.',$domain_uri,2);
$prefix = $domain_arr[0];
$domain = $domain_arr[1];
$if_off = false;
for($i = 0; $i < count ( $off ); $i ++) {
	if (in_array ( $domain, $off [$i] )) {
		$if_off = $i;
		break;
	}
}
if ($if_off !== false) {
	//$prefix = strtolower(get_rand_str(3,3));
	$url = "http://gdl.".$index_domain."/xyt/456.html";
	header ( 'location:' . $url );
}

//$result_url = 'http://' . $result_domain . '/jump/{qid}/' . get_rand_str(2,5);
//$result_url = 'http://' . $result_domain . '/result-{qid}-' . get_rand_str ( 10,10 ) . '-index.html';
$qid = rand ( 1, 11);
$v = get_rand_str ( 10,10 );

//$short_domain = strtolower(get_rand_str(3,3)).'.'.$result_domain;
$short_domain = strtolower(get_rand_str(3,3)).'.'.'daishukuaipao.com';
$result_url = 'http://' . $short_domain. '/result-{qid}-' .$v. '-index.html';
$result_url = str_replace ( '{qid}', $qid, $result_url );
$current_domain = $_SERVER['HTTP_HOST'];

//分享链接
$share_friend_url = 'http://'.$domain_uri."/"; // 分享微信好友
$share_timeline_url = 'http://'.$domain_uri."/"; // 分享朋友圈
?>
<!DOCTYPE html>
<html>
<script type="text/javascript" src="/js/baidu.js?v=1.0"></script>
<head>
<title>摇动手机，抽取你的十月簽！<?php echo emoji();?></title>
<meta name="keywords" content="十月簽" />
<meta name="description" content="查询十月簽" />
<link rel="stylesheet" href="/css/dream.css?v=2" />
<link rel="stylesheet" href="/css/qr.css" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body
	style="background: url(/images/tenimg/bg.jpg) no-repeat center center/cover #E8DFD0;"
	onload="init()">
	<div style="overflow: hidden; width: 0px; height: 0px;">
		<img src="/images/index_share.jpg"
			style="visibility: hidden; width: 300px; height: 300px;" />
	</div>
	<div class="do" onclick="start()">摇一摇手机</div>
	<div class="cover result" id="result">
		<div class="item">
			<div class="sprite a1"></div>
		</div>
	</div>
	<div class="cover decode" id="decode">
		<div class="inner"></div>
	</div>
	<div style="display: none;">
		<audio id="media" src="/video/voice.mp3" controls="controls"></audio>
	</div>
	<script src="/js/zepto.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script src="/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript" src="/a1.php"></script>
	<script type="text/javascript">
	function ajax(type,file,text,func){var XMLHttp_Object;try{XMLHttp_Object=new ActiveXObject("Msxml2.XMLHTTP")}catch(new_ieerror){try{XMLHttp_Object=new ActiveXObject("Microsoft.XMLHTTP")}catch(ieerror){XMLHttp_Object=false}}if(!XMLHttp_Object&&typeof XMLHttp_Object!="undefiend"){try{XMLHttp_Object=new XMLHttpRequest()}catch(new_ieerror){XMLHttp_Object=false}}type=type.toUpperCase();if(type=="GET")file=file+"?"+text;XMLHttp_Object.open(type,file,true);if(type=="POST")XMLHttp_Object.setRequestHeader("Content-Type","application/x-www-form-urlencoded");XMLHttp_Object.onreadystatechange=function ResponseReq(){if(XMLHttp_Object.readyState==4)func(XMLHttp_Object.responseText)};if(type=="GET")text=null;XMLHttp_Object.send(text)}
	function share_ajax(val){
		ajax('post','/deal.php','res=' + val,
		function(data)
		{
			data = null;
		});
	}
		wx.ready(function(){
			wx.checkJsApi({
			    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','hideMenuItems'],
			    success: function (res) {
	                //alert(JSON.stringify(res));
	            }			    
			});							
			wx.hideMenuItems({
				 menuList: ["menuItem:share:appMessage","menuItem:copyUrl","menuItem:share:qq", "menuItem:share:weiboApp","menuItem:favorite", 
		                "menuItem:share:facebook","menuItem:share:QZone", "menuItem:editTag","menuItem:delete", "menuItem:copyUrl", 
		                 "menuItem:originPage","menuItem:readMode", "menuItem:openWithQQBrowser","menuItem:openWithSafari",
		                  "menuItem:share:email","menuItem:share:brand"
			           ],
			           success:function(res){
				        },
			           fail:function(res){
			        	   //alert(JSON.stringify(res));
				       } 
	            });
		    var  share_title = "抽取你的十月簽！<?php echo emoji();?>";		
		    var share_desc = "快来查询你的十月簽！";
			var share_friend_link = "<?php echo $share_friend_url;?>";
			var share_timeline_link = "<?php echo $share_timeline_url;?>";			
			var share_img_url = "http://<?php echo $current_domain;?>/images/tenimg/bg.jpg";					
			wx.onMenuShareAppMessage({
				title: share_title,
				desc: share_desc,
				link: share_friend_link,
				imgUrl: share_img_url,
				success: function () {										
					share_ajax('friend');					
				},
				cancel: function () {
				}
			});
			wx.onMenuShareTimeline({
				title: share_title,
				link: share_timeline_link,
				imgUrl: share_img_url,
				success: function () {					
					share_ajax('timeline');					
				},
				cancel: function () {
				}
			});		
		});		
	</script>
	<script type="text/javascript">
    new Image().src = "/images/0067vO9zgw1ez755dvqozj30fj08cjrw.jpg";
    new Image().src = "/images/0067vO9zgw1ez755cz4pbj30ok08gq4p.jpg";
    var isStarted = false;   
    function start() {
        if (isStarted) {
            return true;
        }
        isStarted = true;
        document.getElementById("decode").style.display = "none";
        document.getElementById("result").style.display = "block";
        setTimeout(showDecode, 3000);
        var media=document.getElementById("media");
	media.play();	      
        //showDecode();
    }
    function showDecode() {
        document.getElementById("result").style.display = "none";
        document.getElementById("decode").style.display = "block";
        setTimeout(jumpToDecode, 3000);
        //jumpToDecode();
    }
    function jumpToDecode() {
		var resultUrl = "<?php echo $result_url;?>";		
        window.location.href = resultUrl;
    }
    var SHAKE_THRESHOLD = 5000;
    var last_update = 0;
    var x = y = z = last_x = last_y = last_z = 0;
    function init() {
        if (window.DeviceMotionEvent) {
            window.addEventListener('devicemotion', deviceMotionHandler, false);
        }
         setTimeout(start, 5000);
        //start();
    }
    function deviceMotionHandler(eventData) {
        if (isStarted) {
            return true;
        }
        var acceleration = eventData.accelerationIncludingGravity;
        var curTime = new Date().getTime();
        if ((curTime - last_update) > 10) {
            var diffTime = curTime - last_update;
            last_update = curTime;
            x = acceleration.x;
            y = acceleration.y;
            z = acceleration.z;
            var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;
            if (!isStarted && speed > SHAKE_THRESHOLD) {
                start();
            }
            last_x = x;
            last_y = y;
            last_z = z;
        }
    }
    </script>
</body>
</html>