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
	echo '<td class="days" id="';
	echo $day_num;
	echo 'day"';
	echo 'onclick="openTask(event, \'';
	echo $day_num;
	echo '\')">';
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
		
		<?php 
			for($day_num = 1; $day_num <= $days_in_month; $day_num++):
				echo '<div id="';
				echo $day_num;
				echo '" class="taskcontent">';
				echo '<div class="header">';
				echo '<h2>';
				echo $day_num;
				echo '</h2>';
				echo '<input type="text" id="the';
				echo $day_num;
				echo 'myInput" placeholder="Title...">';
				echo '<span onclick="the';
				echo $day_num;
				echo 'newElement()" class="addBtn">Add</span>';
				echo '</div>';
				echo '<ul id="myUL';
				echo $day_num;
				echo '">';
				echo '<li>Hit the gym</li>';
				echo '<li class="checked">Pay bills</li>';
				echo '</ul>';
				echo '</div>';
			endfor;
		?>	
	<script src="Javascript/task-menu.js"></script>
	<script>
	// Create a "close" button and append it to each list item
		var myNodelist = document.getElementsByTagName("LI");
		var i;
		for (i = 0; i < myNodelist.length; i++) {
		  var span = document.createElement("SPAN");
		  var txt = document.createTextNode("\u00D7");
		  span.className = "close";
		  span.appendChild(txt);
		  myNodelist[i].appendChild(span);
		}

		// Click on a close button to hide the current list item
		var close = document.getElementsByClassName("close");
		var i;
		for (i = 0; i < close.length; i++) {
		  close[i].onclick = function() {
			var div = this.parentElement;
			div.style.display = "none";
		  }
		}

		// Add a "checked" symbol when clicking on a list item
		var list = document.querySelector('ul');
		list.addEventListener('click', function(ev) {
		  if (ev.target.tagName === 'LI') {
			ev.target.classList.toggle('checked');
		  }
		}, false);

		// Create a new list item when clicking on the "Add" button
		function the<?php echo $day_num; ?>newElement() {
		  var li = document.createElement("li");
		  var inputValue = document.getElementById("the<?php echo $day_num; ?>myInput").value;
		  var t = document.createTextNode(inputValue);
		  li.appendChild(t);
		  if (inputValue === '') {
			alert("You must write something!");
		  } else {
			document.getElementById("myUL<?php echo $day_num; ?>").appendChild(li);
		  }
		  document.getElementById("the<?php echo $day_num; ?>myInput").value = "";

		  var span = document.createElement("SPAN");
		  var txt = document.createTextNode("\u00D7");
		  span.className = "close";
		  span.appendChild(txt);
		  li.appendChild(span);

		  for (i = 0; i < close.length; i++) {
			close[i].onclick = function() {
			  var div = this.parentElement;
			  div.style.display = "none";
			}
		  }
		} 
	</script>
    </body>
</html>