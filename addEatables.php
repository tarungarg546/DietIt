<?php
include 'testmysql.php';
$query1=mysqli_query($con,"UPDATE calorietable SET major='eatables',minor='veg' WHERE 1") or die(mysqli_error());
?>