<?php 
	session_start();
	require 'Facebook/autoload.php';
	$fb = new Facebook\Facebook([
	  'app_id' => '897168481112849', // your app id
	  'app_secret' => '20ae60d880a2a162c90b554d965cdabc', // your app secret
	  'default_graph_version' => 'v13.0',
	]);
	$helper = $fb->getRedirectLoginHelper();

	
	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('http://localhost/facebook/callback.php', $permissions);

	header("location:" . $loginUrl);
	//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Fb!</a>'	

 ?>