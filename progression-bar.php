<?php 
    include('../Conf/init.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/progression-bar.css" />
</head>
<body>
    <?php
	   $result = mysqli_query($conn,"SELECT * FROM enrollment INNER JOIN lesson ON enrollment.LessonID = lesson.LessonID WHERE StudentID=2");
		while($row=mysqli_fetch_array($result))
		{ ?> 
    <progress value="<?php echo $row['Status'];?>" max="<?php echo $row['TotalTopic'];?>">
</progress>
		<?php }?>
</body>
</html>