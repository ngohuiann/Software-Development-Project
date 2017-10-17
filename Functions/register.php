
<?php
include('../Conf/init.php');
if (isset($_POST['submit'])) {
if($_SERVER["REQUEST_METHOD"] == "POST"){
$profilepic = $_FILES['profile_pic']['name'];
$target_dir = "../Images/ProfilePicture/";
$password = mysqli_real_escape_string($conn,$_POST['password']); 
$hashedpwd = password_hash($password, PASSWORD_DEFAULT);
$rowcount=0;
$emailcount=0;
$username=mysqli_real_escape_string($conn,$_POST['username']); 
$email=mysqli_real_escape_string($conn,$_POST['email']);
$sql1 = "SELECT * FROM user WHERE Username='$username'";
$sql3 = "SELECT * FROM user WHERE Email='$email'";
if($result=mysqli_query($conn,$sql1))
	{
		// Return the number of rows in result set
		$rowcount=mysqli_num_rows($result);// Free result set
		mysqli_free_result($result);
	}
if($emailresult=mysqli_query($conn,$sql3))
	{
		// Return the number of rows in result set
		$emailcount=mysqli_num_rows($emailresult);// Free result set
		mysqli_free_result($emailresult);
	}
 //check if user exist
if($rowcount==1)
{
	echo "<script>
	alert('Username already exist. Please try again.');
	window.location.href='/sdp/index.php';
	</script>";
}
	
 //check if email exist
if($emailcount>=1)
{
	echo "<script>
	alert('Email already exist. Please login instead again.');
	window.location.href='/sdp/index.php';
	</script>";
} 

	if ($profilepic != null){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$tmp = explode(".", $_FILES["profile_pic"]["name"]);
	$extension = end($tmp);
		$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
		$uploadOk = 1;
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../Images/ProfilePicture/".$username.".".$extension);
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
}else{
	$sql="INSERT INTO user (Username,Password,Fullname,DOB,Email,Gender) VALUES ('$_POST[username]','$hashedpwd','$_POST[fullname]','$_POST[DOB]','$_POST[email]','$_POST[gender]')";
		if(!mysqli_query($conn,$sql))
		{
		die('Error:' .mysqli_error($conn));
		}
	echo "<script>
	alert('Register no picSuccessful!');
	window.location.href='/sdp/index.php';
	</script>";
}}}
?>