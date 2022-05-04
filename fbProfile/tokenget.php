<?php 
	
	require 'appconf.php';
	$fbuserId = '104491122259584';
	$helper = $fb->getRedirectLoginHelper();
	
	try {
	  $fbuseraccessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  	  echo 'Graph returned an error: ' . $e->getMessage();	// Output Message When Graph returns an error
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  	  echo 'Facebook SDK returned an error: ' . $e->getMessage();	// Output Message When validation fails or other local issues
	  exit;
	}

	if (! isset($fbuseraccessToken)) {
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
	  // The OAuth 2.0 client handler helps us manage access tokens
	$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
	$tokenMetadata = $oAuth2Client->debugToken($fbuseraccessToken);
	echo '<h3>Metadata</h3>';
	var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
	$tokenMetadata->validateAppId($appId);
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('{your user id}');
	$tokenMetadata->validateExpiration($fbuserId);
	

	// After Logged in Generate token and set it into the session
	// Redirect token to fbprofile.php 
	$_SESSION['fb_acc_token'] = $fbuseraccessToken->getValue();
	header("location: fbprofile.php")
	
	
?>