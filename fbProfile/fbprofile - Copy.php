<?php 

	require 'appconf.php';
	try {
	  // Returns a `Facebook\FacebookResponse` object
	  $fbprofRequest = $fb->get('/me?fields=id,name,first_name,last_name,email,cover,gender,birthday,timezone,picture,link', $_SESSION['fb_acc_token']);
	  $fbprofImage = $fb->get('/me/picture?redirect=false&width=250&height=250', $_SESSION['fb_acc_token']);
	  $requestFriends = $fb->get('/me/friends?fields=name&limit=20', $_SESSION['fb_acc_token']);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	$fbUser = $fbprofRequest->getGraphUser();
	$profImage = $fbprofImage->getGraphUser();

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	
	
</head>
<body>
<div class="container">
	<center><h2>Your Facebook Profile</h2></center>
    <div class="login-form">
        
        <img align="left" src="<?=$profImage['url']?>" alt="User_Profile Image"/>
    </div>
           	<center><p><?=$fbUser['id']?></p></center>
            <center><h2><?=$fbUser['name']?></h2></center>
            <center><p><h3>e-mail: <?=$fbUser['email']?></h3></p></center>
	    	<center><p>First Name: <?=$fbUser['first_name']?></p></center>
	    	<center><p><?=$fbUser['last_name']?></p></center>
	    
	   	
            
            
        
    
</div> <!-- /container --> 
</body>
</html>