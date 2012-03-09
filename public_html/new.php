<?p
$type='atm';
$lat=12.992375;
$long=80.233059;

$ch = curl_init("https://maps.googleapis.com/maps/api/place/search/json?location=$lat,$long&radius=2000&name=$type&sensor=false&key=AIzaSyAucP4jyahvt7Y86BZ7IWY_hid5Jr6xAv0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);

$arr=json_decode($resp);
/*
echo "<pre>";
print_r($arr);
echo "</pre>";
*/
for($count=0; $count<=4; $count++)
{
print_r($arr->results[$count]->name);
echo "<br>";
print_r($arr->results[$count]->vicinity);
echo "<br><br>";
}
?>