<?php
include('Conf/init.php');

$target_dir = "Images/ProfilePicture/";
$profilepic = $_FILES['profile_pic']['name'];
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if (isset($_POST['submit'])) {
if($_SERVER["REQUEST_METHOD"] == "POST"){

$rowcount=0;
$emailcount=0;

echo $profilepic;
var_dump($_POST);
	if ($profile_pic != null){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$tmp = explode(".", $_FILES["profile_pic"]["name"]);
	$extension = end($tmp);
		$uploadOk = 1;
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "Images/ProfilePicture/".$username.".".$extension);
		$file_name = $username.".".$extension;
		$sql2="INSERT INTO user (Username,Password,Fullname,DOB,Email,Gender,ProfilePicture) VALUES ('$_POST[username]','$hashedpwd','$_POST[fullname]','$_POST[DOB]','$_POST[email]','$_POST[gender]','$file_name')";
		if(!mysqli_query($conn,$sql2))
		{
		die('Error:' .mysqli_error($conn));
		}
		echo "<script>
	alert('Register Successful!');
	window.location.href='/sdp/index.php';
	</script>";
}}}
?>