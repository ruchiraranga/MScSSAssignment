<?php 
	require 'appconf.php';

	$helper = $fb->getRedirectLoginHelper();

	$optPermissions = ['email']; // Define Optional permissions
	$fbloginUrl = $helper->getLoginUrl('http://localhost/fbProfile/tokenget.php', $optPermissions);

	header("location:" . $fbloginUrl);
 ?>