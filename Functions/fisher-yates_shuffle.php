<?php
function FisherYatesShuffle($data, $count)
{
	$retVal = array();
	$ind = array();
	$index = 0;

	for ($i = 0; $i < $count; ++$i)
		$ind[$i] = 0;

	for ($i = 0; $i < $count; ++$i)
	{
		do
		{
			$index = rand() % $count;
		} while ($ind[$index] != 0);

		$ind[$index] = 1;
		//$retVal[$i] = $data[$index];
	}

	return $retVal;
}
include('../Conf/init.php');
$result=mysqli_query($conn,"SELECT ChallengeID FROM challenge");
if (!$result) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	
	$data = array();
	while($row = mysqli_fetch_array($result))
	{
		$data[] = $row['ChallengeID'];
		$retVal = FisherYatesShuffle($data, 8);
			print_r($data);
	}


?>