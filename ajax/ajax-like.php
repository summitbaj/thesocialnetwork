<?php
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
	
	extract($_POST);
	$user_ip = $_REQUEST['user_id'];
	$pageID=$_REQUEST['pageID'];
	$act=$_REQUEST['act'];
	

	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
		$dislike_sql = mysql_query('SELECT COUNT(*) FROM   tsn_rate WHERE user_id = "'.$user_ip.'" and  post_type= "'.$post_type.'" and p_id = "'.$pageID.'" and rate = 2 ');
		$dislike_count = mysql_result($dislike_sql, 0); 

		$like_sql = mysql_query('SELECT COUNT(*) FROM   tsn_rate WHERE user_id = "'.$user_ip.'" and  post_type= "'.$post_type.'" and p_id = "'.$pageID.'" and rate = 1 ');
		$like_count = mysql_result($like_sql, 0); 

	if($act == 'like'): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO  tsn_rate (p_id, user_id,post_type, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "'.$post_type.'", "1")');
		}
		if($dislike_count == 1){
			mysql_query('UPDATE  tsn_rate SET rate = 1 WHERE p_id = '.$pageID.' and  post_type= "'.$post_type.'"  and user_id ="'.$user_ip.'"');
		}

	endif;
	if($act == 'dislike'): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO  tsn_rate (p_id, user_id,post_type, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "'.$post_type.'", "2")');
		}
		if($like_count == 1){
			mysql_query('UPDATE  tsn_rate SET rate = 2 WHERE p_id = '.$pageID.' and  post_type= "'.$post_type.'"  and user_id ="'.$user_ip.'"');
		}

	endif;
?>