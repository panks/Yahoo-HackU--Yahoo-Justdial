    <?php
    ini_set(‘display_errors’, ‘On’);
    error_reporting(E_ALL);

    //Your way2SMS account details configure here….
    $post_data = “username=8939202988&password=1194”;
    $timeout = 30;
    //$header_array[]=”User-Agent:
    $url = “http://wwwa.way2sms.com/auth.cl”;
    $cookie = tempnam (“/tmp”, “CURLCOOKIE”);
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_USERAGENT,”Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5? );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HTTPHEADER, Array(“Content-Type: application/x-www-form-urlencoded”,”Accept: */*”));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_ENCODING, “” );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); # required for https urls
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
    curl_setopt($ch,CURLOPT_REFERER,”http://wwwg.way2sms.com//entry.jsp”);
    $content = curl_exec( $ch );
    $response = curl_getinfo( $ch );

    $url = “http://wwwa.way2sms.com//jsp/InstantSMS.jsp?val=0?;
    curl_setopt( $ch, CURLOPT_USERAGENT,”Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5? );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_ENCODING, “” );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 0 );
    $content = curl_exec( $ch );
    $response = curl_getinfo( $ch );
    //site content in the instant sms
    $tmp = substr ($content,strrpos($content,”Action”,0)+15,15);
    //value of Action=custfromnnnn which will be different for each customer
    $id = substr($tmp,0,strrpos($tmp,”"”,0));
    //echo $id;

    // Add sent to mobile number and your message
    $post_data = “custid=undefined&HiddenAction=instantsms&Action=$id&login=&pass=&MobNo=8939202988&textArea=You text message”;
    $url = “http://wwwa.way2sms.com/FirstServletsms?custid=”;
    curl_setopt( $ch, CURLOPT_USERAGENT,”Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5? );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HTTPHEADER, Array(“Content-Type: application/x-www-form-urlencoded”,”Accept: */*”));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_ENCODING, “” );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); # required for https urls
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 0 );
    $content = curl_exec( $ch );
    //$response = curl_getinfo( $ch );
    //print_r($response);
    //echo $content;

    $url = “http://wwwa.way2sms.com/jsp/logout.jsp”;
    curl_setopt( $ch, CURLOPT_USERAGENT,”Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5? );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HTTPHEADER, Array(“Content-Type: application/x-www-form-urlencoded”,”Accept: */*”));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_ENCODING, “” );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); # required for https urls
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 0 );
    $content = curl_exec( $ch );
    //echo $content;
    ?>