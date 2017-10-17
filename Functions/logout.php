<?php 
session_start();
header("location: /sdp/index.php");
session_destroy();
?>