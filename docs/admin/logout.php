<?php
	session_start();

	// memastikan session telah berakhir
	$_SESSION = [];
	session_unset();
	session_destroy();

	// akhiri cookie
	setcookie('id', '', time()-3600 );
	setcookie('key', '', time()-3600 );

	header("Location: login.php");
	exit;
?>