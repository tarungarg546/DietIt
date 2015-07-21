<?php
	include 'testmysql.php';
	$query=$_GET['query'];
	$mdata=array();
	$fdata=array();
	if(!is_null($query))
	{
		$result=mysqli_query($con,"SELECT item From calorietable WHERE item LIKE '$query%'") OR die(mysqli_error());
		$Nrows=$result->num_rows;
		if($Nrows>=1)
		{
			$index=0;
			while ($row=mysqli_fetch_array($result)) {
				$mdata[$index++]=$row['item'];
			}
			echo json_encode($mdata);
		}
	}
?>