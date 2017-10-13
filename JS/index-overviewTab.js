function openOverview(evnt, overviewName) {
    var n, overviewcontent, overviewlinks;
    overviewcontent = document.getElementsByClassName("overviewcontent");
    for (n = 0; n < overviewcontent.length; n++) {
        overviewcontent[n].style.display = "none";
    }
    overviewlinks = document.getElementsByClassName("overviewlinks");
    for (n = 0; n < overviewlinks.length; n++) {
        overviewlinks[n].className = overviewlinks[n].className.replace(" active", "");
    }
    document.getElementById(overviewName).style.display = "block";
    evnt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();