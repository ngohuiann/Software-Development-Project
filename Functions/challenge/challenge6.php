<?php
//Complete 5 modules in a day
include('Conf/init.php');
session_start();
$UID = $_SESSION['UID'];
$ChaID = $_SESSION['ChallengeID'];
$currentdate = date("Y-m-d");
$currentdatetime = date("Y-m-d H:i:s");
if ($result = mysqli_query($conn,"SELECT * FROM ModuleStatus WHERE UserID = '$UID' AND CompletedDate = '$currentdate'"))
  {
	if (!$result) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  }
  
if ($rowcount == 1){
	$sql1 = "UPDATE challengestatus SET Status='1' WHERE UserID='$UID' AND ChallengeID='$ChaID'";
		if(!mysqli_query($conn,$sql1))
			{
			die('Error:' .mysqli_error($conn));
			}
} elseif ($rowcount == 2){
	$sql2 = "UPDATE challengestatus SET Status='2' WHERE UserID='$UID' AND ChallengeID='$ChaID'";
		if(!mysqli_query($conn,$sql2))
			{
			die('Error:' .mysqli_error($conn));
			}
} elseif ($rowcount == 3){
	$sql3 = "UPDATE challengestatus SET Status='3' WHERE UserID='$UID' AND ChallengeID='$ChaID'";
		if(!mysqli_query($conn,$sql3))
			{
			die('Error:' .mysqli_error($conn));
			}
} elseif ($rowcount == 4){
	$sql4 = "UPDATE challengestatus SET Status='4' WHERE UserID='$UID' AND ChallengeID='$ChaID'";
		if(!mysqli_query($conn,$sql4))
			{
			die('Error:' .mysqli_error($conn));
			}
} elseif ($rowcount >= 5) {
	$sql5 = "UPDATE challengestatus SET Status='5', Completed='True', CompleteTime='$currentdatetime' WHERE UserID='$UID' AND ChallengeID='$ChaID'";
		if(!mysqli_query($conn,$sql5))
			{
			die('Error:' .mysqli_error($conn));
			}
}

?>