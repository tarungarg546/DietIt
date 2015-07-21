<?php
include 'testmysql.php';
$itemName=$_POST['item'];
$calorieValue=$_POST['value'];
//$imageURI=(is_null($_GET['img'])?:);
//include 'getImage.php';
if($itemName==' ' or $calorieValue==' ')
{
	echo "Invalid Entry <a href='enterData.php'>Create Another</a>";
}
$query1=mysqli_query($con,"SELECT item from calorietable WHERE item='$itemName'") or die(mysqli_error($con));
if($query1->num_rows>=1)
{
	echo "Entry already exist <a href='enterData.php'>Create Another</a>";
}
else
{
	$ins=mysqli_query($con,"INSERT INTO calorietable VALUES ('','$itemName','$calorieValue','1','','','')") or die(mysqli_error($con));
	header("Location:getImage.php?item=$itemName");
	exit();
}
?>