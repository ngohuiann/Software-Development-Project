<html>
<?php
include('../Conf/init.php');
include('../Conf/session.php');
$MID = intval($_GET['id']);

if (isset($_GET['submit'])) {
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET")
{
$UID = $_SESSION['UID'];

$review=mysqli_real_escape_string($conn,$_GET['review']);
$rating=mysqli_real_escape_string($conn,$_GET['rating']);

$sql="INSERT INTO review (UserID,ModuleID,Rating,ReviewDesc) VALUES ('$UID','$MID','$rating','$review')";
	if(!mysqli_query($conn,$sql))
	{
		die('Error:' .mysqli_error($conn));
	}
echo "<script>
	alert('Thank you for your review!');
	window.location.href='/sdp/index.php';
	</script>";
}}
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="../CSS/rating.css">
</head>
<body>
	<form method="get">
	Review:
	<textarea name="review" required="required" rows="10" cols="40"></textarea><br />
	Rating:
	<input type="hidden" id="rating" name="rating" value="">
	<div class='rating-stars text-center'>
		<ul id='stars'>
			<li class='star' title='Poor' data-value='1'>
				<i class='fa fa-star fa-fw'></i>
			</li>
			<li class='star' title='Fair' data-value='2'>
				<i class='fa fa-star fa-fw'></i>
			</li>
			<li class='star' title='Good' data-value='3'>
				<i class='fa fa-star fa-fw'></i>
			</li>
			<li class='star' title='Excellent' data-value='4'>
				<i class='fa fa-star fa-fw'></i>
			</li>
			<li class='star' title='WOW!!!' data-value='5'>
				<i class='fa fa-star fa-fw'></i>
			</li>
		</ul>
	</div>
	<div class='success-box'>
		<div class='clearfix'></div>
		<div class='text-message'></div>
		<div class='clearfix'></div>
	</div>
	<input type="submit" name="submit" value="Submit" />
	</form>
	<script>
	$(document).ready(function(){
  
	  /* 1. Visualizing things on Hover - See next part for action on click */
	  $('#stars li').on('mouseover', function(){
		var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
	   
		// Now highlight all the stars that's not after the current hovered star
		$(this).parent().children('li.star').each(function(e){
		  if (e < onStar) {
			$(this).addClass('hover');
		  }
		  else {
			$(this).removeClass('hover');
		  }
		});
		
	  }).on('mouseout', function(){
		$(this).parent().children('li.star').each(function(e){
		  $(this).removeClass('hover');
		});
	  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	  document.getElementById("rating").value = ratingValue;
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");

}
	</script>
	</form>
</body>
</html>