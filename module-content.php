<html>
<?php 
include('Conf/init.php');
$CID = intval($_GET['CID']);
$MID = intval($_GET['MID']);

$sql1 = mysqli_query($conn, "SELECT * FROM module WHERE CourseID='$CID' AND ModuleID='$MID'");
$row = mysqli_fetch_array($sql1);
?>
<head></head>
<body>
<?php echo $row['ModuleContent'];
?>
</body>
</html>