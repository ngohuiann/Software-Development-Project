<html>
<?php
include('Conf/init.php');
include('Includes/header.html');

if (isset($_POST['submit'])) {
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")

{
function curdate() {
    return date('Y-m-d');
}
// username and password sent from Form
$username=mysqli_real_escape_string($conn,$_POST['username']);
$password=mysqli_real_escape_string($conn,$_POST['password']);

// Retrieve current date and set as login date
$login_date = date("Y-m-d H:i:s");

$sql="SELECT UserID FROM user WHERE Username='$username'";
$pwdb = mysqli_query($conn,"SELECT UserID, Password FROM user WHERE Username='$username'");

// Check user identity
$checkadmin = mysqli_query($conn,"SELECT Identity FROM user WHERE Username='$username'");
$validateadmin = mysqli_fetch_array($checkadmin);
$identity = $validateadmin['Identity'];

// Get user's last login date
$last_loginsql = mysqli_query($conn, "SELECT LastLogin, Coin FROM user WHERE Username='$username'");
while ($last_login = mysqli_fetch_array($last_loginsql)){
	$reward = $last_login['Coin'] + 20;
	$row = mysqli_fetch_array($pwdb);
if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  }
//mysqli_close($conn);

if($rowcount==1) {
	// Decrypt password hash and verify from database
	if ($verifypassword = password_verify($password,$row['Password'])){
		// if last login date is less than today date, then reward coin +20
		if ($last_login['LastLogin'] < curdate()){
			$sql2 = "UPDATE user SET LastLogin='$login_date', Coin='$reward' WHERE Username='$username'";
			if(!mysqli_query($conn,$sql2))
			{
			die('Error:' .mysqli_error($conn));
			}
			session_start();
			$_SESSION['Username']=$username;
			$_SESSION['userLevel']=$identity;
			$_SESSION['UID']=$row['UserID'];
			header('location: /Software-Development-Project/index.php');
		} else{ // if last login not less than today date, then update login date.
			session_start();
			$sql3 = "UPDATE user SET LastLogin='$login_date' WHERE Username='$username'";
			if(!mysqli_query($conn,$sql3))
			{
			die('Error:' .mysqli_error($conn));
			}
			session_start();
			$_SESSION['Username']=$username;
			$_SESSION['userLevel']=$identity;
			$_SESSION['UID']=$row['UserID'];
			header('location: /Software-Development-Project/index.php');
		}
		
}else{
	echo "<script>alert('Password incorrect. Please try again.');</script>";
}
}
else {

echo "<script>alert('Username incorrect. Please try again.');</script>";

}}}
}
 ?>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/body.css" />
    <link rel="stylesheet" type="text/css" href="CSS/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="login-bar">
        <div class="login-desc">
            <h2>Welcome back to CodeCube</h2>
            <h3>Unreadable text here.</h3>
        </div>
        <div class="login-form">
            <form action="" method="post" >
				<input class="username" placeholder="Username..." name="username" type="text" required="required"/><br />
				<input class="password" placeholder="Password..." name="password" type="password" required="required"/><br />
				<a href="#">Forget Password</a><br />
				<input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </div>
</body>
<?php 
include("Includes/footer.html");
?>
</html>