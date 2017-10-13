<html>

<<<<<<< HEAD
=======
if (isset($_POST['submit'])) {
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$target_dir = "Images/ProfilePicture";
$password = mysqli_real_escape_string($conn,$_POST['password']); 
$hashedpwd = password_hash($password, PASSWORD_DEFAULT);
$check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
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
	if($check !== false) {
		$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_name = basename( $_FILES["profile_pic"]["name"]);
		$sql2="INSERT INTO user (Username,Password,Fullname,DOB,Email,Gender,ProfilePicture) VALUES ('$_POST[username]','$hashedpwd','$_POST[fullname]','$_POST[DOB]','$_POST[email]','$_POST[gender]','$file_name')";
		
		if(!mysqli_query($conn,$sql2))
		{
		die('Error:' .mysqli_error($conn));
		}
	
	}else{
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
}}

?>
>>>>>>> 4767cc0cebfbb4595be4c6efc53db86488b2b0b1
<head>
    <link rel="stylesheet" type="text/css" href="CSS/index.css"/>
	<link href="https://fonts.googleapis.com/css?family=Dosis|Titillium+Web" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
	<div class="topnav">
	  <a style="float:left;" href="index.php">
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
	  <a id="loginlink" href="#contact">Log In</a>
	  <a id="courselink" href="#about">View All Course</a>
	</div>
    <div class="main-header">
        <h1>Learn to Code</h1>
        <h2>on your schedules</h2>
        <button id="reg-btn" class="get-start">Get Started</button>
		<!-- The Modal -->
			<div id="regModal" class="modal">
			  <!-- Modal content -->
				<div class="modal-content">
<<<<<<< HEAD
					<form id="regForm" action="">
=======
					<form class="regForm" action="" method="post" enctype="multipart/form-data">
>>>>>>> 4767cc0cebfbb4595be4c6efc53db86488b2b0b1
					<!-- One "tab" for each step in the form: -->
					<div class="tab">
					<img src="Images/reg-icon.png" style="text-align: center; margin: 0; width: 100px;" />
					<h2>Sign Up</h2>
					Username:
					  <input placeholder="Username..." name="username" type="text" oninput="this.className = ''">
					  Password: 
					  <input placeholder="Password..." name="password" type="password" oninput="this.className = ''">
					  <a href="#" style="float: left; margin-top: 30px;">Already own an account?</a>
					</div>

					<div class="tab"><h3>2. Basic Info</h3>
					Full Name
					  <input placeholder="Full name..." name="fullname" oninput="this.className = ''">
					Gender
					  <input placeholder="Phone..." name="gender" oninput="this.className = ''">
					DOB
					  <input placeholder="Phone..." name="DOB" oninput="this.className = ''">
					IC Number
					  <input placeholder="IC number..." name="IC" oninput="this.className = ''">
					Email Address
					  <input placeholder="Email..." name="email" type="email" oninput="this.className = ''">
					</div>

					<div class="tab"><h3>3. Upload a profile picture</h3>
						<img src="Images/default-profile.png" style="width: 150px; padding: 20px; margin: 15px; border-radius: 50%; border: 1px solid black;" />
<<<<<<< HEAD
					  <input type="file" name="" oninput="this.className = ''">
					</div>

					<div style="overflow:auto; margin-top: 30px;">
					  <div style="float:right;">
						<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
						<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
					  </div>
=======
					  <input type="file" name="profile_pic" />
					  <input type="submit" name="submit" value="Skip" style="overflow:auto; margin-top: 30px; float: right;" />
>>>>>>> 4767cc0cebfbb4595be4c6efc53db86488b2b0b1
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
    <div class="course-desc">
    </div>
	
        
	<script>
	var modal = document.getElementById('regModal');

	// Get the button that opens the modal
	var btn = document.getElementById("reg-btn");

	// When the user clicks on the button, open the modal
	btn.onclick = function() {
		modal.style.display = "block";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	} 
	</script>
	<script>
	var currentTab = 0; // Current tab is set to be the first tab (0)
	showTab(currentTab); // Display the current tab

	function showTab(n) {
	  // This function will display the specified tab of the form ...
	  var x = document.getElementsByClassName("tab");
	  x[n].style.display = "block";
	  // ... and fix the Previous/Next buttons:
	  if ((n == 0) || (n == (x.length - 1))) {
		document.getElementById("prevBtn").style.display = "none";
	  } else {
		document.getElementById("prevBtn").style.display = "inline";
	  }
	  if (n == (x.length - 2)) {
		document.getElementById("nextBtn").innerHTML = "Submit";
	  } else if (n == (x.length -1)){
		document.getElementById("nextBtn").innerHTML = "Skip";
	  } else {
		document.getElementById("nextBtn").innerHTML = "Next";
	  }
	  // ... and run a function that displays the correct step indicator:
	  fixStepIndicator(n)
	}

	function nextPrev(n) {
	  // This function will figure out which tab to display
	  var x = document.getElementsByClassName("tab");
	  // Exit the function if any field in the current tab is invalid:
	  if (n == 1 && !validateForm()) return false;
	  // Hide the current tab:
	  x[currentTab].style.display = "none";
	  // Increase or decrease the current tab by 1:
	  currentTab = currentTab + n;
	  // if you have reached the end of the form... :
	  if (currentTab >= x.length) {
		//...the form gets submitted:
		document.getElementById("regForm").submit();
		return false;
	  }
	  // Otherwise, display the correct tab:
	  showTab(currentTab);
	}

	function validateForm() {
	  // This function deals with validation of the form fields
	  var x, y, i, valid = true;
	  x = document.getElementsByClassName("tab");
	  y = x[currentTab].getElementsByTagName("input");
	  // A loop that checks every input field in the current tab:
	  for (i = 0; i < y.length; i++) {
		// If a field is empty...
		if (y[i].value == "") {
		  // add an "invalid" class to the field:
		  y[i].className += " invalid";
		  // and set the current valid status to false:
		  valid = false;
		}
	  }
	  // If the valid status is true, mark the step as finished and valid:
	  if (valid) {
		document.getElementsByClassName("step")[currentTab].className += " finish";
	  }
	  return valid; // return the valid status
	}

	function fixStepIndicator(n) {
	  // This function removes the "active" class of all steps...
	  var i, x = document.getElementsByClassName("step");
	  for (i = 0; i < x.length; i++) {
		x[i].className = x[i].className.replace(" active", "");
	  }
	  //... and adds the "active" class on the current step:
	  x[n].className += " active";
	}
	</script>
</body>
</html>