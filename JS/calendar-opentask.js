function openTask(event, date) {
		// Declare all variables
		var i, taskcontent, days;

		// Get all elements with class="taskcontent" and hide them
		taskcontent = document.getElementsByClassName("taskcontent");
		for (i = 0; i < taskcontent.length; i++) {
			taskcontent[i].style.display = "none";
		}

		// Get all elements with class="days" and remove the class "active"
		days = document.getElementsByClassName("days");
		for (i = 0; i < days.length; i++) {
			days[i].className = days[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the button that opened the tab
		document.getElementById(date).style.display = "block";
		event.currentTarget.className += " active";
	} 