<?php
session_start();
//start session, session will be maintained for entire call
require_once("response.php");//response.php is the kookoo xml preparation class file
$r = new Response();

$r->setFiller("yes");

//echo $_REQUEST['event']." ".$_SESSION['next_goto'];
    

$fileName="./kookoo_trace.log";// create logs to trace your application behaviour
if (file_exists($fileName))
{
        $fp = fopen($fileName, 'a+') or die("can't open file");
}
else
{
        $fp= fopen($fileName, 'x+');// or die("can't open file");
}
fwrite($fp,"----------- kookoo params ------------- \n ");
  foreach ($_REQUEST as $k => $v) {
 	 	fwrite($fp,"param --  $k =  $v \n ");
   } 
fwrite($fp,"----------- session params maintained -------------  \n");
     foreach ($_SESSION as $k => $v) {
	 	fwrite($fp,"session params $k =  $v  \n");
	}
 
if($_REQUEST['event']== "NewCall" ) 
{
	
fwrite($fp,"-----------NewCall from kookoo  -------------  \n");
	// Every new call first time you will get below params from kookoo
	//                                        event = NewCall
	//                                         cid= caller Number
	//                                         called_number = sid
	//                                         sid = session variable
	//    
	//You maintain your own session params store require data
	$_SESSION['caller_number']=$_REQUEST['cid'];
	$_SESSION['kookoo_number']=$_REQUEST['called_number']; 
	//called_number is register phone number on kookoo
	//
	$_SESSION['session_id']   = $_REQUEST['sid'];
	//sid is unique callid for each call
    // you maintain one session variable to check position of your call
    //here i had maintain next_goto as session variable
	$_SESSION['next_goto']='Menu1';
} 
 if($_SESSION['next_goto']=='Menu1'){
 	$collectInput = New CollectDtmf();
	$collectInput->addPlayText("Enter the postal code  of the area",1);
	$collectInput->setMaxDigits('6'); //max inputs to be allowed
	$collectInput->setTimeOut('12000');  //maxtimeout if caller not give any inputs
$_SESSION['next_goto']='Menu1_CheckInput';
	$r->addCollectDtmf($collectInput);
    $r->send();

}
else if($_REQUEST['event'] == 'GotDTMF' && $_SESSION['next_goto'] == 'Menu1_CheckInput' )
{

if($_REQUEST['data']!='')
{
$_SESSION['zip'] = $_REQUEST['data'];
$collectInput = New CollectDtmf();
	$collectInput->addPlayText('Enter one for information about restaurant, press 2 for hospital , press 3 for post office, press 4 for movie, press 5 for mall',1);
	$collectInput->setMaxDigits('1'); //max inputs to be allowed
	$collectInput->setTimeOut('4000');  //maxtimeout if caller not give any inputs
 $_SESSION['next_goto']='Menu2_CheckInput';
	$r->addCollectDtmf($collectInput);
   $r->send();

}
}
else if($_REQUEST['event'] == 'GotDTMF' && $_SESSION['next_goto'] == 'Menu2_CheckInput' )
{

 if($_REQUEST['data'] == '1'){
	$_SESSION['next_goto'] = 'Restaurant';
	$_SESSION['choice'] = 1;
	$type='restaurant';
}else if($_REQUEST['data'] == '2'){
    $_SESSION['next_goto'] = 'Hospital';
	$_SESSION['choice'] = 2;
	$type='hospital';
}
else if($_REQUEST['data'] == '3'){
    $_SESSION['next_goto'] = 'post%office';
	$_SESSION['choice'] = 3;
	$type='post%office';
}
else if($_REQUEST['data'] == '4'){
    $_SESSION['next_goto'] = 'movie';
	$_SESSION['choice'] = 4;
	$type='movie';
}
else if($_REQUEST['data'] == '5'){
    $_SESSION['next_goto'] = 'mall';
	$_SESSION['choice'] = 5;
	$type='mall';
}


if(isset($_SESSION['zip'])&&isset($_SESSION['choice']))
{
fwrite($fp,"---------fetching data------------");
//echo "zip is".$_SESSION['zip']." and choice is ".$_SESSION['choice'];

$pin=$_SESSION['zip'];
$ch = curl_init("http://query.yahooapis.com/v1/public/yql?q=select%20*from%20geo.placefinder%20where%20postal%3D%22$pin%22&format=json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
//$resp = '{"query":{"count":1,"created":"2011-09-18T09:50:59Z","lang":"en-US","results":{"Result":{"quality":"60","latitude":"28.531799","longitude":"77.207451","offsetlat":"28.531799","offsetlon":"77.207451","radius":"2000","name":null,"line1":null,"line2":null,"line3":"New Delhi 110017","line4":"India","house":null,"street":null,"xstreet":null,"unittype":null,"unit":null,"postal":"110017","neighborhood":null,"city":"New Delhi","county":null,"state":"Delhi","country":"India","countrycode":"IN","statecode":"DL","countycode":null,"uzip":"110017","hash":null,"woeid":"29229045","woetype":"11"}}}}';
$arr=json_decode($resp);

$lat=$arr->query->results->Result->latitude;
$long=$arr->query->results->Result->longitude;

$ch = curl_init("https://maps.googleapis.com/maps/api/place/search/json?location=$lat,$long&radius=3000&name=$type&sensor=false&key=AIzaSyAucP4jyahvt7Y86BZ7IWY_hid5Jr6xAv0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);

$arr=json_decode($resp);

$pass='';

for($count=0; $count<=3; $count++)
{
$pass=$pass." ".$arr->results[$count]->name." ";

$pass=$pass." ".$arr->results[$count]->vicinity." ";

}
//print($pass);
$_SESSION['pass'] = $pass;
$_SESSION['over'] = 1;
unset($_SESSION['zip']);
unset($_SESSION['choice']);

}
	$saye = $_SESSION['pass'];
    $collectInput = New CollectDtmf();
	$collectInput->addPlayText($saye,1);
	$collectInput->addPlayText("Press 1 to receive the same as sms",1);
	$collectInput->setMaxDigits('1'); //max inputs to be allowed
	$collectInput->setTimeOut('4000');  //maxtimeout if caller not give any inputs
    $_SESSION['next_goto']='Menu3_CheckInput';
	$r->addCollectDtmf($collectInput);
if(isset($_SESSION['over'])&&$_SESSION['over']==1)
{
fwrite($fp,"---------going to play----j8uj--------");
     $output = $_SESSION['pass'];
	fwrite($fp,$output);
	$file = fopen ("places.txt", "w");
	fwrite($file, $output);
	fclose ($file);
    system("text2wave places.txt -o places.wav");
     
unset($_SESSION['over']);
}

$r->send();
}
else if($_REQUEST['event'] == 'GotDTMF' && $_SESSION['next_goto'] == 'Menu3_CheckInput' )
{
	$pass = $_SESSION['pass'];
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
}
fwrite($fp,"----------- final xml send to kookoo  -------------  ".$r->getXML()."\n");

?>
