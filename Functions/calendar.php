<html>
<?php 
include('../Conf/init.php');

$current_date = date('d');
$current_month = date('m');
$current_year = date('Y');
$blank_days = date('w',mktime(0,0,0,$current_month,1,$current_year));
$days_in_month = date('t',mktime(0,0,0,$current_month,1,$current_year));
$days_of_week = 1;
$day_counter = 0;

$today = date("Y-m-d");
?>
<head> 
    <link rel="stylesheet" type="text/css" href="/sdp/CSS/calendar.css" />
</head>

<body>
	<div class="wrap-task">
    <table class="my-calender" id="the-node" cellspacing="0" cellpadding="0">
		<tr><th colspan="7"><?php echo date('F Y'); ?></th></tr>
        <tr class="calendar-head">
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
		<tr>
			<?php 
			/* print "blank" days until the first of the current week */
			for($x = 0; $x < $blank_days; $x++):
				echo '<td class="no-dates"> </td>';
				$days_of_week++;
			endfor; 

			for($day_num = 1; $day_num <= $days_in_month; $day_num++): ?>
			<td class="days" id="<?php echo $day_num; ?>days" onclick="openTask(event,'<?php	echo $day_num; ?>')" >
				<div class="day-num"><?php echo $day_num ?></div>
			</td>
			<?php 
			if($blank_days == 6):
				echo '</tr>';
				if(($day_counter+1) != $days_in_month):
					echo '<tr>';
				endif;
				$blank_days = -1;
				$days_of_week = 0;
			endif;
			$days_of_week++; $blank_days++; $day_counter++;
			endfor;

			if($days_of_week < 8):
				for($x = 1; $x <= (8 - $days_of_week); $x++):
					echo '<td class="no-dates"> </td>';
				endfor;
			endif;
		?>
		</tr>
    </table>

	<?php 
		for($day_num = 1; $day_num <= $days_in_month; $day_num++): 
	?>
	
    <div class="taskcontent" id="<?php echo $day_num; ?>">
        <div class="taskhead">
            <h3 style="float:left;">
				<?php  
				$dates = $current_year . "-" . $current_month . "-" . $day_num;
				echo $dates; 
				?>
			</h3>
        </div>
		<div class="tasktodo">
			<?php 
			$result = mysqli_query($conn,"SELECT * FROM schedule INNER JOIN module ON schedule.ModuleID = module.ModuleID INNER JOIN user ON schedule.UserID = user.UserID INNER JOIN course ON module.CourseID = course.CourseID WHERE user.UserID='26' AND schedule.ScheduleDate='$dates'");
				if (!$result) {
					printf("Error: %s\n", mysqli_error($conn));
					exit();
				}
			?>
			<div class="panel">
				<?php 
				while($schedule=mysqli_fetch_array($result))
				{
				echo "<button class='schedule-items' id='schedule";
				echo $schedule['ScheduleID'];
				echo "'>";
				echo $schedule['ModuleTitle'];
				echo "</button><br />"; }?>
			</div> 
		</div>
    </div>
	<?php endfor; ?>
	</div>
	
<script>
var d = document.getElementById("<?php echo $current_date;?>days");
d.className += " active";
document.getElementById(<?php echo $current_date;?>).style.display = "block";
</script>
<script src="../JS/calendar-opentask.js"></script>

	<?php 
		$result1 = mysqli_query($conn,"SELECT * FROM schedule INNER JOIN module ON schedule.ModuleID = module.ModuleID INNER JOIN user ON schedule.UserID = user.UserID INNER JOIN course ON module.CourseID = course.CourseID WHERE user.UserID='26' AND schedule.ScheduleDate='$dates'");
		if (!$result1) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}
	?>
    <div class="task-menu" id="sch">
        <div class="task-details">
			<?php 
			while($schedule1=mysqli_fetch_array($result1))
			{
				echo "<button class='schedule-items' id='schedule";
				echo $schedule1['ScheduleID'];
				echo "'>";
				echo $schedule1['ModuleTitle'];
				echo "</button><br />"; 
			}?>
        </div>
    </div>

</body>
</html>