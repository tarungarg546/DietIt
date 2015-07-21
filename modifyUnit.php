<?php
include 'testmysql.php';
$query1=mysqli_query($con,"UPDATE calorietable SET unit='100 grams' WHERE 1") or die(mysqli_error());
?>