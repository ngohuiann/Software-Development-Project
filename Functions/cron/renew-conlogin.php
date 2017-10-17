<?php
include('../../Conf/init.php');
$date = date('Y-m-d',strtotime('yesterday'));
$last_loginsql = mysqli_query($conn, "SELECT UserID, LastLogin, ConsecutiveLogin FROM user");
while ($last_login = mysqli_fetch_array($last_loginsql)){
	$UID = $last_login['UserID'];
	if ($last_login['LastLogin'] < $date){
		$sql3 = "UPDATE user SET ConsecutiveLogin='0' WHERE UserID='$UID'";
		if(!mysqli_query($conn,$sql3))
		{
		die('Error:' .mysqli_error($conn));
		}
	}
}
?>