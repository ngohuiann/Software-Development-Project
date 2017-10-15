<?php 
session_start();
error_reporting(0);
switch($_SESSION['userLevel']) {
    case "User": //regular user
        require_once("Includes/header-user.php");
        break;
    //etc and default nav below
	default:
		require_once('Includes/header.html');
		break;
}
?>