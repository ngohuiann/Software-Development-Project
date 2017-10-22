<?php 
$username = "sdp";
$password = "sdp";

if (isset($_POST['submit'])) {
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$uname= $_POST['username'];
	$pwd= $_POST['password'];
	if ($uname == "sdp"){
		if ($pwd == "sdp"){
		echo "<script>window.location.href='/sdp/index.php';
	</script>";
	}
}else{
	echo "fail";
}}}
?>