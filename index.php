<html>
<?php
include('Conf/init.php');

if (isset($_POST['submit'])) {
$rowcount=0;
$username=mysqli_real_escape_string($conn,$_POST['username']); 
$sql1 = "SELECT * FROM user WHERE username='$username'";

if(!mysqli_query($conn,$sql1))
{
die('Error:' .mysqli_error($conn));
}

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
	include("/kyro/core/database/connect.php");
	$sql="INSERT INTO user (username,password,fullname,DOB,email,gender,IC) VALUES ('$_POST[username]','$_POST[password]','$_POST[fullname]','$_POST[DOB]','$_POST[email]','$_POST[gender]','$_POST[IC]')";
	
	if(!mysqli_query($conn,$sql))
		{
		die('Error:' .mysqli_error($conn));
		}
		echo "<script>
	alert('Register Successful!');
	window.location.href='####';
	</script>";
}
	
mysqli_close($conn);

 ?>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
</head>
<body>
    <div class="main-header">
        <h1>Learn Anything</h1>
        <h2>on your schedule</h2>
        <button id="reg-btn" class="get-start">Get Started</button>
		<!-- The Modal -->
			<div id="regModal" class="modal">
			  <!-- Modal content -->
				<div class="modal-content">
					<form id="regForm" action="">
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
					  <input type="file" name="" oninput="this.className = ''">
					</div>

					<div style="overflow:auto; margin-top: 30px;">
					  <div style="float:right;">
						<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
						<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
					  </div>
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