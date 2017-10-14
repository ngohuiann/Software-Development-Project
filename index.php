<html>
<?php
//include('Conf/init.php');

if (isset($_POST['submit'])) {
//session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$target_dir = "Images/ProfilePicture/";
$password = mysqli_real_escape_string($conn,$_POST['password']); 
$hashedpwd = password_hash($password, PASSWORD_DEFAULT);
$rowcount=0;
$username=mysqli_real_escape_string($conn,$_POST['username']); 
$sql1 = "SELECT * FROM user WHERE Username='$username'";

if($result=mysqli_query($conn,$sql1))
	{
		// Return the number of rows in result set
		$rowcount=mysqli_num_rows($result);// Free result set
		
		//echo $rowcount;
		mysqli_free_result($result);
	}
 //check if user exist
if($rowcount==1)
{
	echo "<script>
	alert('User already exist. Please login instead.');
	window.location.href='###';
	</script>";
}else{
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$tmp = explode(".", $_FILES["profile_pic"]["name"]);
	$extension = end($tmp);
		$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
		$uploadOk = 1;
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "Images/ProfilePicture/".$username.".".$extension);
		$file_name = $username.".".$extension;
		$sql2="INSERT INTO user (Username,Password,Fullname,DOB,Email,Gender,ProfilePicture) VALUES ('$_POST[username]','$hashedpwd','$_POST[fullname]','$_POST[DOB]','$_POST[email]','$_POST[gender]','$file_name')";
		
		if(!mysqli_query($conn,$sql2))
		{
		die('Error:' .mysqli_error($conn));
		}
	
}}else{
	$sql="INSERT INTO user (Username,Password,Fullname,DOB,Email,Gender) VALUES ('$_POST[username]','$hashedpwd','$_POST[fullname]','$_POST[DOB]','$_POST[email]','$_POST[gender]')";
		if(!mysqli_query($conn,$sql))
		{
		die('Error:' .mysqli_error($conn));
		}
		echo "<script>
	alert('Register Successful!');
	window.location.href='index.php';
	</script>";
}
}


?>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/index.css"/>
	<link href="https://fonts.googleapis.com/css?family=Dosis|Titillium+Web" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cuprum|Oswald|Overpass+Mono|Saira+Extra+Condensed" rel="stylesheet">
