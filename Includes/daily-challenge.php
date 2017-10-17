<html>
<head>
<?php 
include('Conf/init.php');
session_start();
$UID = $_SESSION['UID'];
$current_date = date('d');
$current_month = date('M');
$curmonth = date('m');
$current_year = date('Y');
$dates = $current_month . " " . $current_date . ", " . $current_year;
$currentdate = date("Y-m-d");

$chaquestion = mysqli_query($conn,"SELECT * FROM challengequestion INNER JOIN challenge ON challengequestion.ChaQuestionID = challenge.ChaQuestionID WHERE challenge.IssueDate = '$currentdate'");
$challengequestion=mysqli_fetch_array($chaquestion);
$chastatus = mysqli_query($conn,"SELECT * FROM challenge INNER JOIN challengestatus ON challenge.ChallengeID = challengestatus.ChallengeID WHERE challenge.IssueDate = '$currentdate' AND challengestatus.UserID = '$UID'");
$challengestatus=mysqli_fetch_array($chastatus);
?>
    <link rel="stylesheet" type="text/css" href="CSS/daily-challenge.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/body.css"/>
</head>
<body>
    <div class="daily-challenge">
        <h1>Daily Challenge:</h1>
		<div class="challenge-content">
		<h1><?php echo $challengequestion['ChallengeQuestion']; ?></h1>
		<h1><?php echo $challengestatus['Status']; ?></h1>
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
</body>
</html>