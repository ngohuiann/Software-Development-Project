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
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CodeCube | Learn to code at your own paces</title>
    <link rel="icon" href="Images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/index.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/file.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cuprum|Raleway|Dosis|Titillium+Web|Oswald|Montserrat|Overpass+Mono|Roboto+Condensed|Saira+Extra+Condensed" rel="stylesheet">
</head>
<body>
    <script>
        var navTop = $('#subjectbar').offset().top;

        $(window).scroll(function(){
            if ($(this).scrollTop() >= navTop) {
                $('#subjectbar').css('position', 'fixed');
                $('#navi').css('position', 'relative');
                $('#subjectbar').css('top', '0');
            } else {
                $('#subjectbar').css('position', 'absolute');
                $('#subjectbar').css('top', navTop);
                $('#navi').css('position', 'fixed');
            }
        });
    </script>
	<div class="topnav" id="navi">
	  <a style="float:left;" href="index.php" title="Homepage">
		<img src="Images/logo.png" width="220px" height="60px">
	  </a>
		<div class="searchbar">
		  <div class="box-1">
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
            <h2>at your own paces</h2>
            <button id="reg-btn" class="get-start">Get Started</button>
            <!-- The Modal -->
			<div id="regModal" class="modal">
			  <!-- Modal content -->
				<div class="modal-content">
					<form id="regForm" action="" method="post" enctype="multipart/form-data">
					<!-- One "tab" for each step in the form: -->
					<div class="tab">
					<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/778862-200.png" style="text-align: center; margin: 0; width: 100px;" />
					<h2>Sign Up</h2>
                        <table border="0" class="reg1">
                            <tr><td><h3>1. Login Details</h3></td></tr>
                            <tr>
                                <td><span style="position:absolute;margin-left:-123px;margin-top:17px;color:black;font-size:15px;" class="fa fa-user"></span><input placeholder="Username" name="username" type="text" required="required"/></td>
                            </tr>
                            <tr>
                                <td><span style="position:absolute;margin-left:-122px;margin-top:18px;color:black;font-size:15px;" class="fa fa-lock"></span><input placeholder="Password" name="password" type="password" required="required"/></td>
                            </tr>
                            <tr><td style="text-align:right;padding-top:5px;"><a id="ady" href="login.php">Already own an account?</a></td></tr>
                            <tr><td><input type="button" value="Continue" class="nextbtn" id="nextBtn" onclick="nextPrev(1)"></td></tr>
					   </table>
					</div>

					<div class="tab">
                        <table border="0" class="reg2">
                            <tr><td colspan="2"><h3>2. Profile Settings</h3></td></tr>
                            <tr>
                                <td colspan="2"><input title="Full Name" class="set" placeholder="Full Name" name="fullname" type="text" required/></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left;padding:15px;font-size: 15px;font-family: 'Roboto Condensed';">
                                    <div class="radio-group">
                                        <input type="radio" required id="female" name="gender"><label for="female">Female</label><input type="radio" id="male" name="gender"><label for="male">Male</label><input type="radio" id="others" name="gender"><label for="others">Others</label>
                                    </div>                                    
						        </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input title="Date of Birth" name="DOB" required type="date" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input title="Email Address" name="email" placeholder="Email Address" required type="email" /></td>
                            </tr>                            
                            <tr>
                                <td><input type="button" id="prevBtn" value="Back" onclick="nextPrev(-1)"></td>
					            <td><input type="button" id="nextBtn" value="Continue" onclick="nextPrev(1)"></td>
                            </tr>
					   </table>
					  
					</div>
                        
                        <script>
                            var inputs = document.querySelectorAll( '.inputfile' );
                            Array.prototype.forEach.call( inputs, function( input )
                            {
                                var label	 = input.nextElementSibling,
                                    labelVal = label.innerHTML;

                                input.addEventListener( 'change', function( e )
                                {
                                    var fileName = '';
                                    if( this.files && this.files.length > 1 )
                                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                                    else
                                        fileName = e.target.value.split( '\\' ).pop();

                                    if( fileName )
                                        label.querySelector( 'span' ).innerHTML = fileName;
                                    else
                                        label.innerHTML = labelVal;
                                });
                            });
                        </script>

					<div class="tab">
                        <table border="0" class="reg3">
                            <tr><td colspan="2"><h3>3. Set a Profile Picture (Optional)</h3></td></tr>
                            <tr><td colspan="2"><img src="https://d30y9cdsu7xlg0.cloudfront.net/png/697829-200.png" style="width: 180px; padding: 20px; border-radius: 50%; border: none;" /></td></tr>
                            
                            <tr><td><input type="file" name="file" id="file" class="inputfile" />
                            <label for="file">Upload A Picture</label></td></tr>
                            
                            <tr>
                                <td><input type="button" id="prevBtn" value="Back" onclick="nextPrev(-1)"></td>
                                <td><input type="submit" name="submit" id="nextBtn" value="Done" style="overflow:auto; margin-top: 30px; float: right;" /></td>
                            </tr>
					   </table>
					</div>

					<!-- Circles which indicates the steps of the form: -->
					<div style="text-align:center;margin-top:20px;">
					  <span class="step"></span>
					  <span class="step"></span>
					  <span class="step"></span>
					</div>
					</form> 
				</div>
			</div>
        </div>
    </div>
    <div class="course-desc" id="subjectbar">
        <div style="background-color:#2b303b;">
		 <div class="subject-tab">
			 <button class="subjectlinks htmltab" onclick="openSubject(event, 'HTML')"><span>&lt;</span> HTML <span>&gt;</span></button>
			<button class="subjectlinks csstab" onclick="openSubject(event, 'CSS')"><span>&lt;</span> CSS <span>&gt;</span></button>
			<button class="subjectlinks javascripttab" onclick="openSubject(event, 'Javascript')"><span>&lt;</span> JavaScript <span>&gt;</span></button>
		 </div>
        </div>
		<div id="HTML" class="subjectcontent">
			<div class="container">
                <div class="moduletitle">
                    <a>
                        <h3>1&nbsp;&nbsp;HTML: Introduction to HTML</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>2&nbsp;&nbsp;HTML: Basic elements</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>3&nbsp;&nbsp;HTML: Attributes</h3>
                    </a>
                </div>
                <a href="html.php" id="showall">Show All</a>
            </div>
        </div>
            

		<div id="CSS" class="subjectcontent">
			<div class="container">
                <div class="moduletitle">
                    <a>
                        <h3>1&nbsp;&nbsp;CSS: Introduction to CSS</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>2&nbsp;&nbsp;CSS: Syntax</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>3&nbsp;&nbsp;CSS: Background &amp; Colors</h3>
                    </a>
                </div>
                <a href="css.php" id="showall">Show All</a>
            </div>
        </div>

		<div id="Javascript" class="subjectcontent">
			<div class="container">
                <div class="moduletitle">
                    <a>
                        <h3>1&nbsp;&nbsp;JavaScript: Introduction to JavaScript</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>2&nbsp;&nbsp;JavaScript: Syntax</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>3&nbsp;&nbsp;JavaScript: Statements</h3>
                    </a>
                </div>
                <a href="css.php" id="showall">Show All</a>
            </div>
        </div>
    </div>
	<div class="beforefooter">
    </div>
    <script src="JS/index-subjectTab.js"></script>
	<script src="JS/index-regModal.js"></script>
	<script src="JS/index-regForm.js"></script>
    <script src="JS/index-scrolling.js"></script>
    <script src="JS/index-searchEnter.js"></script>

