<?php
$con = mysqli_connect("localhost","root","","test_json");

$three = mysqli_fetch_array(mysqli_query($con, "SELECT count FROM test WHERE id=3"));

$three1 = json_decode($three[0]);
$three2 = json_encode($three1);

print_r($three1);
echo "<br>";
print_r($three2);
?>