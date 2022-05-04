<!DOCTYPE html>
<html>
<head>
	<title>Facebook Profile</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<style type="text/css">
		.fb-profile img.fb-image-lg{
		    z-index: 0;
		    width: 1140px; 
		    height: 375px; 
		    margin-bottom: 10px;
		    border: 1px solid blue;
		}
		.fb-image-profile {
		    margin: -90px 10px 0px 50px;
		    z-index: 9;
		    width: 250px; 
		    height: 250px; 
		    border: 1px solid red;
		}
	</style>
</head>
<body>
<?php 

	session_start();
	require 'Facebook/autoload.php';
	$fb = new Facebook\Facebook([
	  	'app_id' => '897168481112849', // your app id
	  	'app_secret' => '20ae60d880a2a162c90b554d965cdabc', // your app secret
	  	'default_graph_version' => 'v13.0',
	]);
	try {
	  // Returns a `Facebook\FacebookResponse` object
	  $fbprofRequest = $fb->get('/me?fields=id,name,first_name,last_name,email,cover,gender,birthday,timezone,picture,link', $_SESSION['fb_access']);
	  $fbprofImage = $fb->get('/me/picture?redirect=false&width=250&height=250', $_SESSION['fb_access']);
	  $requestFriends = $fb->get('/me/friends?fields=name&limit=20', $_SESSION['fb_access']);
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
<div class="container">
	<h1>Your Facebook Profile</h1>
    <div class="fb-profile">
        
        <img align="left" class="fb-image-profile thumbnail" src="<?=$profImage['url']?>" alt="User_Profile Image"/>
        <div class="fb-profile-text">
            <h1><?=$fbUser['name']?></h1>
            <p><h1>e-mail: <?=$fbUser['email']?></h1></p>
	    <p>First Name: <?=$fbUser['first_name']?></p>
	    <p><?=$fbUser['last_name']?></p>
	    <p><?=$fbUser['id']?></p>
	   	
            
            
        </div>
    </div>
</div> <!-- /container --> 
</body>
</html>