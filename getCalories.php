<?php
	include 'testmysql.php';
	$item=$_GET['item'];
	$json=array();
	$description=mysqli_query($con,"Select * from CalorieTable where item='$item'") or die(mysql_error());
	$valid=$description->num_rows;
	if($valid<1)
	{
		echo "Error! No such entry in database";
		exit();
	}
	//echo json_encode($description);
	$data=mysqli_fetch_array($description);
	//echo "$data";
	//echo json_encode($data);
	if($data['verified']==1){
		$json[]=$data;
		echo json_encode($json);	
	}
	else//value still not verified
	{
		$data['warning']='Value not verified';
		$json[]=$data;
		echo json_encode($json);
	}
?>