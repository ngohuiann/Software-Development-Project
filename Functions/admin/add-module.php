<html>
<?php
include('../../Conf/init.php');
if (isset($_POST['submit'])) {
	$content = $_POST['editor'];
	$course=mysqli_real_escape_string($conn,$_POST['course']);
	$title=mysqli_real_escape_string($conn,$_POST['title']);

	$sqlcourse = mysqli_query($conn, "SELECT course.CourseID, course.TotalModule FROM course LEFT JOIN module ON course.CourseID = module.CourseID WHERE CourseTitle='$course'");
	
	$row = mysqli_fetch_array($sqlcourse);
	$CID = $row['CourseID'];
	$Modules = $row['TotalModule'] + 1;
	
	$sql1 = "INSERT INTO module (ModuleTitle,ModuleLevel,ModuleCost,CourseID,ModuleContent) VALUES ('$_POST[title]', '$_POST[level]', '$_POST[cost]', '$CID', '$content')";
	if(!mysqli_query($conn,$sql1))
		{
			die('Error:' .mysqli_error($conn));
		}
}
?>
<head>
<script src="/sdp/JS/ckeditor/ckeditor.js"></script>
</head>

<body>
<form action="" method="POST">
	<input type="text" name="title" placeholder="Module Title" />
	<input type="number" name="cost" />
	
	<select name="course" required="required">
        <option value="">Please select a course</option>
		<option value="HTML">HTML</option>
		<option value="CSS">CSS</option>
        <option value="Javascript">Javascript</option>
    </select><br />
	
	<select name="level" required="required">
		<option value="">Please select a level</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
	</select><br />
	
	<textarea class="ckeditor" name="editor"></textarea>
	
	<input type="submit" value="Submit" name="submit" />
</form>

</body>
</html>