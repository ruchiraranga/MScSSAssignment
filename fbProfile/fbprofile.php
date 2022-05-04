<?php 

	require 'appconf.php';
	try {
	  // Set details that need to be retrieved from profile
	  // Get Access token
	  $fbprofRequest = $fb->get('/me?fields=id,name,first_name,last_name,middle_name,email,name_format,cover,gender,birthday,timezone,picture,link', $_SESSION['fb_acc_token']);
	  $fbprofImage = $fb->get('/me/picture?redirect=false&width=300&height=300', $_SESSION['fb_acc_token']);
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
	//echo "<pre>";
	//print_r($fbUser);
	//$fbFriends = $requestFriends->getGraphUser();

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" href="css/styles.css">
<style>
#fbProfile {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 30%;
}

#fbProfile td, #fbProfile th {
  border: 1px solid #ddd;
  padding: 8px;
}

#fbProfile tr:nth-child(even){background-color: #FFE4C4;}
#fbProfile tr:nth-child(odd){background-color: #9ACD32;}
#fbProfile tr:hover {background-color: #ddd;}
#fbProfile tr {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  color: red;
}
img {
  border-radius: 50%;
}
</style>
	
</head>
<body>
<div class="container">
	<center><h2>Your Facebook Profile</h2></center>
    
        
        <center><img align="center" src="<?=$profImage['url']?>" alt="Profile Pic" width="250" height="250"></center>
        <br>
        <br>
    
    <center><table id="fbProfile">
    	<tr>
    		<td>Facebook User ID</td>
    		<td><?=$fbUser['id']?></td>
    	</tr>
    	<tr>
    		<td>Facebook Profile Name</td>
    		<td><?=$fbUser['name']?></td>
    	</tr>
        <tr>
    		<td>Facebook First Name</td>
    		<td><?=$fbUser['first_name']?></td>
    	</tr>
    	<tr>
    		<td>Facebook Last Name</td>
    		<td><?=$fbUser['last_name']?></td>
    	</tr>
    	<tr>
    		<td>e-mail</td>
    		<td><?=$fbUser['email']?></td>
    	</tr>
    	<tr>
    		<td>Name Format</td>
    		<td><?=$fbUser['name_format']?></td>
    	</tr>
    	
    </table><center></dev>

           	   
	   	
            
            
        
    
</div> <!-- /container --> 
</body>
</html>