<?php 
	session_start();
	require 'Facebook/autoload.php';
	$appId = '548512270231665';	// Replace value in '' with your app id
	$appSecret = '41fc77734d799260acc7951058f83209';	// Replace value in '' with your app secret
	$defgraphVersion = 'v13.0';	// Replace value in '' with correct graph version
	$fb = new Facebook\Facebook([
	  'app_id' => $appId, 
	  'app_secret' => $appSecret, 
	  'default_graph_version' => $defgraphVersion,
	]);

?>