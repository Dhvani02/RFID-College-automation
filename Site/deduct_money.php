<?php
session_start();
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("rfid",$conn);

$rfid1=$_SESSION["sendid"];
echo "New values for $rfid1 : ";
//print_r($_SESSION);
echo "<br>";
$result = mysql_query("SELECT amount FROM register WHERE rfid='".$rfid1."'");
$data = mysql_fetch_assoc($result);
$currentAmt=$data['amount'];
echo "The existing amount was $currentAmt";
echo "<br>";
$amt=$_POST["amt"];
$newAmt=$currentAmt-$amt;
echo "Updated amount is $newAmt";
mysql_query("UPDATE register SET amount='".$newAmt."' WHERE rfid='".$rfid1."'");
mysql_close($conn);
?>