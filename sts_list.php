<?php
require_once ('mmysql.php');
date_default_timezone_set('PRC');
set_time_limit(30);
$auto = get('auto');

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

function arrSort($a){
	$b = array();
	foreach($a as $v) {
		if(isset($b[$v['qid']])){ 
			$b[$v['qid']]['timeline_num'] += $v['timeline_num'];
			$b[$v['qid']]['friend_num'] += $v['friend_num'];
		}else{ 
			$b[$v['qid']] = $v;
		}
	}
	return  array_values($b);	
}
//连接数据库
$db = init_connect();
$tbName= "x_sign_share";

//核查当前操作信息
$order = array('qid'=>'desc');
$field = "id,qid,timeline_num,friend_num,share_type";
$list = $db->field($field)->order($order)->select($tbName);
if($list)$list = arrSort($list);
function get($val,$filter = 'strict')
{
	return $filter(isset($_GET[$val])?$_GET[$val]:'');
}
$auto = get('auto')?get('auto'):3;
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
?>
<!DOCTYPE html>
<html>
<script type="text/javascript" src="/js/baidu.js?v=1.0"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>分享统计 - <?php echo date('H:i:s',time());?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css">  
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>	
	<style>
		.center{text-align:center;}
		a{color:#3C763D;}
	</style>
</head>
<body>
<div class="container">
    <h2 class="center"></h2>              
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>名称</th>
                <th>朋友圈</th>
                <th>微信群</th>                
                <th>折线图</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($list)>0):?>
            <?php foreach($list as $key => $value):?>           
            <tr>
                <td>求签<?php echo $value['qid'];?></td>
                <td>朋友圈：<?php echo $value['timeline_num'];?></td>
                <td>微信群：<?php echo $value['friend_num'];?></td>
                <td><a href="./sts_chart.php?qid=<?php echo $value['qid'];?>">查看</a>
                <a href="./sts_chart.php?qid=<?php echo $value['qid'];?>&auto=1">自动</a>
                </td>
            </tr>                     
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
</div>
   <script>
   <?php if($auto == 1):?>
	setTimeout("document.location.href = './sts_list.php?auto=1'",10 * 1000);
	<?php elseif($auto == 3):?>
	setTimeout("document.location.href = ''",3 * 1000);
	<?php endif;?>
  </script>
</body>
</html>