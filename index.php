<html>
<?php 

include('Conf/header-session.php');
include('Conf/body-session.php');

?>
<head>
    <link rel="stylesheet" type="text/css" href="/sdp/CSS/index.css"/>
	<link href="https://fonts.googleapis.com/css?family=Dosis|Titillium Web" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cuprum|Oswald|Overpass Mono|Saira Extra Condensed" rel="stylesheet">
</head>
<body>
    <div class="course-desc" id="subjectbar">
         <div style="background-color:#2b303b;">
 		 <div class="subject-tab">
 			<button class="subjectlinks htmltab" onclick="openSubject(event, 'HTML')"><span>&lt;</span> HTML <span>&gt;</span></button>
 			<button class="subjectlinks csstab" onclick="openSubject(event, 'CSS')"><span>&lt;</span> CSS <span>&gt;</span></button>
 			<button class="subjectlinks javascripttab" onclick="openSubject(event, 'Javascript')"><span>&lt;</span> JavaScript <span>&gt;</span></button>
 		 </div>
         </div>
 		<div id="HTML" class="subjectcontent">
 			<div class="container">
                <div class="moduletitle">
                     <a>
                        <h3>1&nbsp;&nbsp;HTML: Introduction to HTML</h3>
                     </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>2&nbsp;&nbsp;HTML: Basic elements</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>3&nbsp;&nbsp;HTML: Attributes</h3>
                    </a>
                </div>
                <a href="html.php" id="showall">Show All</a>
            </div>
        </div>
 		<div id="CSS" class="subjectcontent">
 			<div class="container">
                <div class="moduletitle">
                    <a>
                        <h3>1&nbsp;&nbsp;CSS: Introduction to CSS</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>2&nbsp;&nbsp;CSS: Syntax</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>3&nbsp;&nbsp;CSS: Background &amp; Colors</h3>
                    </a>
                </div>
                <a href="css.php" id="showall">Show All</a>
            </div>
        </div>
 		<div id="Javascript" class="subjectcontent">
 			<div class="container">
                 <div class="moduletitle">
                     <a>
                        <h3>1&nbsp;&nbsp;JavaScript: Introduction to JavaScript</h3>
                     </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>2&nbsp;&nbsp;JavaScript: Syntax</h3>
                    </a>
                </div>
                <div class="moduletitle">
                    <a>
                        <h3>3&nbsp;&nbsp;JavaScript: Statements</h3>
                    </a>
                </div>
                <a href="css.php" id="showall">Show All</a>
            </div>
        </div>
    </div>
	<div class="beforefooter">
    </div>
	<script src="JS/index-overviewTab.js"></script>
    <script src="JS/index-subjectTab.js"></script>
	<script src="JS/index-regModal.js"></script>
	<script src="JS/index-regForm.js"></script>
<?php
include("Includes/footer.html");
?>
</body>
</html>