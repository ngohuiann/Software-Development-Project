function openSubject(event, subjectName) {
    var i, subjectcontent, subjectlinks;
    subjectcontent = document.getElementsByClassName("subjectcontent");
    for (i = 0; i < subjectcontent.length; i++) {
        subjectcontent[i].style.display = "none";
    }
    subjectlinks = document.getElementsByClassName("subjectlinks");
    for (i = 0; i < subjectlinks.length; i++) {
        subjectlinks[i].className = subjectlinks[i].className.replace(" active", "");
    }
    document.getElementById(subjectName).style.display = "block";
    event.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();