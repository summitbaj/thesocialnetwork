<?php
$path='../';
$the_profile=0;
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
function time_diff($timestamp)
{
	 //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - ($timestamp);
	return ($diff);
	
}

?>


            <? 
			$k=0;
			$profile_id=$_REQUEST['user_id'];
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where userID='$profile_id' OR friendID='$profile_id' order BY `rel_ID` desc");
			foreach($qry_all_prod as $friend_data)
			{  
					$theID=$friend_data['friendID'];
					if($theID==$profile_id)
					$theID=$friend_data['userID'];
			
					$query = "select * from  tsn_users where user_id='".$theID."'";
					$post_data = $qry->querySelectSingle($query);
			if(time_diff(strtotime($post_data['last_login']))<5)
		{
					?>
		  <div class="media">  <a href="c_<?=$post_data['user_name'] ?>"><span class="glyphicon glyphicon-stop pull-right" style="color:#090;"></span>
  <div  class="pull-left">
      <img src="uploads/small<?=$post_data['unique_id'] ?>.jpg" width="30"></div>
 

			<? echo $post_data['full_name'] ?>
            
            </a></div><? $k++; }
	} 
	
	
	if($k==0){?>
<div>No friends Online</div>
<? 
	}
?>    
    
		