<footer>
    <div class="footer-container">
        <div class="first-col">
            <ul>
                <li><a href="html.php" target="_blank">HTML</a></li>
                <li><a href="css.php" target="_blank">CSS</a></li>
                <li><a href="javascript.php" target="_blank">JavaScript</a></li>
                <li><a href="view_all.php" target="_blank">View All Courses</a></li>
            </ul>
        </div>
		<div class="second-col">
            <ul>
                <li><a href="aboutus.php" target="_blank">About Us</a></li>
                <li><a href="faq.php" target="_blank">FAQ</a></li>
                <li><a href="policy.php" target="_blank">Privacy Policy</a></li>
                <li><a href="tnc.php" target="_blank">Terms &amp; Conditions</a></li>
            </ul>
        </div>
        <div class="third-col">
            <ul>
                <h4>We are always in touch with our user</h4>
                <h4><span style="color:dimgrey;font-size:12px;" class="fa fa-phone"></span><span style="color:dimgrey;font-family: 'Roboto Condensed', sans-serif;font-size:12px;">&nbsp;&nbsp;&nbsp;+6010-2216938</span></h4>
                
                <h4><span style="color:dimgrey;font-size:12px;" class="fa fa-envelope"></span><span style="color:dimgrey;font-family: 'Roboto Condensed', sans-serif;font-size:12px;">&nbsp;&nbsp;&nbsp;codecube@gmail.com</span></h4>
                
                <h4><span style="color:dimgrey;font-size:12px;" class="fa fa-location-arrow"></span><span style="color:dimgrey;font-family: 'Roboto Condensed', sans-serif;font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;3.0551° N, 101.7008° E</span></h4>
            </ul>
        </div>
        
    </div>
	<div class="fourth-col">
        <div class="footer-logo">
            <img src="Images/logo.png" width="220px" height="60px" style="margin-left:156px;border:0px solid red;"/>
            <h3>&copy;2017 CodeCube</h3>
            <p>Learn to Code at your own paces.</p>
            <div class="social-media">
                <a href="###" class="fa fa-facebook"></a>
                <a href="###" class="fa fa-twitter"></a>
                <a href="###" class="fa fa-instagram"></a>
                <a href="###" class="fa fa-youtube"></a>
            </div>
        </div>           
        <div></div>
    </div>
</footer>
</body>
</html>