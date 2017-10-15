<?php 
$UID = $_SESSION['UID'];
$Username = $_SESSION['Username'];
$result = mysqli_query($conn,"SELECT * FROM user WHERE UserID='$UID'");
$row=mysqli_fetch_array($result);
?>

<head>
    <link rel="stylesheet" type="text/css" href="/Software-Development-Project/CSS/header.css" />
	<link rel="stylesheet" type="text/css" href="/Software-Development-Project/CSS/body.css" />
	<link rel="stylesheet" type="text/css" href="/Software-Development-Project/CSS/header-user.css" />
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
	<div class="dropdown">
		<button class="user-menu-btn" id="loginlink"><?php echo $Username; ?></button>
		<div class="dropdown dropdown-content">
            <div class="row">
                <a href="#"><div class="column"><img src="Images/ProfilePicture/<?php echo $row['ProfilePicture']; ?>" style="border-radius: 50%;" width="60px"/><br />My profile</div></a>
                <a href="#"><div class="column"><img src="Images/progress.svg" width="60px"/><br />Progress</div></a>
            </div> 
            <div class="row" style="margin-top: 10px;">
                <a href="#"><div class="column"><img src="Images/calendar.svg" width="50px"/><br />Schedule</div></a>
                <a href="#"><div class="column"><img src="Images/trophy.svg" width="50px"/><br />Achievement</div></a>
            </div> 
            <div class="row" style="margin-top: 10px;">
                <a href="#"><div class="column"><img src="Images/course.svg" width="50px"/><br />Course</div></a>
                <a href="Functions/logout.php"><div class="column"><img src="Images/logout.svg" width="50px"/><br />Logout</div></a>
            </div> 
		</div>

	</div>
	<div class="coins">
		<img src="Images/coins.svg" width="25px; padding-top: 2px;" style="float:left;"/> 
		<span class="coins_value"><?php echo $row['Coin']; ?></span>
	</div>
	<a id="courselink" href="view_all.php">View All Courses</a>
	</div>
	
		
		<script>
		document.getElementById("loginlink").addEventListener("mouseover", mouseOver);
		document.getElementById("dropdown-content").addEventListener("mouseout", mouseOut);

		function mouseOver() {
			document.getElementById("dropdown-content").style.display = "block";
		}

		function mouseOut() {
			document.getElementById("dropdown-content").style.display = "none";
		}
		</script>
</body>