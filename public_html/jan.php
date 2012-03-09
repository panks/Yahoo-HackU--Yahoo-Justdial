<?PHP
/*******************************
*	Facebook Status Updater
*	Christian Flickinger
*	http://nexdot.net/blog
*	April 20, 2007
*******************************/

$status = 'YOUR_STATUS';
$first_name = 'YOUR_FIRST_NAME';
$login_email = 'YOUR_LOGIN_EMAIL';
$login_pass = 'YOUR_PASSWORD';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://login.facebook.com/login.php?m&amp;next=http%3A%2F%2Fm.facebook.com%2Fhome.php');
curl_setopt($ch, CURLOPT_POSTFIELDS,'email='.urlencode($login_email).'&pass='.urlencode($login_pass).'&login=Login');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
curl_exec($ch);

curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com/home.php');
$page = curl_exec($ch);

curl_setopt($ch, CURLOPT_POST, 1);
preg_match('/name="post_form_id" value="(.*)" \/>'.ucfirst($first_name).'/', $page, $form_id);
curl_setopt($ch, CURLOPT_POSTFIELDS,'post_form_id='.$form_id[1].'&status='.urlencode($status).'&update=Update');
curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com/home.php');
curl_exec($ch);
?>