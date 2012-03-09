<?php
$pass=urlencode("aabdi shndi sodnso indisnid");
$num=8939202988;
$ch = curl_init("http://whozzat.com/api/index.php?action=login_user&app_key=d06dde32bc38ef25fed3658a2e27475e&username=panks&password=monkey25 ");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
//$key=json_decode($resp);
print($resp);


$ch = curl_init("http://whozzat.com/api/index.php?action=send_sms&app_key=d06dde32bc38ef25fed3658a2e27475e&auth_key=$resp&mobile_no=$num&message=$pass&private=0&flash=0 ");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
//$arr=json_decode($resp);
print($resp);
?>