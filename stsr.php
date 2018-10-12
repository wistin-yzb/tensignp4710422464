<?php
date_default_timezone_set('PRC');
set_time_limit(30);

include('include.php');

$auto = get('auto');

$json = file_get_contents('r.txt');
if($json != '')
{
	$arr = json_decode($json,true);
}else{
	$arr = array();
}

if(!isset($arr['timeline'])||!isset($arr['friend']))
{
	exit('500');
}

$timeline = $arr['timeline'];
$friend  = $arr['friend'];

$sum1 = $timeline[0];
$sum2 = $friend[0];

unset($timeline[0]);
unset($friend[0]);

$max = strtotime(date('Y-m-d H:00:00'));

$min1 = current(array_keys($timeline));
$min2 = current(array_keys($friend));

$min = $min1 >= $min2 ? $min1 : $min2;

if($min1 != $min2)
{
	foreach($timeline as $key => $value)
	{
		if($key < $min)
		{
			unset($timeline[$key]);
		}
	}
	foreach($friend as $key => $value)
	{
		if($key < $min)
		{
			unset($friend[$key]);
		}
	}
}

$long = 25;
if($max > $min + $long * 60 * 60)
{
	$min = $max - $long * 60 * 60;
	foreach($timeline as $key => $value)
	{
		if($key < $min)
		{
			unset($timeline[$key]);
		}
	}
	foreach($friend as $key => $value)
	{
		if($key < $min)
		{
			unset($friend[$key]);
		}
	}
}

$keys = array();
$all = array();
$len = ($max - $min) / (60 * 60);
for($i = 0; $i <= $len; $i ++)
{
	$key = $min + $i * 60 * 60;
	$keys[$i] = $key;
	if(!isset($timeline[$key]))
	{
		$timeline[$key] = 0;
	}
	if(!isset($friend[$key]))
	{
		$friend[$key] = 0;
	}
	ksort($timeline);
	ksort($friend);
	$all[$key] = $timeline[$key] + $friend[$key];
}
$domain = "http://".$index_domain;
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
		.tr1{background-color:#DFF0D8;}
	</style>
</head>
<body>
<div class="container">
    <h2 class="center"></h2>              
    <table class="table table-bordered">
        <thead>
            <tr>             
                <th>朋友圈</th>
                <th>微信群</th>                
                <th>折线图</th>
            </tr>
        </thead>
        <tbody>                 
            <tr class="tr1">            
                <td>朋友圈：<?php echo $sum1;?></td>
                <td>微信群：<?php echo $sum2;?></td>
                <td><a href="<?php echo $domain;?>/r.php">查看</a>
                <a href="<?php echo $domain;?>/r.php?auto=1">自动</a>
                </td>
            </tr>    
        </tbody>
    </table>
</div>
   <script>
   <?php if($auto == 1):?>
	setTimeout("document.location.href = '<?php echo $domain;?>/r.php?auto=1'",10 * 1000);
	<?php elseif($auto == 3):?>
	setTimeout("document.location.href = ''",3 * 1000);
	<?php endif;?>
  </script>
</body>
</html>