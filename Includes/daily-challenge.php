<html>
<head>
<?php 
include('Conf/init.php');
include('login-reward.php');
session_start();
$UID = $_SESSION['UID'];
$current_date = date('d');
$current_month = date('M');
$curmonth = date('m');
$current_year = date('Y');
$dates = $current_month . " " . $current_date . ", " . $current_year;
$currentdate = date("Y-m-d");

// Challenge Question
$chaquestion = mysqli_query($conn,"SELECT * FROM challengequestion INNER JOIN challenge ON challengequestion.ChaQuestionID = challenge.ChaQuestionID WHERE challenge.IssueDate = '$currentdate'");
$challengequestion=mysqli_fetch_array($chaquestion);

// Challenge Status
$chastatus = mysqli_query($conn,"SELECT * FROM challenge INNER JOIN challengestatus ON challenge.ChallengeID = challengestatus.ChallengeID WHERE challenge.IssueDate = '$currentdate' AND challengestatus.UserID = '$UID'");
$challengestatus=mysqli_fetch_array($chastatus);

// Consecutive Login
$conloginsql = mysqli_query($conn,"SELECT ConsecutiveLogin FROM user WHERE UserID = '$UID'");
$conlogin = mysqli_fetch_array($conloginsql);
if ($conlogin['ConsecutiveLogin'] == 1){
	$day = 1;
} elseif ($conlogin['ConsecutiveLogin'] == 2){
	$day = 2;
} elseif ($conlogin['ConsecutiveLogin'] == 3){
	$day = 3;
} elseif ($conlogin['ConsecutiveLogin'] >= 4){
	$day = 4;
} 
?>
    <link rel="stylesheet" type="text/css" href="CSS/daily-challenge.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/body.css"/>
	<script src="JS/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="daily-challenge">
        <h1>Daily Challenge:</h1>
		<div class="challenge-content">
		<h1><?php echo $challengequestion['ChallengeQuestion']; ?></h1>
		<progress value="<?php echo $challengestatus['Status'];?>" max="<?php echo $challengequestion['ChallengeAnswer'];?>"></progress>
		</div>
		<p id="demo" onload="clock()" style="font-size:30px"></p>
    </div>
	<script>
	// Set the date we're counting down to
	var countDownDate = new Date("<?php echo $dates; ?> 23:59:59").getTime();

	// Update the count down every 1 second
	var countdownfunction = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;
		
		// Time calculations for days, hours, minutes and seconds
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Output the result in an element with id="demo"
		document.getElementById("demo").innerHTML = hours + "h "
		+ minutes + "m " + seconds + "s ";
		
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(countdownfunction);
			document.getElementById("demo").innerHTML = "EXPIRED";
		}
	}, 1000);
	</script>
	<script>
	$(function() {
    if ( localStorage.getItem('seen') != (new Date()).getDate()) 	{
        setTimeout(showpanel, 1000);
		}
	});


	function showpanel() {
		var rewardmodal = document.getElementById('reward-modal');
        rewardmodal.style.display = "block";

        // add active class to current con login
		var d = document.getElementById("day<?php echo $day;?>");
		d.className += " active";

        window.onclick = function(event) {
        if (event.target == rewardmodal) {
        rewardmodal.style.display = "none";
			}
		} 

		localStorage.setItem('seen', (new Date()).getDate());
	}
	</script>
</body>
</html>