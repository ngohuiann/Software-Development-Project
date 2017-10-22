<html>
<?php
include('../../Conf/init.php');
if (isset($_POST['submit'])) {
if($_SERVER["REQUEST_METHOD"] == "POST"){
$mfile = $_FILES['ModuleFile']['name'];
$target_dir_HTML = "../../Includes/Course/HTML/";
$target_dir_CSS = "../../Includes/Course/CSS/";
$target_dir_JS = "../../Includes/Course/Javascript/";

$course=mysqli_real_escape_string($conn,$_POST['course']);
$mtitle=mysqli_real_escape_string($conn,$_POST['ModuleTitle']);

$sqlcourse = mysqli_query($conn, "SELECT course.CourseID, course.TotalModule FROM course LEFT JOIN module ON course.CourseID = module.CourseID WHERE CourseTitle='$course'");
$row = mysqli_fetch_array($sqlcourse);
$CID = $row['CourseID'];
$Modules = $row['TotalModule'] + 1;
/* 
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if($imageFileType != "doc" && $imageFileType != "docx") {
    echo "Sorry, only DOC, DOCX files are allowed.";
}  */

$tmp = explode(".", $_FILES["ModuleFile"]["name"]);
$extension = end($tmp);

if ($course == "HTML"){
	move_uploaded_file($_FILES["ModuleFile"]["tmp_name"], $target_dir_HTML.$mtitle.".".$extension);
		$file_name1 = $mtitle.".".$extension;
		$sql1="INSERT INTO module (ModuleTitle,ModuleLevel,CourseID,ModuleFile) VALUES ('$_POST[ModuleTitle]','$_POST[level]','$CID','$file_name1')";
		if(!mysqli_query($conn,$sql1))
		{
			die('Error:' .mysqli_error($conn));
		}
		$sql4="UPDATE course SET TotalModule = '$Modules' WHERE CourseID = '$CID'";
		if(!mysqli_query($conn,$sql4))
		{
			die('Error:' .mysqli_error($conn));
		}
		echo "<script>
	alert('html!');
	</script>";
} elseif ($course == "CSS") {
	move_uploaded_file($_FILES["ModuleFile"]["tmp_name"], $target_dir_CSS.$mtitle.".".$extension);
		$file_name2 = $mtitle.".".$extension;
		$sql2="INSERT INTO module (ModuleTitle,ModuleLevel,CourseID,ModuleFile) VALUES ('$_POST[ModuleTitle]','$_POST[level]','$CID','$file_name2')";
		if(!mysqli_query($conn,$sql2))
		{
			die('Error:' .mysqli_error($conn));
		}
		$sql5="UPDATE course SET TotalModule = '$Modules' WHERE CourseID = '$CID'";
		if(!mysqli_query($conn,$sql5))
		{
			die('Error:' .mysqli_error($conn));
		}
		echo "<script>
	alert('css!');
	</script>";
} elseif ($course == "Javascript"){
	move_uploaded_file($_FILES["ModuleFile"]["tmp_name"], $target_dir_JS.$mtitle.".".$extension);
		$file_name3 = $mtitle.".".$extension;
		$sql3="INSERT INTO module (ModuleTitle,ModuleLevel,CourseID,ModuleFile) VALUES ('$_POST[ModuleTitle]','$_POST[level]','$CID','$file_name3')";
		if(!mysqli_query($conn,$sql3))
		{
			die('Error:' .mysqli_error($conn));
		}
		$sql6="UPDATE course SET TotalModule = '$Modules' WHERE CourseID = '$CID'";
		if(!mysqli_query($conn,$sql6))
		{
			die('Error:' .mysqli_error($conn));
		}
		echo "<script>
	alert('js!');
	</script>";
}
}}
?>
<head></head>
<body>
    <form method="post" enctype="multipart/form-data">
	Please select a course
        <select name="course" required="required">
            <option value="">Please select</option>
			<option value="HTML">HTML</option>
			<option value="CSS">CSS</option>
            <option value="Javascript">Javascript</option>
        </select><br />
		
		<input type="text" name="ModuleTitle" /><br />
		
		<select name="level" required="required">
            <option value="">Please select a level</option>
			<option value="1">1</option>
			<option value="2">2</option>
            <option value="3">3</option>
        </select><br />
		
        <input type="file" name="ModuleFile"/><br />
		
		<input type="submit" name="submit" value="submit" />
    </form>
</body>
</html>