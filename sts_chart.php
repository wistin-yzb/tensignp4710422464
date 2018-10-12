<?php
require_once ('mmysql.php');
date_default_timezone_set('PRC');
set_time_limit(30);
$auto = get('auto');
$qid = get('qid');

function strict($str)
{
	if(get_magic_quotes_gpc())
	{
		$str = stripslashes($str);
	}
	$str = str_replace('&#','{vv}',$str);
	$str = str_replace('#','&#35;',$str);
	$str = str_replace('--','-&#45;',$str);
	$str = str_replace('/*','/&#42;',$str);
	$str = str_replace('*/','&#42;/',$str);
	$str = str_replace('<','&#60;',$str);
	$str = str_replace('>','&#62;',$str);
	$str = str_replace('(','&#40;',$str);
	$str = str_replace(')','&#41;',$str);
	$str = str_replace("'",'&#39;',$str);
	$str = str_replace('"','&#34;',$str);
	$str = str_replace('\\','&#92;',$str);
	$str = str_replace('%20','&nbsp;',$str);
	$str = str_replace(chr(13).chr(10),'<br />',$str);
	$str = str_replace('{vv}','&#',$str);
	return $str;
}
function get($val,$filter = 'strict')
{
	return $filter(isset($_GET[$val])?$_GET[$val]:'');
}
//连接数据库
function init_connect(){
	$configArr = array(
			'host'=>'47.104.224.64',
			'user'=>'root',
			'passwd'=>'admin888!@#$2',
			'dbname'=>'db_item01',
			'port'=>'3306',
	);
	return new MMysql($configArr);
}
//获取数组指定字段的总和
function getSumByField($array,$field){
	$sum = 0;
	foreach($array as $key=>$val){
		$sum+=$val[$field];
	}
	return $sum;
}

//相同字段累计求和
function sumByfield($arr){
	$arr_new = array_map(function ($id) use ($arr) {
		$value = array_reduce($arr, function ($value, $item) use ($id) {
			return $value + ($item['share_time'] === $id ? $item['total_num'] : 0);
		}, 0);
			return ['share_time' => $id, 'total_num' => $value];
	}, array_unique(array_column($arr, 'share_time')));
		return $arr_new;
}

$auto = get('auto');
$qid = get('qid');

//连接数据库
$db = init_connect();
$tbName= "x_sign_share";

