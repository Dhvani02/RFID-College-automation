<?php
$conn=mysql_connect("localhost","root","");
echo "You're our member";
$db=mysql_select_db("rfid",$conn);

$query="INSERT INTO register (mobile, rfid, amount) VALUES ('".$_POST["mob"]."','".$_POST["rfid"]."','".$_POST["amt"]."')";
$result=mysql_query($query,$conn);
include 'index.html';

/*mysql_close($conn);*/ 
?>