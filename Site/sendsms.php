<?php
session_start();
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("rfid",$conn);

$token = 'LdiO4PWJjkU7xcXQkoTLiNGK7I4D1Lu7RqO4h22fSRK32Vigad69Wasp2Dye';

$rfid = file_get_contents('id.txt');
//echo "For $rfid";
//$rfid=$_POST["id"];
$_SESSION["sendid"]=$rfid;

$result = mysql_query("SELECT mobile FROM register WHERE rfid='".$rfid."'");
$data = mysql_fetch_assoc($result);
//$mobile=mysql_real_escape_string($data['mobile']);
$mobile="9821187957";
echo $mobile;
echo "<br>";
$msg = mysql_real_escape_string(mt_rand(1000,10000));
echo "<script type='text/javascript'>confirm('Verify OTP: $msg');</script>";
echo "<br>";
$field = array(
    "sender_id" => "FSTSMS",
    "message" => $msg,
    "language" => "english",
    "route" => "p",
    "numbers" => $mobile,
    "flash" => "1",
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization: LdiO4PWJjkU7xcXQkoTLiNGK7I4D1Lu7RqO4h22fSRK32Vigad69Wasp2Dye",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

include 'indexsms.php';
?>
