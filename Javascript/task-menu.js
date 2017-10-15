		var d = new Date();
		var day = d.getDate();
		var id = day + "day";
		document.getElementById(id).style.backgroundColor  = '#E8EAF6'

		function openTask(event, daynum) {
		// Declare all variables
		var i, taskcontent, td;

		// Get all elements with class="taskcontent" and hide them
		taskcontent = document.getElementsByClassName("taskcontent");
		for (i = 0; i < taskcontent.length; i++) {
			taskcontent[i].style.display = "none";
		}

		// Get all elements with class="td" and remove the class "active"
		td = document.getElementsByClassName("days");
		for (i = 0; i < td.length; i++) {
			td[i].className = td[i].className.replace(" active", "");
		}

			// Show the current tab, and add an "active" class to the button that opened the tab
			document.getElementById(daynum).style.display = "block";
			event.currentTarget.className += " active";
		} 
		