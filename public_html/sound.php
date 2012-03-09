<?php
 session_start();
    if(isset($_SESSION['pass']))
    $output = $_SESSION['pass'];
	else 
	$output = "fdgs df fggsds";
	$spc = time();
    $newfile=$spc.".text";
	$file = fopen ($newfile, "w");
	fwrite($file, $output);
	fclose ($file);
    $in_file = $newfile;
    $out_file = $spc.".wav";
    system("text2wave ".$in_file." -o ".$out_file." ");

require_once("response.php");//response.php is the kookoo xml preparation class file
$r = new Response();

$r->setFiller("yes");
$r->addPlayText("your work has been done");
$r->send();



   ?>
