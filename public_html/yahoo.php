<?php

require_once("response.php");
session_start();

$r = new Response();

       
	$r->addPlayText("I am a good boy");
	$r->send();

	?>