</head>
<body>
	<div class="topnav">
	  <a style="float:left;" href="index.php" title="Homepage">
		<img src="Images/logo.png" width="220px" height="60px">
	  </a>
		<div class="searchbar">
		<script>
			document.onkeydown=function(evt){
				var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
				if(keyCode == 13)
				{
					//your function call here
					document.test.submit();
				}
			}
		</script>
		  <div class="box">
              <form action="search_course.php" method="GET">
                  <input type="text" name="search_box" placeholder="Search for anything to learn">
                    <span style="z-index:1;position:absolute;left:238px;margin-top:10px;color:#2b303b"><i class="fa fa-search"></i></span>
              </form>
          </div>
		</div>
	  <a id="loginlink" href="login.php">Log In</a>
	  <a id="courselink" href="view_all.php">View All Courses</a>
	</div>
    <div class="main-header">
        <div class="animationbg">
            <img src="Images/coding1.gif"/>
        </div>
        <div id="shadow">
        </div>
        <div class="main">
            <h1>Learn to Code</h1>
            <h2>on your schedules</h2>
            <button id="reg-btn" class="get-start">Get Started</button>
            <!-- The Modal -->
			<div id="regModal" class="modal">
			  <!-- Modal content -->
				<div class="modal-content">
					<form id="regForm" action="" method="post" enctype="multipart/form-data">
					<!-- One "tab" for each step in the form: -->
					<div class="tab">
					<img src="Images/reg-icon.png" style="text-align: center; margin: 0; width: 100px;" />
					<h2>Sign Up</h2>
					Username:
					  <input placeholder="Username..." name="username" type="text" required="required"/>
					  Password: 
					  <input placeholder="Password..." name="password" type="password" required="required"/>
					  <a href="#" style="float: left; margin-top: 30px;">Already own an account?</a>
					  <input type="button" value="Next" id="nextBtn" onclick="nextPrev(1)" style="overflow:auto; margin-top: 30px; float: right;" ></input>
					</div>

					<div class="tab"><h3>2. Basic Info</h3>
					Full Name
					  <input placeholder="Full name..." name="fullname" required="required"/>
					Gender<br />
						<select name="gender" required="required">
							<option value="">Please select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select><br />
					DOB
					  <input name="DOB" type="date" />
					Email Address
					  <input placeholder="Email..." name="email" type="email" required="required"/>
					  
					  <input type="button" id="prevBtn" value="Previous" onclick="nextPrev(-1)" style="overflow:auto; margin-top: 30px; float: right;" ></input>
					  <input type="button" id="nextBtn" value="Submit" onclick="nextPrev(1)" style="overflow:auto; margin-top: 30px; float: right;" ></input>
					</div>

					<div class="tab"><h3>3. Upload a profile picture</h3>
						<img src="Images/default-profile.png" style="width: 150px; padding: 20px; margin: 15px; border-radius: 50%; border: 1px solid black;" />
					  <input type="file" name="profile_pic" />
					  <input type="submit" name="submit" value="Skip" style="overflow:auto; margin-top: 30px; float: right;" />
					</div>

					<!-- Circles which indicates the steps of the form: -->
					<div style="text-align:center;margin-top:40px;">
					  <span class="step"></span>
					  <span class="step"></span>
					  <span class="step"></span>
					</div>
					</form> 
				</div>
			</div>
        </div>
    </div>
    <div class="course-desc">
        <div style="background-color:#eee;">
		 <div class="subject-tab">
			 <button class="subjectlinks htmltab" onclick="openSubject(event, 'HTML')">HTML</button>
			<button class="subjectlinks csstab" onclick="openSubject(event, 'CSS')">CSS</button>
			<button class="subjectlinks javascripttab" onclick="openSubject(event, 'Javascript')">Javascript</button>
		 </div>
        </div>
		<div id="HTML" class="subjectcontent">
			<h3>HTML</h3>
			<p>bla.</p>
		</div>

		<div id="CSS" class="subjectcontent">
		    <h3>CSS</h3>
		    <p>bla.</p>
		</div>

		<div id="Javascript" class="subjectcontent">
		    <h3>Javascript</h3>
		    <p>bla.</p>
		</div> 
    </div>
	<div class="beforefooter">
    </div>
    <script src="JS/index-subjectTab.js"></script>
	<script src="JS/index-regModal.js"></script>
	<script src="JS/index-regForm.js"></script>

<footer>
    <div class="footer-container">
        <div class="first-col">
            <ul>
                <h1>Movies</h1>
                <li><a href="nowshowingmovie.php" target="_blank">Now Showing</a></li>
                <li><a href="comingsoonmovie.php" target="_blank">Coming Soon</a></li>
            </ul>
        </div>
		<div class="second-col">
            <ul>
                <h1>Cinemas</h1>
                <li><a href="all_cinema.php" target="_blank">All Cinemas</a></li>
                
            </ul>
        </div>
        <div class="third-col">
            <ul>
                <h1>Showtimes</h1>
                <li><a href="showtimes.php" target="_blank">Search Showtimes</a></li>
            </ul>
        </div>
        <div class="fourth-col">
            <ul>
                <h1>About Us</h1>
                <li><a href="about_us.php" target="_blank">About Pentagon Cinemas</a></li>
            </ul>
        </div>
    </div>
	<div class="copyright">
                <h5>All Content Copyright © of Pentagon Cinemas Sdn Bhd 2017. All Rights Reserved</h5>
            </div>
</footer>
</body>
</html>