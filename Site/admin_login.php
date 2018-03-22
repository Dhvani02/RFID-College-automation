<?php
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("rfid",$conn);
$user=$_POST["usr"];
$pass=$_POST["pass"];
$result=mysql_query("SELECT password FROM admin WHERE username='".$user."'");
$data = mysql_fetch_assoc($result);
if($data['password']==$pass)
{
	include 'indexsms.php';
}
else
{
	include 'register.html';
	$message = "wrong username or password";
	echo "<script type='text/javascript'>alert('$message');</script>";

}
mysql_close($conn);
?>
