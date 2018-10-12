<?php
require_once ('mmysql.php');
date_default_timezone_set('PRC');
set_time_limit(30);
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

$share_type = post('res'); 
$qid = post('qid'); 
$share_time = strtotime(date('Y-m-d H:00:00')); 
if(!$share_type&&!$qid){
	exit('参数异常!');
}

//连接数据库
$db = init_connect();
$tbName= "x_sign_share";

//核查当前操作信息
$option = array(
		'qid'=>$qid,
		'share_type'=>"'".$share_type."'",
		'share_time'=>$share_time,
);
$checkInfo = $db->where($option)->select($tbName);

if($checkInfo){ 	
	updatedata($db,$tbName,$qid,$share_type,$option);
}else{ 
	insertdata($db,$tbName,$qid,$share_type,$share_time);
}

//新增用户分享信息
function insertdata($db,$tbName,$qid,$share_type,$share_time){
	
    if($share_type=='timeline'){ //朋友圈
    	$data = array(
    			'qid'=>$qid,
    			'timeline_num'=>1,
    			'share_time'=>$share_time,
    			'share_type'=>$share_type,
    	);
    }elseif($share_type=='friend'){ //微信朋友
    	$data = array(
    			'qid'=>$qid,
    			'friend_num'=>1,
    			'share_time'=>$share_time,
    			'share_type'=>$share_type,
    	);
    }
    $db->insert($tbName,$data);        	 	        	
}

//更新用户分享信息
function updatedata($db,$tbName,$qid,$share_type,$option){		
		switch ($share_type){
			case 'timeline': //朋友圈
				$query = $db->where($option)->limit(1)->select($tbName);
					$data = array(
							'timeline_num'=>$query[0]['timeline_num']+1,
								);
				break;
			case 'friend': //微信朋友
				$query = $db->where($option)->limit(1)->select($tbName);
				$data = array(
						  'friend_num'=>$query[0]['friend_num']+1,	
							);
				break;
		}			
		$db->where($option)->update($tbName, $data);
}

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

function post($val,$filter = 'strict')
{
	return $filter(isset($_POST[$val])?$_POST[$val]:'');
}
?>