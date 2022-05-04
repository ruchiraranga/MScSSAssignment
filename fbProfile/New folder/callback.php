<?php 
	session_start();
	require 'Facebook/autoload.php';
	$fb = new Facebook\Facebook([
	  'app_id' => '897168481112849', // your app id
	  'app_secret' => '20ae60d880a2a162c90b554d965cdabc', // your app secret
	  'default_graph_version' => 'v13.0',
	]);
	$helper = $fb->getRedirectLoginHelper();
	
	try {
	  $accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	if (! isset($accessToken)) {
	  if ($helper->getError()) {
	    header('HTTP/1.0 401 Unauthorized');
	    echo "Error: " . $helper->getError() . "\n";
	    echo "Error Code: " . $helper->getErrorCode() . "\n";
	    echo "Error Reason: " . $helper->getErrorReason() . "\n";
	    echo "Error Description: " . $helper->getErrorDescription() . "\n";
	  } else {
	    header('HTTP/1.0 400 Bad Request');
	    echo 'Bad request';
	  }
	  exit;
	}

	// Logged in
	$_SESSION['fb_access'] = $accessToken->getValue();
	header("location: profile.php")
	//header("location: post.php")
	//echo '<h2>Access Token</h2>';
	//var_dump($accessToken->getValue());
?>