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

for($day_num = 1; $day_num <= $days_in_month; $day_num++): ?>
	<td class="days" id="<?php echo $day_num; ?>days" onclick="openTask(event,'<?php	echo $day_num; ?>')" >
	<div class="day-num"><?php echo $day_num ?></div></td>
	<?php if($blank_days == 6):
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
			for($day_num = 1; $day_num <= $days_in_month; $day_num++): ?>
			<div id="<?php echo $day_num; ?>" class="taskcontent">';
			<div class="header">
				<h2><?php echo $day_num; ?></h2>
				<input type="text" id="the<?php echo $day_num; ?>myInput" placeholder="Title...">
				<span onclick="thenewElement()" class="addBtn">Add</span>
			</div>';
			<ul id="myUL<?php echo $day_num; ?>">
				<li id="li<?php echo $day_num; ?>">Hit the gym</li>
				<li id="li<?php echo $day_num; ?>" class="checked">Pay bills</li>
			</ul>
			</div>

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
		//var selected_dates = document.getElementById("");
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
		<?php endfor; ?>
	</script>
    </body>
</html>