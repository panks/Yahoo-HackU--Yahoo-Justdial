<?php
$pass = $_GET['pass'];
echo $pass;

         $ch = curl_init("http://whozzat.com/api/index.php?action=login_user&app_key=d06dde32bc38ef25fed3658a2e27475e&username=panks&password=monkey25 ");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
print($resp);
$num =$_SESSION['caller_number'];

$final=urlencode($pass);
$ch = curl_init("http://whozzat.com/api/index.php?action=send_sms&app_key=d06dde32bc38ef25fed3658a2e27475e&auth_key=$resp&mobile_no=$num&message=$final&private=0&flash=0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
print($resp);
?>