<?php
//Score full mark 1 time in a module test.
include('../../Conf/init.php');
$ChaID = $_SESSION['ChallengeID'];
$currentdate = date("Y-m-d");
$result = mysqli_query($conn,"SELECT * FROM result INNER JOIN quiz ON quiz.QuizID = result.QuizID WHERE result.UserID = '5' AND result.CompletedDate = '$currentdate'");
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row = mysqli_fetch_array($result);
echo $row['Result'];

?>