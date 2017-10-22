<?php
include('../Conf/init.php');
$issuedate = date("Y-m-d");
$challenge = mysqli_query($conn,"SELECT challengequestion.ChaQuestionID FROM challengequestion INNER JOIN challenge ON challengequestion.ChaQuestionID = challenge.ChaQuestionID WHERE challenge.IssueDate = '$issuedate'");
if (!$challenge) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row = mysqli_fetch_array($challenge);
$questionno = $row['ChaQuestionID'];

switch($questionno) {
    case "1": //Score full mark 1 time in a module test.
        require_once('challenge/challenge1.php');
        break;
    case "2": //Score full mark 2 time in a module test.
        require_once('challenge/challenge2.php');
        break;
	case "3": //Unlock 3 modules in a day
        require_once('challenge/challenge3.php');
        break;
    case "4": //Unlock 4 modules in a day
        require_once('challenge/challenge4.php');
        break;
	case "5": //Complete 3 modules in a day
        require_once('challenge/challenge5.php');
        break;
    case "6": //Complete 5 modules in a day
        require_once('challenge/challenge6.php');
        break;
	case "7": //Earn 50 coins in a day
        require_once('challenge/challenge7.php');
        break;
    case "8": //Earn 80 coins in a day
        require_once('challenge/challenge8.php');
        break;
	case "9": //Use a hint in a day
        require_once('challenge/challenge9.php');
        break;
    case "10": //Earn 30 coins in a day
        require_once('challenge/challenge10.php');
        break;
    case "11": //Use 2 hints in a day
        require_once('challenge/challenge11.php');
        break;
	default:
		require_once('../index.php');
		break;
}
?>