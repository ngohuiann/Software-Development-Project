<?php
include('Conf/init.php');
$sqlcourse = mysqli_query($conn, "SELECT course.CourseID FROM course LEFT JOIN module ON course.CourseID = module.CourseID WHERE CourseTitle='HTML'");
$row = mysqli_fetch_array($sqlcourse);
$CID = $row['CourseID'];
echo $CID;

?>