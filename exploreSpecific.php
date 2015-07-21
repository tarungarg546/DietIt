<?php
	include 'testmysql.php';
	$major=$_GET['major'];
	$minor=$_GET['minor'];
	$rem=$_GET['remainingC'];
	$final=array();
	$med=array();
	$query=mysqli_query($con,"SELECT * calorietable WHERE value<'$rem' AND major='$major' AND minor='$minor'") or die(mysqli_error($con));
	$i=0;
	while($data=mysqli_fetch_array($query))
	{
		$med['item']=$data['item'];
		echo $med['item'];
		$med['value']=$data['value'];
		$med['imageURI']=$data['imageURI'];
		if($data['verified']==0)
		{
			$med['warning']="Value not verified";
		}
		$final[$i++]=$med;
	}
	echo json_encode(value);
?>