//核查当前操作信息
$order = array('qid'=>'desc');
$field = "id,qid,timeline_num,friend_num,(timeline_num+friend_num) as total_num,share_type,share_time";
//整体
$option  = array('qid'=>$qid);
$all_list = $db->field($field)->where($option)->order($order)->select($tbName);
if($all_list){
	foreach ($all_list as $key=>$val){
		$all_list[$key]['share_time'] = date('H',$val['share_time']);
	}
}
//相同字段累计求和
$all_list = sumByfield($all_list);
//朋友圈
$option = array('qid'=>$qid,'share_type'=>'\'timeline\'');
$timeline_list = $db->field($field)->where($option)->order($order)->select($tbName);
$timeline_field = $db->field('timeline_num')->where($option)->order($order)->select($tbName);
$timeline_num = getSumByField($timeline_field,'timeline_num');
if($timeline_list){
	foreach ($timeline_list as $key=>$val){
		$timeline_list[$key]['share_time'] = date('H',$val['share_time']);
	}
}
//微信朋友
$option = array('qid'=>$qid,'share_type'=>'\'friend\'');
$friend_list = $db->field($field)->where($option)->order($order)->select($tbName);
$friend_field = $db->field('friend_num')->where($option)->order($order)->select($tbName);
$friend_num = getSumByField($friend_field,'friend_num');
if($friend_list){
	foreach ($friend_list as $key=>$val){
		$friend_list[$key]['share_time'] = date('H',$val['share_time']);
	}
}
?>
<!DOCTYPE html>
<html>
<script type="text/javascript" src="/js/baidu.js?v=1.0"></script>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>分享统计 - <?php echo date('H:i:s',time());?></title>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/ichart.1.2.min.js"></script>
	<style type="text/css">
		.canvas{padding:5px;float:left;}
		.ichartjs_btn{padding:2px 5px;line-height:25px;color:#0b2946;cursor:pointer;text-align:center;font-size:12px;border:1px solid #98adc1;-webkit-box-shadow:0 0 2px #375073;-moz-box-shadow:0 0 2px #375073;box-shadow:0 0 2px #375073;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;border-radius:5px}
		.ichartjs_author{position:absolute;font-size:12px;right:20px;top:0}
		.ichartjs_author a{color:#113659}
		.ichartjs_info{position:relative;margin:10px;padding:5px;color:#1b4267}
		.ichartjs_sm{margin:10px 0;font-size:13px;font-weight:600}
		.ichartjs_details{padding:0;text-indent:2em;font-size:12px;line-height:20px}
		#ichartjs_code{display:none}
		#ichartjs_result{position:absolute;left:20px;bottom:20px;padding:8px;color:#fefefe;font-size:20px;font-weight:600;background-color:#6d869f;cursor:pointer;text-align:center;border:1px solid #6a869d;-webkit-box-shadow:0 0 2px #375073;-moz-box-shadow:0 0 2px #375073;box-shadow:0 0 2px #375073;-moz-border-radius:10px;-webkit-border-radius:10px;-khtml-border-radius:10px;border-radius:10px}
	</style>
</head>
<body>
<div style="padding:15px 0;">
签文id：<?php echo $qid;?><br/>
朋友圈：<?php echo $timeline_num;?><br/>
微信群：<?php echo $friend_num;?>
</div>
<div class="canvas" id='canvasTimeline'></div>
<div class="canvas" id='canvasFriend'></div>
<div class="canvas" id='canvasAll'></div>
<script>
	$(function(){
		//朋友圈统计		
      <?php if(count($timeline_list)>0):?>
		var data1 = [
			{
				name : '朋友圈',
				value:[<?php $k = 0;?><?php foreach($timeline_list as $key => $value):?><?php echo $value['timeline_num'];?><?php if($k ++ < count($timeline_list) - 1):?>,<?php endif;?><?php endforeach;?>],
				color:'#6cbf3d',
				line_width:3
			}
	   ];
var chart1 = new iChart.LineBasic2D({
			render : 'canvasTimeline',
			data: data1,
			title : '朋友圈统计',
			width : 900,
			height : 450,
			coordinate:{height:'90%',background_color:'#f6f9fa'},
			sub_option:{
				hollow_inside:false,
				point_size:16
			},
			labels:[<?php $k = 0;?><?php foreach($timeline_list as $key => $value):?><?php echo $value['share_time'];?><?php if($k ++ < count($timeline_list) - 1):?>,<?php endif;?><?php endforeach;?>]
		});
chart1.draw();
<?php endif;?>
//微信朋友统计
<?php if(count($friend_list)>0):?>
var data2 = [
			{
				name : '微信群',
				value:[<?php $k = 0;?><?php foreach($friend_list as $key => $value):?><?php echo $value['friend_num'];?><?php if($k ++ < count($friend_list) - 1):?>,<?php endif;?><?php endforeach;?>],
				color:'#6cbf3d',
				line_width:3
			}
	   ];
var chart2 = new iChart.LineBasic2D({
			render : 'canvasFriend',
			data: data2,
			title : '微信群统计',
			width : 900,
			height : 450,
			coordinate:{height:'90%',background_color:'#f6f9fa'},
			sub_option:{
				hollow_inside:false,
				point_size:16
			},
			labels:[<?php $k = 0;?><?php foreach($friend_list as $key => $value):?><?php echo $value['share_time'];?><?php if($k ++ < count($friend_list) - 1):?>,<?php endif;?><?php endforeach;?>]
		});
chart2.draw();
<?php endif;?>
//整体统计
<?php if(count($all_list)>0):?>
var data3 = [
			{
				name : '整体',
				value:[<?php $k = 0;?><?php foreach($all_list as $key => $value):?><?php echo $value['total_num'];?><?php if($k ++ < count($all_list) - 1):?>,<?php endif;?><?php endforeach;?>],
				color:'#6cbf3d',
				line_width:3
			}
	   ];
var chart3 = new iChart.LineBasic2D({
			render : 'canvasAll',
			data: data3,
			title : '整体统计',
			width : 900,
			height : 450,
			coordinate:{height:'90%',background_color:'#f6f9fa'},
			sub_option:{
				hollow_inside:false,
				point_size:16
			},
			labels:[<?php $k = 0;?><?php foreach($all_list as $key => $value):?><?php echo $value['share_time'];?><?php if($k ++ < count($all_list) - 1):?>,<?php endif;?><?php endforeach;?>]
		});
           chart3.draw();		
           <?php endif;?>
	});	
	<?php if($auto == 1):?>
	setTimeout("document.location.href = './sts_chart.php?qid=<?php echo $qid;?>&auto=1'",10 * 1000);
	<?php elseif($auto == 3):?>
	setTimeout("document.location.href = ''",3 * 1000);
	<?php endif;?>
</script>
</body>
</html>