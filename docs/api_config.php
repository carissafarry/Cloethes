<?php 

	require_once 'session.php';
	//require 'function.php';

	// Google API
	require_once 'googleapi/vendor/autoload.php';
	//require_once 'googleapi/vendor/google/auth/src/Oauth2.php';
	$gClient = new Google_Client();
	$gClient->setClientId("467210737960-e5t7h9s6kklbk6bcua5qf3h93qkhlkqc.apps.googleusercontent.com");
	$gClient->setClientSecret("O7X4cj5ZYc1GG51kyB7SX1JJ");
	$gClient->setApplicationName("Cloethes Login");
	$gClient->setRedirectUri("http://localhost/testing-php/ec13/login.php");
	$gClient->addScope("email");
	$gClient->addScope("profile");

	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
	//$gClient->setScopes(array(Google_Service_Plus::PLUS_ME));
	//$google_oauthv2 = new Google_Service_Plus($gClient);
	//$google_oauthv2 = new Google_Oauth2Service($gclient);
	//https://www.googleapis.com/auth/userinfo.email
	/*$client->setScopes(array(
    "https://www.googleapis.com/auth/userinfo.email",
    "https://www.googleapis.com/auth/userinfo.profile",
    "https://www.googleapis.com/auth/plus.me"
	));*/

?>