<html>
<?php 
	include('includes/context-menu.html');
	$current_date = date('d');
	$current_month = date('m');
	$current_year = date('Y');
	$blank_days = date('w',mktime(0,0,0,$current_month,1,$current_year));
	$days_in_month = date('t',mktime(0,0,0,$current_month,1,$current_year));
	$days_of_week = 1;
	$day_counter = 0;
?>
    <head> 
        <link rel="stylesheet" type="text/css" href="CSS/calendar-v1.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="Javascript/context-menu.js"></script>

    </head>

    <body>
        <table class="my-calender" id="the-node" cellspacing="0" cellpadding="0">
			<tr>
				<th colspan="7"><?php echo date('F Y'); ?></th>
			</tr>
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
<?php /* print "blank" days until the first of the current week */
for($x = 0; $x < $blank_days; $x++):
	echo '<td class="no-dates"> </td>';
	$days_of_week++;
endfor; 

for($day_num = 1; $day_num <= $days_in_month; $day_num++):
	echo '<td class="days"';
	echo 'id="';
	echo $day_num;
	echo '"><span class="context-menu-one btn btn-neutral">';
		/* add in the day number */
	echo '<div class="day-num">'.$day_num.'</div>';
	echo '</td>';
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
	<script>
		var d = new Date();
		var day = d.getDate();
		document.getElementById(day).style.backgroundColor  = '#E8EAF6'
	</script>
    </body>
</html>