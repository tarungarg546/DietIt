<?php
	include 'testmysql.php';
	$rem=$_GET['RemainingC'];
	$final=array();
	$query=mysqli_query($con,"SELECT * FROM calorieTable where value<'$rem'") or die(mysqli_error());
	//echo $query->num_rows;
	$i=0;

	while($res=mysqli_fetch_array($query))
	{
		if($res['verified']==0)
		{
			$res['warning']='Value not verified';
		}
		$final[$i]=$res;
		$i++;
	}
	echo json_encode($final);
?>