<?php 
include('../../Conf/init.php');
$result=mysqli_query($conn,"SELECT ChaQuestionID FROM challengequestion");
$shuffle_list = array();
while($list=mysqli_fetch_assoc($result)){
    $shuffle_list[] = $list;
}
$k = array_rand($shuffle_list);
$v = $shuffle_list[$k];
print_r($v);
$qofday = implode($v);
$current_date = date('d');
$current_month = date('m');
$current_year = date('Y');
$issuedate = $current_year . "-" . $current_month . "-" . $current_date;

$sql="INSERT INTO challenge (ChaQuestionID, IssueDate) VALUES ('$qofday','$issuedate')";
		
		if(!mysqli_query($conn,$sql))
		{
		die('Error:' .mysqli_error($conn));
		}
?>