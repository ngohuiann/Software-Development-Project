<?php
include('Conf/init.php');
$result = mysqli_query($conn,"SELECT * FROM schedule INNER JOIN module ON schedule.ModuleID = module.ModuleID INNER JOIN user ON schedule.UserID = user.UserID INNER JOIN course ON module.CourseID = course.CourseID WHERE user.UserID='26'");
	if (!$result) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	$schedule=mysqli_fetch_array($result);
echo $schedule['ModuleID'];
?>